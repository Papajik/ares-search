<?php


require_once '../../vendor/autoload.php';


use Papajik\AresSearch\Repository\SubjectRepository;
use Papajik\AresSearch\Service\Database;

$res = array();

if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $subjectRepository = new SubjectRepository(Database::getInstance());
    $subject = $subjectRepository->loadSubject($_POST['id']);

    if ($subject == null) {
        // No subject found
        $res['status'] = 'ERR';
        $res['error'] = 'Subjekt neexistuje';
    } else {
        $res['status'] = 'OK';
        $res['subject'] = $subject->toArray();
    }
} else {
    $res['status'] = 'ERR';
    $res['error'] = "Chyba v parametru 'id'";
}

echo json_encode($res);