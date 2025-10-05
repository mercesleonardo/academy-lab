<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DownloadPandaVideos extends Command
{
    protected $signature = 'panda:download';
    protected $description = 'Baixa todos os vídeos do Panda (SD) para storage/app/private/videos';

    public function handle(): int
    {
        $apiKey = config('panda.apikey');
        if (empty($apiKey)) {
            $this->error('Config `panda.apikey` não definida. Preencha em config/panda.php e no .env.');
            return self::FAILURE;
        }

        // HTTP clients
        $listClient = new Client([
            'base_uri' => 'https://api-v2.pandavideo.com.br',
            'headers'  => ['Authorization' => $apiKey, 'accept' => 'application/json'],
            'timeout'  => 30,
        ]);

        $downloadClient = new Client([
            'base_uri' => 'https://download-us01.pandavideo.com:7443',
            'headers'  => ['Authorization' => $apiKey, 'accept' => 'application/json'],
            'timeout'  => 0, // downloads podem ser longos
        ]);

        Storage::makeDirectory('videos');

        $this->info('Listando vídeos (limit=900)...');
        try {
            $resp = $listClient->get('/videos', ['query' => ['limit' => 900]]);
        } catch (\Throwable $e) {
            $this->error('Falha ao listar vídeos: ' . $e->getMessage());
            return self::FAILURE;
        }

        $json   = json_decode((string) $resp->getBody(), true);
        $videos = $json['videos'] ?? [];
        if (empty($videos)) {
            $this->warn('Nenhum vídeo encontrado.');
            return self::SUCCESS;
        }

        $totalFound      = count($videos);
        $totalDownloaded = 0;

        $this->info("Encontrados {$totalFound} vídeos. Iniciando downloads em SD...\n");

        foreach ($videos as $v) {
            $videoId = $v['id'] ?? null;
            $videoTitle = $v['title'] ?? null;

            if (!$videoId || !$videoTitle) {
                $this->warn('Item sem id ou title — ignorando.');
                continue;
            }

            $safeName = \Illuminate\Support\Str::slug(pathinfo($videoTitle, PATHINFO_FILENAME));
            $fileName = "{$safeName}-{$videoId}.mp4";
            $storageRelPath = "private/videos/{$fileName}";
            $storageFullPath = \Illuminate\Support\Facades\Storage::path($storageRelPath);

            if (file_exists($storageFullPath)) {
                $this->line("• Já existe: {$fileName} — pulando.");
                continue;
            }

            $this->line("• Baixando: {$videoTitle} ({$videoId}) => {$fileName}");

            $tmpPath = $storageFullPath . '.part';

            @mkdir(dirname($tmpPath), 0775, true);

            $lastPercentShown = -1;

            try {
                // qualidade fixa: SD
                $downloadEndpoint = "/videos/{$videoId}/sd/download";

                $downloadClient->post($downloadEndpoint, [
                    'sink' => $tmpPath,
                    'progress' => function ($downloadTotal, $downloadedBytes, $uploadTotal, $uploadedBytes) use (&$lastPercentShown) {
                        if ($downloadTotal > 0) {
                            $percent = (int)floor(($downloadedBytes / $downloadTotal) * 100);
                            if ($percent !== $lastPercentShown) {
                                $lastPercentShown = $percent;
                                echo "\r   Progresso: {$percent}%   ";
                            }
                        } else {
                            $mb = number_format($downloadedBytes / (1024 * 1024), 2);
                            echo "\r   Baixando... {$mb} MB   ";
                        }
                    },
                ]);
            } catch (\Throwable $e) {
                @unlink($tmpPath);
                $this->error("\nFalha ao baixar {$fileName}: {$e->getMessage()}");
                continue;
            }

            @rename($tmpPath, $storageFullPath);
            echo "\r   Progresso: 100%   \n";
            $this->info("   ✓ Salvo em: storage/app/{$storageRelPath}\n");
            $totalDownloaded++;
        }

        $this->info("Concluído. Listados: {$totalFound} | Baixados agora: {$totalDownloaded}");
        return self::SUCCESS;
    }
}
