<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OracleObjectStorageService
{
    protected $namespace;
    protected $bucket;
    protected $accessKey;
    protected $secretKey;
    protected $region;
    protected $endpoint;

    public function __construct()
    {
        $this->namespace = env('ORACLE_TENANCY_NAMESPACE');
        $this->bucket = env('AWS_BUCKET');
        $this->accessKey = env('AWS_ACCESS_KEY_ID');
        $this->secretKey = env('AWS_SECRET_ACCESS_KEY');
        $this->region = env('AWS_DEFAULT_REGION');
        $this->endpoint = env('AWS_ENDPOINT');
    }

    public function upload($filename, $fileContents)
    {
        $objectName = 'images/' . basename($filename);
        $host = parse_url($this->endpoint, PHP_URL_HOST);
        $date = gmdate('D, d M Y H:i:s T');

        $canonicalResource = "/n/{$this->namespace}/b/{$this->bucket}/o/{$objectName}";
        $stringToSign = "PUT\n\napplication/octet-stream\n{$date}\n{$canonicalResource}";
        $signature = base64_encode(hash_hmac('sha1', $stringToSign, $this->secretKey, true));
        $authorization = "OSS {$this->accessKey}:{$signature}";

        $url = "{$this->endpoint}/n/{$this->namespace}/b/{$this->bucket}/o/" . rawurlencode($objectName);

        $response = Http::withHeaders([
            'Date' => $date,
            'Authorization' => $authorization,
            'Content-Type' => 'application/octet-stream',
        ])->withBody($fileContents, 'application/octet-stream')
          ->put($url);
        
        if (!$response->successful()) {
            \Log::error('ファイル保存エラー: ' . $response->status() . ' | ' . mb_convert_encoding($response->body(), 'UTF-8', 'auto'));
            return false;
        }

        return $url;
    }
}
