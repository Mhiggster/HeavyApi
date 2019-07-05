<?php
namespace App\Acme;

use Firebase\JWT\JWT;

class JWTAuth
{
    /**
     * Undocumented variable
     *
     * @var [type]
     */
    private $privateKey;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    private $publicKey;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    private $algorithm;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    private $payload;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    private $token;

    /**
     * Undocumented function
     */
    public function __construct()
    {
        $this->privateKey = file_get_contents(__DIR__ . '/../../keys/key.pem');
        $this->publicKey = file_get_contents(__DIR__ . '/../../keys/public.pem');

        $this->payload = [
            "iss" => "unique.com",
        ];

        $this->algorithm = 'RS256';
    }

    public function makePayload(int $user_id) : void
    {
        $this->payload['user_id'] = $user_id;
    }

    public function render()
    {
        http_response_code(403);
        return json_encode([
            401 => 'Unauthorized',
        ]);
    }


    public function encode()
    {
        $this->token = JWT::encode($payload, $this->privateKey, $this->algorithm);
    }


    public function decode()
    {
        $decoded = JWT::decode($this->token, $this->publicKey, array($this->algorithm));
    }

    // for what i dont remember хотя я вспомнил для статуса ответов
    private function makeAnswer()
    {

    }
}