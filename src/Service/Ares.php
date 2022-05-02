<?php

namespace Papajik\AresSearch\Service;

use Papajik\AresSearch\Classes\DeliveryAddress;
use Papajik\AresSearch\Classes\Subject;

class Ares
{
    const ARES_URL = "https://wwwinfo.mfcr.cz/cgi-bin/ares/darv_bas.cgi?ico=";


    function parseSubject($ico): ?Subject
    {
        $file = @file_get_contents(self::ARES_URL . $ico);
        if (!$file) {
            return null;
        }

        $xml = simplexml_load_string($file);
        $ns = $xml->getDocNamespaces();
        $data = $xml->children($ns['are'])->children($ns['D']);

        // ARES returned error
        if ($data->E) {
            return null;
        }
        $elements = $data->VBAS;
        // Valid data
        if ($elements) {
            return new Subject(
                ico: $elements->ICO,
                dic: $elements->DIC,
                name: $elements->OF,
                creation_date: $elements->DV,
                deliveryAddress: new DeliveryAddress(
                    $elements->AD->UC,
                    $elements->AD->PB
                ),
                search_date: date("Y-m-d H:i:s")
            );
        }
        return null;
    }
}









