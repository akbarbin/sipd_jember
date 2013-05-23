<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=" . $fileNameToExport . "_" . date('d-m-Y') . ".xls");
header("Content-Description: Generated Report");
header("Content-Transfer-Encoding: binary");
?>
