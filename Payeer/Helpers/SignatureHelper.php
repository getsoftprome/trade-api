<?php


namespace Payeer\Helpers;


class SignatureHelper
{
    private string $apiKey;
    private string $apiId;

    public function __construct(string $apiKey, string $apiId){
        $this->apiKey = $apiKey;
        $this->apiId = $apiId;
    }

    public function setApiKey(string $apiKey){
        $this->apiKey = $apiKey;
    }

    public function getApiKey(){
        return $this->apiKey;
    }

    public function setApiId(string $apiId){
        $this->apiId = $apiId;
    }

    public function getApiId(){
        return $this->apiId;
    }


    public function getSignature(string $method, array $params = []){

        $post = json_encode($params);
        $sign = hash_hmac('sha256', $method.$post, $this->apiKey);

        return $sign;
    }

}