<?php
// Test Connection to Midtrans
$url = "https://app.midtrans.com/snap/v1/transactions";

echo "Testing connection to $url...\n";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_VERBOSE, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Try with false first
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

// Set Auth Header (random key just to see response)
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Accept: application/json',
    'Authorization: Basic ' . base64_encode('SB-Mid-server-TEST:')
]);

$response = curl_exec($ch);
$error = curl_error($ch);
$errno = curl_errno($ch);
$info = curl_getinfo($ch);

curl_close($ch);

if ($errno) {
    echo "FAIL: cURL Error ($errno): $error\n";
    if ($errno == 10023) {
        echo "Diagnosis: 10023 = WSAEWOULDBLOCK. This is a network socket timeout.\n";
    }
} else {
    echo "SUCCESS: HTTP Code: " . $info['http_code'] . "\n";
    echo "Response: " . substr($response, 0, 100) . "...\n";
}
