<?php

namespace EolabsIo\PinterestApi\Tests\Feature\Shared;

use Illuminate\Support\Facades\Http;
use EolabsIo\PinterestApi\Tests\TestCase;
use EolabsIo\PinterestApi\Domain\Shared\TokenProvider;
use EolabsIo\PinterestApi\Tests\Factories\TokenProviderFactory;
use EolabsIo\PinterestApi\Domain\Shared\Models\PinterestApiAuthorization;

class TokenProviderTest extends TestCase
{
    private $pinterestAPIAuthorization;

    protected function setUp(): void
    {
        parent::setUp();

        $this->pinterestAPIAuthorization = PinterestApiAuthorization::factory()->create([
            'client_id' =>  config('pinterest-api.clientId'),
            'scope' => 'boards:read',
        ]);

        TokenProviderFactory::new()->fakeRefreshTokenResponse();
    }

    /** @test */
    public function it_sends_the_correct_request_query()
    {
        $tokenProvider = new TokenProvider();

        $accessToken = $tokenProvider->getAccessToken();

        Http::assertSent(function ($request) {
            return $request->url() == "https://api.pinterest.com/v5/oauth/token" &&
                    $request->hasHeader('Authorization', 'Basic cGludGVyZXN0LmFwcGxpY2F0aW9uLW9hMi1jbGllbnQuYTkyNUVYQU1QTEUwYjMwMmJhZjNlNjQ0YTpFWEFNUExFMGIzMDJiYWYzZTY0NGEyYmFmM2U2MmJhZjNl') &&
                    $request->hasHeader('Content-Type', 'application/x-www-form-urlencoded') &&
                    $request['grant_type'] == 'refresh_token' &&
                    $request['refresh_token'] == $this->pinterestAPIAuthorization->refresh_token &&
                    $request['scope'] == 'boards:read';
        });

        expect($accessToken)->toBe('pina|IwEBIEvrawG0Thg2FVTvI3nKvfi9IN1BzQtUKBEBFv4Od4U_voYgt6SMP_qp8B5gLhWVyJQRHurH-NAmDi04WtSw');
    }
}
