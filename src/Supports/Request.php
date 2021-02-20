<?php

namespace Mr687\ZoomMeeting\Supports;

use Firebase\JWT\JWT;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

abstract class Request
{
  protected $client;
  protected $response;
  protected $successful;
  protected $json;

  protected $_headers;
  protected $_path;
  protected $_fields;

  protected $uri = 'https://api.zoom.us/v2/';

  public function __construct()
  {
    $this->headers([
      'Authorization' => 'Bearer ' . $this->generateToken(),
      'Content-Type' => 'application/json',
      'Accept' => 'application/json',
    ]);
    $this->client = Http::withHeaders($this->_headers)
      ->baseUrl($this->uri);
  }

  protected function request($httpMethod = 'get')
  {
    $this->response = Http::withHeaders($this->_headers)
      ->{$httpMethod}(
        $this->uri . $this->_path,
        $this->_fields
      )
      ->throw();
    $this->successful = $this->response->successful();
    $this->json = collect($this->response->json());
    return !$this->response->failed() ? $this->json : null;
  }

  public function generateToken(): string
  {
    $token = [
      'iss' => config('zoom.api_key'),
      'exp' => time() * 100,
    ];

    return JWT::encode($token, config('zoom.api_secret'));
  }

  public function __call($method, $args)
  {
    $property = '_' . Str::camel($method);
    if (property_exists($this, $property)) {
      $this->{$property} = $args[0];
      return $this;
    }

    if (in_array($method, ['get', 'post', 'patch', 'put'])) {
      return $this->request($method);
    }
  }
}
