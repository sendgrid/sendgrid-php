<?php

// If you are using Composer
require __DIR__ . '/../../../vendor/autoload.php';

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

$stats = new \SendGrid\Stats('2017-10-18');

//$response = $sg->client->categories()->post(['category' => 'cat2']);
//$response = $sg->client->categories()->get(null, $query_params);

$globalResponse = $sg->client->stats()->get(null, $stats->getGlobal());

$categoryResponse = $sg->client->categories()->stats()->get(null, $stats->getCategory(['category1', 'category2']));
$categorySumResponse = $sg->client->categories()->stats()->sums()->get(null, $stats->getSum());

$subuserResponse = $sg->client->subusers()->stats()->get(null, $stats->getSubuser(['user1', 'user2']));
$subuserSumResponse = $sg->client->subusers()->stats()->sums()->get(null, $stats->getSum());
$subuserMonthlyResponse = $sg->client->subusers()->stats()->monthly()->get(null, $stats->getSubuserMonthly());

var_dump($globalResponse);
var_dump($categoryResponse);
var_dump($categoryResponse);
var_dump($subuserResponse);
var_dump($subuserSumResponse);
var_dump($subuserMonthlyResponse);
