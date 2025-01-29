<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LocationService
{
    protected string $endpoint;
    protected string $api_key;

    public function __construct()
    {
        $this->endpoint = config('services.google.maps.apiMaps.endpoint');
        $this->api_key = config('services.google.maps.apiMaps.key');
    }

    public function getLocation($input): array
    {
        try {
            $response = Http::get($this->endpoint, [
                'input' => $input,
                'key' => $this->api_key,
            ]);
    
            return $response->json()['predictions'] ?? [];

        } catch (\Exception $e) {
            Log::error('Error' . $e->getMessage());
            return [];
        }
    }
}
