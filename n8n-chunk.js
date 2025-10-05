function prepareChunks(inputJson, maxLen = 1000) {
    // 1) Achata todos os segments do JSON
    const segments = inputJson;

    // 2) Quebra qualquer segment que exceda maxLen, interpolando tempo
    const splitIfNeeded = (seg, limit) => {
        const text = seg.text ?? "";
        if (text.length <= limit) {
            return [{ start: seg.start, end: seg.end, text }];
        }
        const pieces = [];
        const total = text.length;
        const dur = (seg.end ?? seg.start) - (seg.start ?? seg.end ?? 0);
        let offset = 0;

        while (offset < total) {
            const slice = text.slice(offset, offset + limit);
            // Interpolação linear de tempo baseada na posição do slice dentro do texto
            const fracStart = offset / total;
            const fracEnd = Math.min((offset + slice.length) / total, 1);
            const pieceStart = (seg.start ?? 0) + dur * fracStart;
            const pieceEnd = (seg.start ?? 0) + dur * fracEnd;

            pieces.push({ start: pieceStart, end: pieceEnd, text: slice });
            offset += slice.length;
        }
        return pieces;
    };

    // 3) Normaliza todos os segments para respeitarem maxLen individualmente
    const normalized = segments.flatMap(seg => splitIfNeeded(seg, maxLen));

    // 4) Monta os chunks até maxLen, respeitando fronteiras
    const chunks = [];
    let currentText = "";
    let currentStart = null;
    let currentEnd = null;

    for (const seg of normalized) {
        const clean = (seg.text || "").replace(/\s+/g, " ").trim(); // limpeza leve
        if (!clean) continue;

        const sep = currentText.length > 0 ? " " : "";
        const nextLen = currentText.length + sep.length + clean.length;

        if (nextLen <= maxLen) {
            // Cabe no chunk atual
            if (currentText.length === 0) {
                currentStart = seg.start;
            }
            currentText += sep + clean;
            currentEnd = seg.end;
        } else {
            // Não cabe -> fecha o chunk atual (se houver) e inicia um novo
            if (currentText.length > 0) {
                chunks.push({ chunk: currentText, start: currentStart, end: currentEnd });
            }
            // Inicia novo chunk com o segmento atual (garantido <= maxLen)
            currentText = clean;
            currentStart = seg.start;
            currentEnd = seg.end;
        }
    }

    // 5) Empurra o último chunk aberto
    if (currentText.length > 0) {
        chunks.push({ chunk: currentText, start: currentStart, end: currentEnd });
    }

    return chunks;
}

return prepareChunks($input.first().json.data.segments, 1000);
