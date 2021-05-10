<?php
$file = "schedule.pdf";
  
  // We will be outputting a PDF
  header('Content-Type: application/pdf');
    
  // It will be called downloaded.pdf
  header('Content-Disposition: attachment; filename="'.$file.'"');

  header("Content-Length: " . filesize('../DataOps/'.$file));

 readfile('../DataOps/'.$file);
  ?>