<?php
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;

function gerarQRCode($codigo, $path)
{
    $url = "http://localhost:3000/views/public/lote.php?code=" . $codigo;

    $result = Builder::create()
        ->writer(new PngWriter())
        ->data($url)
        ->size(300)
        ->margin(10)
        ->build();

    $result->saveToFile($path);
}
