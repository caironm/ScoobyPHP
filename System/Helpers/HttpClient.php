<?php

namespace Scooby\Helpers;

use Zttp\Zttp;

class HttpClient
{
    public static function get(string $url, array $param = [], array $headers = [], array $options = [])
    {
        $response = Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->get($url, $param);
        return (object) [
            'headers' => $response->headers(),
            'body' => $response->json(),
            'ok' => $response->isSuccess(),
            'status' => $response->status(),
            'serverError' => $response->isServerError(),
            'clientError' => $response->isClientError(),
        ];
    }

    public static function post(string $url, array $param = [], array $headers = [], array $options = [])
    {
        $response = Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->post($url, $param);
        return (object) [
            'headers' => $response->headers(),
            'body' => $response->json(),
            'ok' => $response->isSuccess(),
            'status' => $response->status(),
            'serverError' => $response->isServerError(),
            'clientError' => $response->isClientError(),
        ];
    }

    public static function put(string $url, array $param = [], array $headers = [], array $options = [])
    {
        $response = Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->put($url, $param);
        return (object) [
            'headers' => $response->headers(),
            'body' => $response->json(),
            'ok' => $response->isSuccess(),
            'status' => $response->status(),
            'serverError' => $response->isServerError(),
            'clientError' => $response->isClientError(),
        ];
    }

    public static function delete(string $url, array $param = [], array $headers = [], array $options = [])
    {
        $response = Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->delete($url, $param);
        return (object) [
            'headers' => $response->headers(),
            'body' => $response->json(),
            'ok' => $response->isSuccess(),
            'status' => $response->status(),
            'serverError' => $response->isServerError(),
            'clientError' => $response->isClientError(),
        ];
    }
}
