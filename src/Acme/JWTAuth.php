<?php
namespace Pool\Acme;

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
        $this->privateKey = file_get_contents(__DIR__ . '/../../keys/private_key.pem');
        $this->publicKey = file_get_contents(__DIR__ . '/../../keys/public_key.pem');

        $this->payload = [
            "iss" => "unique.com",
        ];

        $this->algorithm = 'RS256';
    }

    /**
     * Undocumented function
     *
     * @param integer $user_id
     * @return JWTAuth
     */
    public function makePayload(int $user_id) : JWTAuth
    {
        $this->payload['user_id'] = $user_id;
        return $this;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function render()
    {
        http_response_code(403);
        return json_encode([
            401 => 'Unauthorized',
        ]);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function encode()
    {
        return JWT::encode($this->payload, $this->privateKey, $this->algorithm);
    }

    /**
     * Undocumented function
     *
     * @param [type] $token
     * @return void
     */
    public function decode($token)
    {
        return JWT::decode($token, $this->publicKey, array($this->algorithm));
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    private function makeAnswer()
    {
        // for what i dont remember хотя я вспомнил для статуса ответов
    }
}
