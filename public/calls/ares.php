<?php

require_once '../../vendor/autoload.php';

use Papajik\AresSearch\Repository\SubjectRepository;
use Papajik\AresSearch\Service\Ares;
use Papajik\AresSearch\Service\Database;


$ares = new Ares();
$res = array();

if (isset($_POST['ico']) && $_POST['ico'] != "") {
    if (!is_numeric($_POST['ico'])) {
        // Wrong format
        $res['status'] = 'ERR';
        $res['errorData'] = $_POST['ico'];
        $res['error'] = 'IČO není ve správném formátu';
    } else {
        // ICO is only numbers
        $subject = $ares->parseSubject($_POST['ico']);
        if ($subject == null) {
            // No subject found
            $res['status'] = 'ERR';
            $res['error'] = 'Subjekt neexistuje';
        } else {
            $res['status'] = 'OK';
            $res['data'] = $subject->toArray();
            $subjectRepository = new SubjectRepository(Database::getInstance());
            $subjectRepository->saveSubject($subject);
        }
    }
} else {
    $res['status'] = 'ERR';
    $res['errorData'] = $_POST['ico'];
    $res['error'] = 'IČO není vyplněno';
}

echo json_encode($res);
