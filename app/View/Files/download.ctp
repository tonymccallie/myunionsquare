<?php
$filename = $_SERVER['DOCUMENT_ROOT'] . $this->webroot . 'app/webroot/uploads/'.$file['File']['folder_id'].'/'.$file['File']['filename'];
if (file_exists($filename)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.$file['File']['filename'].'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename));
    readfile($file);
    exit;
}
?>