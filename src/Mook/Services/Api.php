<?php

namespace Mook\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Mook\Configs\Contracts\Credentials;
use Mook\Core\Http\MoodleRequest;
use function PHPUnit\TestFixture\func;

class Api
{
    private Credentials  $credentials;

    private Client $http;

    private MoodleRequest $request;

    public function __construct(Credentials $credentials)
    {
        $this->credentials = $credentials;

        $this->http = new Client([
            'base_uri' => $this->credentials->uri(),
            'headers' => [
                'accept' => 'application/json'
            ]
        ]);
    }

    public function setRequest(MoodleRequest $request): Api
    {
        $this->request = $request;
        return $this;
    }

    private function getFullUrl(): string
    {
        if (is_null($this->credentials->path()) || empty($this->credentials->path())) {
            return sprintf(
                "/webservice/rest/server.php?moodlewsrestformat=json&wstoken=%s&wsfunction=%s",
                $this->credentials->token(),
                $this->request->action()
            );
        }

        return sprintf(
            "%s/webservice/rest/server.php?moodlewsrestformat=json&wstoken=%s&wsfunction=%s",
            is_null($this->credentials->path()) ? '' : "/{$this->credentials->path()}",
            $this->credentials->token(),
            $this->request->action()
        );
    }

    private function handleResponse(Response $response): array
    {
        $responseBody = json_decode($response->getBody()->getContents());

        if (isset($responseBody->exception)) {
            throw new \Exception($responseBody->message, 400);
        }

        if (is_null($responseBody)) {
            return [];
        }

        if (isset($responseBody->warnings)) {
            throw new \Exception($responseBody->warnings[0]->message, 400);
        }

        return $responseBody;
    }

    private function prepareBody(): array
    {
        return collect($this->request->body())->map(function($categories) {
            return collect($categories)->map(function ($category) {
                return array_filter($category, fn($value) => !is_null($value));
            });
        })->toArray();
    }

    public function call()
    {
        try {

            $response = $this->http->request(
                'POST',
                $this->getFullUrl(),
                [
                    'form_params' => $this->prepareBody()
                ]
            );
            return $this->handleResponse($response);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}