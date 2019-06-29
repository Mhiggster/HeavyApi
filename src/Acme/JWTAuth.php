<?php
namespace App\Acme;

use Firebase\JWT\JWT;

class JWTAuth
{
    public function render()
    {
        
        $privateKey = file_get_contents(__DIR__ . '/../../keys/key.pem');
        $publicKey = file_get_contents(__DIR__ . '/../../keys/public.pem');

        $token = array(
            "iss" => "unique.com",
            "user_id" => 1
        );
        
        
        $jwt = JWT::encode($token, $privateKey, 'RS256');


        $decoded = JWT::decode($jwt, $publicKey, array('RS256'));
        var_dump($decoded);

        return;
        http_response_code(201);
        return json_encode([
            'token' => $jwt,
        ]);
        http_response_code(403);
        return json_encode([
            401 => 'Unauthorized',
        ]);
    }
}