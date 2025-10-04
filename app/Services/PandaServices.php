<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class PandaServices
{

    public static function searchVideos(string $search): array
    {
        $apiKey = config('panda.apikey');

        if (blank($apiKey)) {
            return [];
        }

        $response = Http::withHeaders([
            'Authorization' => $apiKey,
            'Accept' => 'application/json',
        ])->get('https://api-v2.pandavideo.com.br/videos', array_filter([
            'limit' => 25,
            'page' => 0,
            'title' => $search,
            'status' => null
        ]));

        if ($response->failed()) {
            return [];
        }

        $videos = $response->json('videos') ?? [];

        return collect($videos)
            ->filter(fn (array $video) => isset($video['title']))
            ->mapWithKeys(function (array $video){
                return [$video['id'] => $video['title'] ?? $video['id']];
            })->all();
    }

    public static function getVideoLabel(?string $videoId): ?string
    {
        if (blank($videoId)) {
            return null;
        }

        $data = self::getVideoDetails($videoId);

        return $data['title'] ?? $videoId;
    }

    public static function getVideoDetails(string $videoId): array
    {

        if (Cache::has($videoId)) {
            return (array) Cache::get($videoId);
        }

        $apiKey = config('panda.apikey');

        if (blank($apiKey)) {
            return [];
        }

        $response = Http::withHeaders([
            'Authorization' => $apiKey,
            'Accept' => 'application/json',
        ])->get("https://api-v2.pandavideo.com.br/videos/{$videoId}");

        if ($response->failed()) {
            return [];
        }

        Cache::forever($videoId, $response->json());

        return (array) $response->json();
    }

}
