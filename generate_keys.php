<?php
$config = [
    'private_key_bits' => 2048,
    'private_key_type' => OPENSSL_KEYTYPE_RSA,
    'config' => 'C:/rayan/php/extras/ssl/openssl.cnf'
];
$res = openssl_pkey_new($config);
openssl_pkey_export($res, $privateKey, null, $config);
$publicKey = openssl_pkey_get_details($res)['key'];
if (!is_dir('config/jwt')) mkdir('config/jwt', 0777, true);
file_put_contents('config/jwt/private.pem', $privateKey);
file_put_contents('config/jwt/public.pem', $publicKey);
echo 'Clés générées avec succès !';