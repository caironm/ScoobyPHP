<?php

namespace Scooby\Helpers;

use Zttp\Zttp;

class HttpClient
{
    public static function get(string $url, array $param = [], array $headers = [], array $options = [])
    {
        return (object) [
            'headers' => Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->get($url, ['headers' => ['content-type' => ['application/x-www-form-urlencoded']]], $param)->headers(),
            'body' => Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->get($url, $param)->json(),
            'ok' => Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->get($url, $param)->isSuccess(),
            'status' => Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->get($url, $param)->status(),
            'serverError' => Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->get($url, $param)->isServerError(),
            'clientError' => Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->get($url, $param)->isClientError(),
        ];
    }

    public static function post(string $url, array $param = [], array $headers = [], array $options = [])
    {
        return (object) [
            'headers' => Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->post($url, ['headers' => ['content-type' => ['application/x-www-form-urlencoded']]], $param)->headers(),
            'body' => Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->post($url, $param)->json(),
            'ok' => Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->post($url, $param)->isSuccess(),
            'status' => Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->post($url, $param)->status(),
            'serverError' => Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->post($url, $param)->isServerError(),
            'clientError' => Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->post($url, $param)->isClientError(),
        ];
    }

    public static function put(string $url, array $param = [], array $headers = [], array $options = [])
    {
        return (object) [
            'headers' => Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->put($url, ['headers' => ['content-type' => ['application/x-www-form-urlencoded']]], $param)->headers(),
            'body' => Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->put($url, $param)->json(),
            'ok' => Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->put($url, $param)->isSuccess(),
            'status' => Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->put($url, $param)->status(),
            'serverError' => Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->put($url, $param)->isServerError(),
            'clientError' => Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->put($url, $param)->isClientError(),
        ];
    }

    public static function delete(string $url, array $param = [], array $headers = [], array $options = [])
    {
        return (object) [
            'headers' => Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->delete($url, ['headers' => ['content-type' => ['application/x-www-form-urlencoded']]], $param)->headers(),
            'body' => Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->delete($url, $param)->json(),
            'ok' => Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->delete($url, $param)->isSuccess(),
            'status' => Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->delete($url, $param)->status(),
            'serverError' => Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->delete($url, $param)->isServerError(),
            'clientError' => Zttp::withOptions($options)->withHeaders($headers)->asMultipart()->asFormParams()->delete($url, $param)->isClientError(),
        ];
    }
}
