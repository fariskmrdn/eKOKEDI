<?php

setlocale(LC_TIME, 'ms_MY.utf8');

$newDate = date("d F Y");

// Convert the month name from English to Malay
$monthsEnglish = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
$monthsMalay = array('Januari', 'Februari', 'Mac', 'April', 'Mei', 'Jun', 'Julai', 'Ogos', 'September', 'Oktober', 'November', 'Disember');

$newDateMalay = str_replace($monthsEnglish, $monthsMalay, $newDate);

// DOMPDF
require_once('../../config/config.php');
require_once('../../plugins/encryptor.php');

require_once '../../plugins/dompdf/vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

if (isset($_REQUEST['iz'])) {
    $id = decrypt($_REQUEST['iz'], $secret_key);
}

$stmt = $pdo->prepare("SELECT * FROM occupants
JOIN occupants_profiles ON occupants.occ_id = occupants_profiles.occ_id
JOIN programme ON occupants.programme_id = programme.programme_id
JOIN rooms ON occupants.room_id = rooms.room_id
WHERE occupants.occ_id = ?");
$stmt->execute([$id]);
$student = $stmt->fetch();

ob_start();
require('template.php');
$html = ob_get_contents();
ob_clean();

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'potrait');
$dompdf->render();
$dompdf->stream('SURAT TAWARAN KOLEJ KEDIAMAN.pdf', array("Attachment" => 0));
$pdf_content = $dompdf->output();