<?php
require_once './GraphAPI.php';
class FacebookUser extends GraphAPI
{
    public $appCreds = array( // array to hold app creds from fb app
		'app_id' => '1140094136341213',
		'app_secret' => 'f3ccb98dc558350d9dc80914ac413655',
		'default_graph_version' => 'v3.2'
    );
    
}

?>