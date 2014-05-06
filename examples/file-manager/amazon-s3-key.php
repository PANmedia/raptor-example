<?php
// Important variables that will be used throughout this example
$bucket = '';
$buckerUrl = '';

// These can be found on your Account page, under Security Credentials > Access Keys
$accessKeyId = '';
$secret = '';

if (!$bucket || !$buckerUrl || !$accessKeyId || !$secret) {
    die('Amazon S3 credentials not setup in ' . basename(__FILE__));
}

$policy = base64_encode(json_encode([
    'expiration' => date('Y-m-d\TH:i:s.000\Z', strtotime('+1 day')),
    'conditions' => [
        ['bucket' => $bucket],
        ['acl' => 'public-read'],
        ['starts-with', '$key', ''],
        ['starts-with', '$Content-Type', ''],
        ['starts-with', '$name', ''],
        ['starts-with', '$Filename', ''],
    ]
]));

$signature = base64_encode(hash_hmac('sha1', $policy, $secret, true));
