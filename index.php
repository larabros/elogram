<?php

require 'vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();


// session_start();

//$client = new Instagram\Client($options);
$instagram = new \Instagram\Instagram(
    getenv('CLIENT_ID'),
    getenv('CLIENT_SECRET'),
    getenv('ACCESS_TOKEN'),
    'http://localhost:9000'
);

//dd($instagram);
//$instagram->getUserByName('skrawg');
//header('Content-Type: application/json');
//echo json_encode($instagram->user()->get('268047373')->get());
//echo json_encode($instagram->user()->find('skrawg')->get());
//echo json_encode($instagram->user()->getMedia('268047373')->get());
//echo json_encode($instagram->user()->getLikedMedia()->get());
//echo json_encode($instagram->user()->search('skrawg')->get());

//echo json_encode($instagram->media()->get('1109588739516340817_268047373')->get());
//echo json_encode($instagram->media()->getByShortcode('9RV6okpRin')->get());
//echo json_encode($instagram->media()->search(51.503349, -0.252271)->get());

if (!isset($_GET['code'])) {

     // If we don't have an authorization code then get one
     header('Location: '.$instagram->getLoginUrl());
     exit;

} else {
     $token = $instagram->getAccessToken($_GET['code']);
     // echo json_encode($token);

    echo json_encode($instagram->user()->get('268047373')->get());
    // echo json_encode($instagram->user()->find('skrawg')->get());
    // echo json_encode($instagram->user()->getMedia('268047373')->get());
    // echo json_encode($instagram->user()->getLikedMedia()->get());
    // echo json_encode($instagram->user()->search('skrawg')->get());
}
