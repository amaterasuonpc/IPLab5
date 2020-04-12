<?php
set_include_path('E:\xampp\htdocs\redditAPI\PHP-OAuth2-master\PHP-OAuth2-master\src\OAuth2');

if (isset($_GET["error"]))
{
    echo("<pre>OAuth Error: " . $_GET["error"]."\n");
    echo('<a href="index.php">Retry</a></pre>');
    die;
}

$authorizeUrl = 'https://ssl.reddit.com/api/v1/authorize';
$accessTokenUrl = 'https://ssl.reddit.com/api/v1/access_token';
$clientId = '78OfNCpBl3VJrw';
$clientSecret = 'znQsArMG8YlX8MSDl9ev3oT9f9c';
$userAgent = 'ChangeMeClient/0.1 by YourUsername';

$redirectUrl = "http://localhost/redditAPI/";

require("Client.php");
require("GrantType/IGrantType.php");
require("GrantType/AuthorizationCode.php");

$client = new OAuth2\Client($clientId, $clientSecret, OAuth2\Client::AUTH_TYPE_AUTHORIZATION_BASIC);
$client->setCurlOption(CURLOPT_USERAGENT,$userAgent);

if (!isset($_GET["code"]))
{
    $authUrl = $client->getAuthenticationUrl($authorizeUrl, $redirectUrl, array("scope" => "identity, edit, flair, history, modconfig, modflair, modlog, modposts, modwiki, mysubreddits, privatemessages, read, report, save, submit, subscribe, vote, wikiedit, wikiread", "state" => "SomeUnguessableValue"));
    header("Location: ".$authUrl);
    die("Redirect");
}
else
{
    $params = array("code" => $_GET["code"], "redirect_uri" => $redirectUrl);
    $response = $client->getAccessToken($accessTokenUrl, "authorization_code", $params);
  //  var_dump($response);
    $accessTokenResult = $response["result"];
    $client->setAccessToken($accessTokenResult["access_token"]);
    $client->setAccessTokenType(OAuth2\Client::ACCESS_TOKEN_BEARER);

    $response = $client->fetch("https://oauth.reddit.com/api/v1/me.json");
    print_r($response);
    $ar=array();
     $postFields=array(
	'title'=>'volvo',
	'sr'=>'redditdev',
	'kind'=>'self',
	'text'=>'abcdefg'
	);
    $response = $client->fetch("https://oauth.reddit.com/api/submit",$postFields,OAuth2\Client::HTTP_METHOD_POST);
    //echo OAuth2\Client::HTTP_METHOD_POST;
    echo('<strong>Response for fetch me.json:</strong><pre>');
    //print_r($response);
    /*echo('</pre>');
    $ch2=curl_init("https://oauth.reddit.com/api/submit");
    curl_setopt($ch2,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch2,CURLOPT_USERAGENT,'rauleanu');
    curl_setopt($ch2, CURLOPT_HTTPHEADER,array("Authorization: " . 'bearer' . " " .'254339035529-chxxxq1dHrZIUQriybRBueMrOeg'));
    curl_setopt($ch2,CURLOPT_CUSTOMREQUEST,'POST');
    curl_setopt($ch2,CURLOPT_POSTFIELDS,$postFields);
    curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER,FALSE);
    $response_raw=curl_exec($ch2);
    //print_r($response_raw);
    $response2=json_decode($response_raw);
    var_dump($response2);
    curl_close($ch2);*/



}
