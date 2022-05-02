<?php
require_once '../../vendor/autoload.php';


use Papajik\AresSearch\Repository\RssRepository;
use Papajik\AresSearch\Service\Database;
use Papajik\AresSearch\Service\Mail;
use Papajik\AresSearch\Service\Rss;

$res = [];

$emailAddress = $_POST['mail'];
$id = $_POST['id'];

if (isset($id) && is_numeric($id) && isset($emailAddress) && filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
    $rssRepository = new RssRepository(Database::getInstance());
    $rssService = new Rss();
    $item = $rssRepository->getItem($id);

    if (isset($item)) {
        $html = $rssService->createHtmlDetail($item);
        $html .= "<a href='//" . $_SERVER['SERVER_NAME'] . "/address?id=" . $id . "'>Více informací</a>";

        $mail = Mail::getInstance();
        $isSend = $mail->sendMail($emailAddress, "Detail adresy", $html);

        if ($isSend == 1) {
            $res['status'] = 'OK';
            $res['message'] = "E-mail poslán";
        } else {
            $res['error'] = "E-mail nemohl být poslán";
            $res['error'] = $isSend;
        }

    } else {
        $res['status'] = 'ERR';
        $res['error'] = "Nenalezena adresa pro dané ID";
    }


} else {
    $res['status'] = 'ERR';
    $res['error'] = "Chybné parametry";
}


echo json_encode($res);