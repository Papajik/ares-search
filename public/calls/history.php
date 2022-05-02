<?php
require_once '../../vendor/autoload.php';


use Papajik\AresSearch\Repository\SubjectRepository;
use Papajik\AresSearch\Service\Database;


$res = array();

if (!isset($_POST['limit'])) {
    echoError("Chybí povinný parametr 'limit'");
    return;
}
if (!isset($_POST['offset'])) {
    echoError("Chybí povinný parametr 'offset'");
    return;
}
if (!isset($_POST['order_by'])) {
    echoError("Chybí povinný parametr 'order_by'");
    return;
}
if (!isset($_POST['direction'])) {
    echoError("Chybí povinný parametr 'direction'");
    return;
}


$limit = $_POST['limit'];
$offset = $_POST['offset'];
$direction = filter_var($_POST['direction'], FILTER_VALIDATE_BOOLEAN);

if (is_numeric($limit) && is_numeric($offset)) {
    $subjectRepository = new SubjectRepository(Database::getInstance());
    $subjects = $subjectRepository->loadSubjects($_POST['order_by'], $direction, $offset, $limit, $_POST['filter']);
    $res['data']['max_rows'] = $subjectRepository->getSubjectsCount($_POST['filter']);
    $res['data']['subjects'] = [];
    foreach ($subjects as $key => $subject) {
        $res['data']['subjects'][] = [
            'id' => $key,
            'name' => $subject->getName(),
            'ico' => $subject->getIco(),
            'search_date' => $subject->getSearchDate()
        ];
    }
    $res['status'] = 'OK';
} else {
    $res['status'] = 'ERR';
    $res['error'] = "Chybná hodnota 'limit' nebo 'offset' parametru";
}


function echoError(string $message): void
{
    echo json_encode([
        'status' => 'ERR',
        'error' => $message
    ]);
}

echo json_encode($res);