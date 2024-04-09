<?php
# scraping books to scrape: https://books.toscrape.com/
require 'vendor/autoload.php';
$httpClient = new \GuzzleHttp\Client();
$response = $httpClient->get('https://kun.uz/authored');
$htmlString = (string) $response->getBody();
//add this line to suppress any warnings
libxml_use_internal_errors(true);
$doc = new DOMDocument();
$doc->loadHTML($htmlString);
$xpath = new DOMXPath($doc);
//$titles = $xpath->evaluate('//ol[@class="row"]//li//article//h3/a');
//$prices = $xpath->evaluate('//ol[@class="row"]//li//article//div[@class="product_price"]//p[@class="price_color"]');
//foreach ($titles as $key => $title) {
//    echo $title->textContent . ' @ '. $prices[$key]->textContent.PHP_EOL;
//}

$crawler = new Crawler($html);
//var_dump($doc);
$newsItems = $crawler->filter('.row#news-list > .col-md-4.mb-25.l-item');

foreach ($newsItems as $newsItem) {
    $crawler = new Crawler($newsItem);
    $title = $crawler->filter('.news__title')->text();
    $image = $crawler->filter('.news__img > img')->attr('src');
    $time = $crawler->filter('.news-meta > span')->text();

    echo "Title: $title\n";
    echo "Image URL: $image\n";
    echo "Time: $time\n\n";
}