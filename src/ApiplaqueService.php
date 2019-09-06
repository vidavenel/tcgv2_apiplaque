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
                'query' => [
                    'immatriculation' => $plaque,
                    'format' => self::FORMAT,
                    'token' => $this->token
                ],
                'timeout' => 5
            ]);
        } catch (GuzzleException $e) {
            throw new Exception('Erreur de communication avec le service apiplaque');
        }

        $result = json_decode($response->getBody()->getContents(), true);
        return $result['data']['result'];
    }
}