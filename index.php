<?php
// 暗号化前データ
$data = '石川県金沢市';
// 暗号化方式
$method = 'des-ede3-cbc';
// 暗号キー
$key = 'fahjso;igfhreaughrajckvnkgn454894';

$encrypt_result = encrypt($data, $key, $method);
var_dump($encrypt_result);

$decrypt_result = decrypt($encrypt_result['encrypted'], $key, $method, $encrypt_result['iv']);
var_dump($decrypt_result);

/**
 * 3DES 暗号化関数
 * @param string $text      平文
 * @param string $key       鍵
 * @param string $method    暗号化方式
 * @param boolean $isBase64 base64エンコードするか
 * @return array
 */
function encrypt($text, $key, $method, $isBase64 = true) {
	// 初期化ベクトル生成
	$data['iv'] = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));
	$data['encrypted'] = openssl_encrypt($text, $method, $key, OPENSSL_RAW_DATA,  $data['iv']);

	if ($isBase64) {
		$data['encrypted'] = base64_encode($data['encrypted']);
	}

	return $data;
}


/**3DES 復号関数
 * @param string $encrypted 暗号文
 * @param string $key       鍵
 * @param string $method    暗号化方式
 * @param boolean $isBase64 base64エンコードされているか
 * @return string
 */
function decrypt($encrypted, $key, $method, $iv, $isBase64 = true) {
	if ($isBase64) {
		$encrypted = base64_decode($encrypted);
	}

	$decrypted = openssl_decrypt($encrypted, $method, $key, OPENSSL_RAW_DATA, $iv);

	return $decrypted;
}
