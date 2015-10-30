<?php
require 'pdfcrowd.php';

try
{   
    // create an API client instance
    $client = new Pdfcrowd("username", "apikey");

    // convert a web page and store the generated PDF into a $pdf variable
    $pdf = $client->convertURI('http://localhost/sms10/PU/newpo.php?proj=2&&poid=2%20-%201');

    // set HTTP response headers
    header("Content-Type: application/pdf");
    header("Cache-Control: max-age=0");
    header("Accept-Ranges: none");
    header("Content-Disposition: attachment; filename=\"po.pdf\"");

    // send the generated PDF 
    echo $pdf;
}
catch(PdfcrowdException $why)
{
    echo "Pdfcrowd Error: " . $why;
}
?>