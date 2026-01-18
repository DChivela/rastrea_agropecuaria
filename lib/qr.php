<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

function gerarQRCode(string $conteudo, string $path): void
{
    // garante pasta existente
    $dir = dirname($path);
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    $options = new QROptions([
        'outputType' => QRCode::OUTPUT_IMAGE_PNG,
        'eccLevel'   => QRCode::ECC_L,
        'scale'      => 6,
        'imageBase64'=> false, // MUITO IMPORTANTE
    ]);

    $qrcode = new QRCode($options);

    // gera binário puro
    $png = $qrcode->render($conteudo);

    // grava como binário (força)
    $fp = fopen($path, 'wb');
    fwrite($fp, $png);
    fclose($fp);
}
