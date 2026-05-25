<?php

declare(strict_types=1);

use App\ReportApp;

require_once __DIR__ . '/vendor/autoload.php';

$orders = [
    ["id" => 1, "user" => "Ivan", "amount" => 100,
        "status" => "paid"],
    ["id" => 2, "user" => "Oksana", "amount" => -50,
        "status" => "paid"], // аномалія
    ["id" => 3, "user" => "Ivan", "amount" => 200,
        "status" => "pending"], // не враховується
    ["id" => 4, "user" => "Petro", "amount" => 300,
        "status" => "paid"],
];

$app = new ReportApp($orders, __DIR__ . '/report.txt');
$app->process();
$app->write();
$app->summary();