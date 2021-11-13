<?php
// 暗号化前データ
$data = '石川県金沢市';
// 暗号化方式
$method = 'des-ede3-cbc';
// 暗号キー
$key = 'fahjso;igfhreaughrajckvnkgn454894';
// 初期化ベクトル
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));

// 暗号化開始
$crypted = openssl_encrypt($data, $method, $key, OPENSSL_RAW_DATA, $iv);

var_dump($crypted);

// 復号開始
$decrypted = openssl_decrypt($crypted, $method, $key, OPENSSL_RAW_DATA, $iv);

var_dump($decrypted);
