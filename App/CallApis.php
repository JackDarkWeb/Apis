<?php
namespace App;

abstract class CallApis
{
    /**
     * @var string
     */
    private  $endpoint;

    /**
     * @param string $endpoint
     * @return array|null
     */
    protected function callApi(string $endpoint): ?array{

        $this->endpoint =  $endpoint;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER =>false,
            //CURLOPT_CAINFO => dirname(__DIR__).DIRECTORY_SEPARATOR."cert.cer",
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));
        $data = json_decode(curl_exec($curl), true);
        $err = curl_error($curl);

        curl_close($curl);

        return ['data' => $data, 'err' => $err];
    }
}