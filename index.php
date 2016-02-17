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
header('Content-Type: application/json');
echo json_encode($instagram->user()->getUserMedia('268047373')->get());

//dd($instagram->getProvider());

// $helper->getLoginUrl();

// if (!isset($_GET['code'])) {

//     // If we don't have an authorization code then get one
//     $authUrl = $client->getProvider()->getAuthorizationUrl();
//     $_SESSION['oauth2state'] = $client->getProvider()->getState();
//     header('Location: '.$authUrl);
//     exit;

// // Check given state against previously stored one to mitigate CSRF attack
// } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

//     unset($_SESSION['oauth2state']);
//     exit('Invalid state');

// } else {

//     // Try to get an access token (using the authorization code grant)
//     $token = $client->getProvider()->getAccessToken('authorization_code', [
//         'code' => $_GET['code']
//     ]);

//     // Optional: Now you have a token you can look up a users profile data
//     try {

//         // We got an access token, let's now get the user's details
//         $user = $client->getProvider()->getResourceOwner($token);

//         // Use these details to create a new profile
//         printf('Hello %s!', $user->getName());

//     } catch (Exception $e) {

//         // Failed to get user details
//         exit('Oh dear...');
//     }

//     // Use this to interact with an API on the users behalf
//     echo json_encode($token->jsonSerialize());
// }
