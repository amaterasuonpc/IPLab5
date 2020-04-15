<?php

$configFile = dirname(__FILE__) . '/config.php';

if (file_exists($configFile))
{
    include $configFile;
}
else
{
    die("Please rename the config-sample.php file to config.php and add your Flickr API key and secret to it\n");
}

spl_autoload_register(function($className)
{
    $className = str_replace ('\\', DIRECTORY_SEPARATOR, $className);
    include (dirname(__FILE__) . '/src/' . $className . '.php');
});

use \DPZ\Flickr;

// Build the URL for the current page and use it for our callback
// $callback = sprintf('http://localhost/');
// echo $callback;
$callback = 'http://localhost/DPZ/auth.php';

$flickr = new Flickr($flickrApiKey, $flickrApiSecret, $callback);

if (!$flickr->authenticate('write'))
{
    die("Hmm, something went wrong...\n");
}

$userNsid = $flickr->getOauthData(Flickr::USER_NSID);
$userName = $flickr->getOauthData(Flickr::USER_NAME);
$userFullName = $flickr->getOauthData(Flickr::USER_FULL_NAME);

$parameters =  array(
    'per_page' => 100,
    'extras' => 'url_sq,path_alias',
);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>DPZFlickr Auth Example</title>
        <link rel="stylesheet" href="example.css" />
    </head>
    <body>
        <h1>Popular photos from <?php echo $userName ?></h1>
    </body>
</html>

