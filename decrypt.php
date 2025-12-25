<?php
$encrypted = '98ZwvMHSUvkZ';
$ciphering = "AES-128-CTR";
$encryption_iv = '1234567891011121';
$encryption_key = "W3docs";
$options = 0;

$decrypted = openssl_decrypt($encrypted, $ciphering, $encryption_key, $options, $encryption_iv);
echo "Decrypted password: " . trim($decrypted);
?>
