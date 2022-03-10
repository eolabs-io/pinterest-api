<?php
namespace EolabsIo\PinterestApi\Tests\Factories;

use Illuminate\Support\Facades\Http;
use EolabsIo\PinterestApi\Tests\Factories\TokenProviderFactory;
use EolabsIo\PinterestApi\Domain\Shared\Models\PinterestApiAuthorization;

class AdAnalyticsFactory
{
    private $endpoint = 'https://api.pinterest.com/v5/ad_accounts/12345678/ads/analytics';

    public static function new(): self
    {
        return new static();
    }

    public function fake(): self
    {
        Http::fake();

        return $this;
    }

    public function fakeAdAnalyticsResponse(): self
    {
        $this->fakeTokenProvider();

        $file = __DIR__ . '/../Stubs/Responses/fetchAdAnalyticsResponse.json';
        $response = file_get_contents($file);

        Http::fake([
             $this->endpoint .'*' => Http::sequence()
                                    ->push($response, 200)
                                    ->whenEmpty(Http::response('', 404)),
        ]);

        return $this;
    }

    public function fakeTokenProvider()
    {
        PinterestApiAuthorization::factory()->create([
            'client_id' =>  config('pinterest-api.clientId'),
            'scope' => 1234567890,
        ]);

        TokenProviderFactory::new()->fakeRefreshTokenResponse();
    }
}
