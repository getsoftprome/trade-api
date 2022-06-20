<?php

namespace Payeer\Request;

use Payeer\Helpers\SignatureHelper;

class Request
{

    protected string $apiUrl = 'https://payeer.com/api/trade/';
    private SignatureHelper $signatureHelper;

    public function __construct(SignatureHelper $signatureHelper){
        $this->signatureHelper = $signatureHelper;
    }

    public function get($method, $options = [])
    {

        $httpRequest = empty($options) ? '' : '?'.http_build_query($options);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl . $method.$httpRequest);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $response = curl_exec($ch);
        curl_close($ch);




        $arResponse = json_decode($response, true);

        return $arResponse;
    }

    public function post($method, $options = [])
    {
        $options['ts'] = round(microtime(true) * 1000);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl . $method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($options));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "API-ID: ".$this->signatureHelper->getApiId(),
            "API-SIGN: ".$this->signatureHelper->getSignature($method, $options)
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        $arResponse = json_decode($response, true);

        if ($arResponse['success'] !== true)
        {
            throw new Exception($arResponse['error']['code']);
        }

        return $arResponse;
    }

}
