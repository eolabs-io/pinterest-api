<?php

namespace EolabsIo\PinterestApi\Domain\Shared;

use Exception;
use Illuminate\Support\Facades\Http;
use EolabsIo\PinterestApi\Domain\Shared\Models\PinterestApiAuthorization;

class TokenProvider
{
    private $endpoint = "https://api.pinterest.com/v5/oauth/token";

    private function getRefreshToken(): string
    {
        $clientId = config('pinterest-api.clientId');

        $pinterestApiAuthorization = PinterestApiAuthorization::whereClientId($clientId)->first();

        return $pinterestApiAuthorization->refresh_token;
    }

    private function getScope(): string
    {
        $clientId = config('pinterest-api.clientId');

        $pinterestApiAuthorization = PinterestApiAuthorization::whereClientId($clientId)->first();

        return $pinterestApiAuthorization->scope;
    }

    public function getAccessToken(): string
    {
        try {
            $clientId = config('pinterest-api.clientId');
            $clientSecret = config('pinterest-api.clientSecret');

            $parameters = [
                'grant_type' => 'refresh_token',
                'refresh_token' => $this->getRefreshToken(),
                'scope' => $this->getScope(),
            ];

            $response = Http::withBasicAuth($clientId, $clientSecret)
                            ->asForm()
                            ->post($this->endpoint, $parameters)
                            ->throw();
        } catch (Exception $exception) {
            // Handle exception
        }

        return $response['access_token'];
    }
}
