<?php

namespace App\Services;

class OracleSignatureService
{
    private $tenancyId;
    private $userId;
    private $keyFingerprint;
    private $privateKeyPath;

    public function __construct()
    {
        $this->tenancyId = env('ORACLE_TENANCY_ID');
        $this->userId = env('ORACLE_USER_ID');
        $this->keyFingerprint = env('ORACLE_KEY_FINGERPRINT');
        $this->privateKeyPath = storage_path('keys/megumiKey.pem');
    }

    public function createAuthorizationHeader(string $method, string $host, string $path, string $date, string $contentType = 'application/octet-stream'): string
    {
        $signingString = "(request-target): {$method} {$path}\nhost: {$host}\ndate: {$date}\ncontent-type: {$contentType}";
        
        $privateKey = openssl_pkey_get_private(file_get_contents($this->privateKeyPath));
        
        openssl_sign($signingString, $signature, $privateKey, OPENSSL_ALGO_SHA256);

        $signature = base64_encode($signature);

        $keyId = "{$this->tenancyId}/{$this->userId}/{$this->keyFingerprint}";

        return sprintf(
            'Signature version="1",keyId="%s",algorithm="rsa-sha256",headers="(request-target) host date content-type",signature="%s"',
            $keyId,
            $signature
        );
    }
}
