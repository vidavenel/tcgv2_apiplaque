<?php


namespace Tcgv2\Apiplaque;


use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ApiplaqueService
{
    private $token;

    const BASE_SERVICE_URI = "http://api.apiplaqueimmatriculation.com/carte-grise";
    const FORMAT = "json";

    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * @param $plaque
     * @throws Exception
     */
    public function getInfo($plaque)
    {
        $clientHttp = new Client(['base_uri' => self::BASE_SERVICE_URI,]);

        try {
            $response = $clientHttp->request('GET', '', [
                'headers' => [
                    'Accept'     => 'application/json',
                ],
                'query' => [
                    'immatriculation' => $plaque,
                    'format' => self::FORMAT,
                    'token' => $this->token
                ],
                'timeout' => 20,
                'connect_timeout' => 20,
                'read_timeout' => 20
            ]);

            $result = strstr($response->getBody()->getContents(), '{');
            $result = json_decode($result, true);

            if (array_key_exists('result', $result['data']))
                return $result['data']['result'];

            return $result['data'];
        } catch (GuzzleException $e) {
            Log::error($e->getMessage());
            throw new Exception('Erreur de communication avec le service apiplaque: '.$e->getMessage());
        }
    }
}
