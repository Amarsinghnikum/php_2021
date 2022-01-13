<?php 
   for($i=1;$i<=10;$i++){
    $pdfheading =  $_POST['upload_pdf_heading_'.$i];
    $pdfimage11 = $_FILES['upload_pdf_image_'.$i]['name'];
    if($pdfheading!=''){
        $pdfheading[] = $pdfimage11;
    }
}
?>