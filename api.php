<?php
define('APIKEYDİYORUMSANAXD', 'apikey 6yTQcA9Q4mtXLMs5f6sOkb:0xHiThEMxvFeeW5STSJh5U');

$city = isset($_GET['city']) ? trim($_GET['city']) : null;

if (!$city) {
    http_response_code(400);
    echo json_encode(['error' => 'Lütfen bir şehir adı girin.']);
    exit;
}

$apiUrl = "https://api.collectapi.com/weather/getWeather?data.lang=tr&data.city=" . urlencode($city);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $apiUrl);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, [
    "authorization: apikey " . APIKEYDİYORUMSANAXD,
    "content-type: application/json"
]);

$response = curl_exec($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    http_response_code(500);
    echo json_encode(['error' => 'bir hata oluştu: ' . $err]);
    exit;
}

if ($httpCode !== 200) {
    http_response_code($httpCode);
    echo json_encode(['error' => 'hava durumu verisi alınamadı.']);
    exit;
}

$data = json_decode($response, true);

if (!isset($data['result']) || empty($data['result'])) {
    http_response_code(404);
    echo json_encode(['error' => 'hava durumu bilgisi alınamadı.']);
    exit;
}

$weeklyWeather = [];
foreach ($data['result'] as $day) {
    $weeklyWeather[] = [
        'gun' => $day['day'],
        'tarih' => $day['date'],
        'sicaklik' => $day['degree'] . ' °C',
        'aciklama' => $day['description'],
        'ikon' => $day['icon']
    ];
}
header('Content-Type: application/json');
echo json_encode([
    'sehir' => $city,
    'haftalik_hava_durumu' => $weeklyWeather
]);
?>
