<?php
//pdf.php;
require_once 'dompdf1/ptf/autoload.inc.php';
use Dompdf\Dompdf;

class Pdf extends Dompdf{
 public function __construct() {
        parent::__construct();
    }
}

?>