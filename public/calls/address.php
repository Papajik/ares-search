<?php


use Papajik\AresSearch\Repository\RssRepository;
use Papajik\AresSearch\Service\Database;

$query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
if (!empty($query)) {
    parse_str($query, $output);
    $id = $output['id'];
    $rssRepository = new RssRepository(Database::getInstance());
    $item = $rssRepository->getItem($id);
    if (isset($item)) {
        $file = file_get_contents('./view/address.php');

        $replacements = array(
            "ADDRESS" => $item->getAddress(),
            "CITY" => $item->getCity(),
            "POST" => $item->getPostalCode(),
            "COUNTRY" => $item->getCountry(),
            "PHONE" => $item->getPhone(),
            'UAD' => $item->getAddressUpdate()->format('Y-m-d H:i:s'),
            'UCT' => $item->getCityUpdate()->format('Y-m-d H:i:s'),
            'UOK' => $item->getCountryUpdate()->format('Y-m-d H:i:s'),
            'ID' => $id
        );

        // https://stackoverflow.com/a/5815269/6152829
        foreach ($replacements as $key => $m) {
            $file = str_replace("{_" . $key . "_}", $m, $file);
        }
        echo $file;
        return;
    }
}

echo "Zadaná adresa není v záznamu";
http_response_code(404);