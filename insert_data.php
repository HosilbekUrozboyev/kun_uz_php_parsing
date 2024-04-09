<?php
include 'connect.php';
global $conn;

require 'vendor/autoload.php';


use Symfony\Component\DomCrawler\Crawler;

$httpClient = new \GuzzleHttp\Client();
$response = $httpClient->get('https://kun.uz/authored');
$htmlString = (string)$response->getBody();

libxml_use_internal_errors(true);
$doc = new DOMDocument();
$doc->loadHTML($htmlString);
$xpath = new DOMXPath($doc);

$newsItems = $xpath->query('//div[contains(@class, "col-md-4") and contains(@class, "mb-25") and contains(@class, "l-item")]');

foreach ($newsItems as $newsItem) {
    $crawler = new Crawler($doc->saveHTML($newsItem));
    $title = $crawler->filter('.news__title')->text();
    $image = $crawler->filter('.news__img > img')->attr('src');
    $time = $crawler->filter('.news-meta > span')->text();

//     Matn qiymatlarini to'g'ri formatga keltirib, SQL injektsiya xavfi bilan himoya qilish
    $title = $conn->real_escape_string($title);
    $image = $conn->real_escape_string($image);
    $time = $conn->real_escape_string($time);

    $sql = "INSERT INTO Maqolalar (title, image, time)
           VALUES ('$title', '$image', '$time')";


//  So'rovni bajarish
    if ($conn->query($sql) === TRUE) {
        echo "Bazaga muvaffaqiyatli qo'shildi <br>";
    } else {
        echo "Xatolik: " . $sql . "<br>" . $conn->error;
    }
}
// Ma'lumotlar omboriga ulanishni bekor qilish
$conn->close();
