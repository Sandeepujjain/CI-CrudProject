<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class MyJwt
{
    private $CI;
    private $secret_key = '';
    private $token_timeout = 60 * 60 * 24; // 24 hours

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->secret_key = $_ENV['SECRET_KEY'];
    }

    public function generateToken($userdata)
    {
        $token = $userdata;

        return JWT::encode($token, $this->secret_key, 'HS256');
    }
    public function validateToken($token)
    {
        $result = $this->decodeToken($token);
        if ($result === false) {
            return false;
        } else {
            if (isset($result['exp']) && $result['exp'] >= time()) {
                $_SESSION = array_merge($_SESSION, $result);
                return true;
            } else {
                return false; // Token is expired
            }
        }
    }

    public function decodeToken($token)
    {
        try {
            return \Firebase\JWT\JWT::decode($token, new \Firebase\JWT\Key($this->secret_key, 'HS256'));
        } catch (Exception $e) {
            return false;
        }
    }

    public function getEmployeeId($token)
    {
        $decoded_token = $this->decodeToken($token);

        // Check if decoding was successful and if employee_id exists
        if ($decoded_token !== false && isset($decoded_token->employee_id)) {
            return $decoded_token->employee_id;
        } else {
            // Token decoding failed or employee_id not found
            return false;
        }
    }


    public function getstudentId($token)
    {
        $decoded_token = $this->decodeToken($token);

        // Check if decoding was successful and if employee_id exists
        if ($decoded_token !== false && isset($decoded_token)) {
            return $decoded_token;
        } else {
            // Token decoding failed or employee_id not found
            return false;
        }
    }


    public function getAlumniId($token)
    {
        $decoded_token = $this->decodeToken($token);
        // Check if decoding was successful and if alumni_id exists
        if ($decoded_token !== false && isset($decoded_token)) {
            return $decoded_token;
        } else {
            // Token decoding failed or alumni_id not found
            return false;
        }
    }
}
