<?php

namespace EolabsIo\PinterestApi\Domain\Shared;

use Illuminate\Support\Collection;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use EolabsIo\PinterestApi\Domain\Shared\TokenProvider;
use EolabsIo\PinterestApi\Support\Concerns\Methodable;
use EolabsIo\PinterestApi\Support\Concerns\Paginatable;

abstract class PinterestApiCore
{
    use Paginatable,
        Methodable;

    /** @var Illuminate\Http\Client\Response */
    private $response;

    /** @var Illuminate\Support\Collection */
    private $results;

    /**
     * @var TokenProvider
     */
    protected $tokenProvider;


    public function __construct()
    {
        $this->tokenProvider = new TokenProvider();
        $this->results = new Collection();
        $this->clearPagination();
    }

    public function beforeFetch()
    {
    }

    public function fetch()
    {
        $this->beforeFetch();

        $headers = $this->getHeaders();
        $baseUrl = $this->getBaseUrl();
        $endpoint = $this->getEndpoint();
        $data = array_merge($this->getPaginationParameters(), $this->getParameters());
        $method = $this->getMethod();

        try {
            $response = Http::withHeaders($headers)
                            ->baseUrl($baseUrl)
                            ->{$method}($endpoint, $data)
                            ->throw();
        } catch (\Exception $exception) {
            // handle exception
            $this->handleException($exception);
        }

        return $this->processResponse($response);
    }

    protected function getHeaders(array $headers = []): array
    {
        $auth = [];
        if ($this->tokenProvider) {
            $auth = $this->getHeadersForBearerToken($this->tokenProvider->getAccessToken());
        }

        // $clientIdHeaders = $this->getHeadersForClientId();

        return array_merge($auth, $headers);
    }

    public function getBaseUrl(): string
    {
        return 'https://api.pinterest.com/';
    }

    abstract public function getEndpoint(): string;

    public function getParameters(): array
    {
        return [];
    }

    /**
     * @return array
     */
    protected function getHeadersForBearerToken($token)
    {
        return [
            'Authorization' => "Bearer {$token}",
        ];
    }

    public function handleException(RequestException $requestException)
    {
        // dd($requestException);
        throw $requestException;
    }

    public function processResponse(Response $response)
    {
        $this->response = $response;

        $resultsFromResponse = $this->getResultsFromResponse($response);

        $this->checkForPagination($resultsFromResponse);
        $this->results = $this->parseResults($resultsFromResponse);

        return $this->getResults();
    }

    public function getResultsFromResponse(Response $response): Collection
    {
        return $response->collect();
    }

    public function parseResults(Collection $results): Collection
    {
        return $results;
    }

    public function getResults()
    {
        return $this->results;
    }
}
