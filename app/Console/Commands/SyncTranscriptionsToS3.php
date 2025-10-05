<?php

namespace App\Console\Commands;

use App\Models\Lesson;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SyncTranscriptionsToS3 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-transcriptions-to-s3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $lessons = Lesson::whereNotNull('panda_id')->get();
        $alLFiles = Storage::disk('local')->allFiles('transcriptions');

        $source = Storage::disk('local');   // ou Storage::disk('private');
        $dest   = Storage::disk('s3');

        foreach ($lessons as $lesson) {

            $path = collect($alLFiles)
                ->first(function (string $path) use ($lesson) {
                    return Str::contains(Str::lower(basename($path)), Str::lower($lesson->panda_id));
                });

            if (!empty($path)) {

                $stream = $source->readStream($path);

                $ok = $dest->put($path, $stream);

                $this->info("Enviado: {$path}");

                $lesson->transcription_url = $path;
                $lesson->save();

            }else {
                $this->error("Nao encontrado: {$lesson->panda_id}");
            }



        }
    }
}
