<?php
namespace EolabsIo\PinterestApi\Tests\Factories;

use Illuminate\Support\Facades\Http;
use EolabsIo\PinterestApi\Tests\Factories\TokenProviderFactory;
use EolabsIo\PinterestApi\Domain\Shared\Models\PinterestApiAuthorization;

class ListAdsFactory
{
    private $endpoint = 'https://api.pinterest.com/v5/ad_accounts/12345678/ads';

    public static function new(): self
    {
        return new static();
    }

    public function fake(): self
    {
        Http::fake();

        return $this;
    }

    public function fakeListAdsResponse(): self
    {
        $this->fakeTokenProvider();

        $file = __DIR__ . '/../Stubs/Responses/fetchListAdsResponse.json';
        $response = file_get_contents($file);

        Http::fake([
             $this->endpoint .'*' => Http::sequence()
                                    ->push($response, 200)
                                    ->whenEmpty(Http::response('', 404)),
        ]);

        return $this;
    }

    public function fakeListAdsResponseWithPagination(): self
    {
        $this->fakeTokenProvider();

        $file = __DIR__ . '/../Stubs/Responses/fetchListAdsWithPaginationResponse.json';
        $responseWithPagination = file_get_contents($file);

        $file = __DIR__ . '/../Stubs/Responses/fetchListAdsResponse.json';
        $response = file_get_contents($file);

        Http::fake([
             $this->endpoint .'*' => Http::sequence()
                                    ->push($responseWithPagination, 200)
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
