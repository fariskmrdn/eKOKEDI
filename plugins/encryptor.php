<?php
$secret_key = 'KolejVokasionalKualaSelangorMenerajuPendidikanTVETMuridBerkualiti';

function encrypt($string, $key) {
    $encrypted = openssl_encrypt($string, 'AES-128-ECB', $key);
    return base64_encode($encrypted);
}
function decrypt($string, $key) {
    $decoded = base64_decode($string);
    $decrypted = openssl_decrypt($decoded, 'AES-128-ECB', $key);
    return $decrypted;
}
