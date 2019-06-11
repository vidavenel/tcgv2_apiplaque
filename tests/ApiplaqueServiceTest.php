<?php

namespace Tcgv2\Apiplaque\Tests;

use PHPUnit\Framework\TestCase;
use Tcgv2\Apiplaque\ApiplaqueService;

class ApiplaqueServiceTest extends TestCase
{
    const TOKEN_TEST = "demoxM";

    public function testGetInfoNoErreur()
    {
        $service = new ApiplaqueService(self::TOKEN_TEST);
        $result = $service->getInfo("EX-423-GB");

        $this->assertEquals('', $result['erreur']);
    }

    public function testGetInfoArrayConform()
    {
        $service = new ApiplaqueService(self::TOKEN_TEST);
        $result = $service->getInfo("EX-423-GB");

        $mandatory_keys = ['immat', 'co2', 'energieNGC', 'genreVCGNGC', 'puisFisc', 'date1erCir_fr'];

        foreach ($mandatory_keys as $key) {
            $this->assertArrayHasKey($key, $result);
        }
    }
}
