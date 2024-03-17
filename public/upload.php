<?php
    
    require_once '../vendor/autoload.php';
    
    use Dompdf\Dompdf;
    
    if(isset($_POST) && isset($_FILES)){
        
        $filename = $_FILES["file"]["name"];
        $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $tmp_file = $_FILES["file"]["tmp_name"];
        $content = file_get_contents($tmp_file);
        
        $pdf = new Dompdf;
        $pdf->loadHtml($content);
        $pdf->setPaper("letter");
        $pdf->render();
        $pdf->stream("{$filename}.pdf", ["Attachment" => true]);
    }
