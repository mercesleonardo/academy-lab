#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import subprocess
import sys
from pathlib import Path

# ---- Configurações principais ----
# Ajuste o comando do Whisper se necessário (ex.: caminho absoluto)
WHISPER_CMD = "whisper"

# Modelo do Whisper (ajuste conforme seu hardware/necessidade)
WHISPER_MODEL = "turbo"   # opções comuns: tiny, base, small, medium, large

# Se estiver usando CPU sem GPU, definir fp16 False ajuda a evitar erros
USE_FP16 = True

# Idioma: None para detecção automática, ou ex.: "pt", "en"
LANG = None  # "pt"

# Pastas do projeto (assumindo execução a partir da raiz do projeto Laravel)
ROOT = Path(__file__).resolve().parent
VIDEOS_DIR = ROOT / "storage" / "app" / "private" / "videos"
OUT_DIR = ROOT / "storage" / "app" / "private" / "transcriptions"

def run_whisper(input_file: Path, out_dir: Path) -> int:
    """
    Executa o whisper CLI para um único arquivo .mp4, gerando SOMENTE .json.
    Retorna o código de saída do processo.
    """
    cmd = [
        WHISPER_CMD,
        str(input_file),
        "--model", WHISPER_MODEL,
        "--output_dir", str(out_dir),
        "--output_format", "json",        # garante SOMENTE .json
        "--verbose", "False"
    ]

    if not USE_FP16:
        cmd += ["--fp16", "False"]

    if LANG:
        cmd += ["--language", LANG]

    # Você pode adicionar outras flags úteis, por exemplo:
    # cmd += ["--temperature", "0.0"]

    print(f"[whisper] Transcrevendo: {input_file.name}")
    proc = subprocess.run(cmd, stdout=subprocess.PIPE, stderr=subprocess.PIPE, text=True)

    if proc.returncode != 0:
        print(f"[ERRO] Whisper falhou em {input_file.name}")
        if proc.stdout:
            print("STDOUT:", proc.stdout)
        if proc.stderr:
            print("STDERR:", proc.stderr)
    else:
        print(f"[ok] {input_file.name} transcrito com sucesso.")

    return proc.returncode

def main() -> int:
    if not VIDEOS_DIR.exists():
        print(f"[ERRO] Pasta de vídeos não encontrada: {VIDEOS_DIR}")
        return 1

    OUT_DIR.mkdir(parents=True, exist_ok=True)

    mp4_files = sorted([p for p in VIDEOS_DIR.glob("*.mp4") if p.is_file()])

    if not mp4_files:
        print("[info] Nenhum arquivo .mp4 encontrado.")
        return 0

    # Para evitar retrabalho, checamos se já existe um .json com o mesmo nome base
    # na pasta de transcrições.
    processed = 0
    skipped = 0
    failed = 0

    for f in mp4_files:
        json_target = OUT_DIR / f.with_suffix(".json").name
        if json_target.exists():
            print(f"[pular] Já existe transcrição: {json_target.name}")
            skipped += 1
            continue

        rc = run_whisper(f, OUT_DIR)
        if rc == 0:
            processed += 1
        else:
            failed += 1

    print("\n==== RESUMO ====")
    print(f"Total .mp4 encontrados: {len(mp4_files)}")
    print(f"Transcritos: {processed}")
    print(f"Pulados (já existia .json): {skipped}")
    print(f"Falhas: {failed}")

    return 0 if failed == 0 else 2

if __name__ == "__main__":
    sys.exit(main())
