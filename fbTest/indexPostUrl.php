<?php
	// require our config file and load the php graph sdk
	require 'config.php';
	require_once 'vendor/php-graph-sdk/autoload.php';

	// start the session
	session_start();

	$appCreds = array( // array to hold app creds from fb app
		'app_id' => '1140094136341213',
		'app_secret' => 'f3ccb98dc558350d9dc80914ac413655',
		'default_graph_version' => 'v3.2'
	);

	if ( isset( $_SESSION['fb_access_token'] ) && $_SESSION['fb_access_token'] ) { // if we have access token, add it to the app creds
		$appCreds['default_access_token'] = $_SESSION['fb_access_token'];
	}

	if ( isset( $_SESSION['fb_access_token'] ) && $_SESSION['fb_access_token'] ) { // we have an access token, use it to get user info from fb
		$isLoggedIn = true;
	} elseif ( isset( $_GET['code'] ) && !$_SESSION['fb_access_token'] ) { // user is coming from allowing our app
		// create new facebook object and helper for getting access token
		$fb = new \Facebook\Facebook( $appCreds );
		$helper = $fb->getRedirectLoginHelper();
        


		try { // get access token, save to session, and add to app creds
		 	$accessToken = $helper->getAccessToken();
		  	$_SESSION['fb_access_token'] = (string) $accessToken;
		  	$appCreds['default_access_token'] = $_SESSION['fb_access_token'];
		  	$isLoggedIn = true;
		} catch(Facebook\Exceptions\FacebookResponseException $e) { // When Graph returns an error
		    echo 'Graph returned an error: ' . $e->getMessage();
		    exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) { // When validation fails or other local issues
		    echo 'Facebook SDK returned an error: ' . $e->getMessage();
		    exit;
		}
	} else { // user is no logged in, display the login with facebook link
		// create new facebook object and helper for getting access token
		$fb = new \Facebook\Facebook( $appCreds );
		$helper = $fb->getRedirectLoginHelper();

		// user is not logged in
		$isLoggedIn = false;
	}

	if ( $isLoggedIn ) { // logged in
		// create new facebook object
		$fb = new \Facebook\Facebook( $appCreds );

		// call facebook and ask for name and picture
		$facebookResponse = $fb->get( '/me?fields=first_name,last_name,picture' );
		$facebookUser = $facebookResponse->getGraphUser();
        
		// Use handler to get access token info
		$oAuth2Client = $fb->getOAuth2Client();
		$accessToken = $oAuth2Client->debugToken( $_SESSION['fb_access_token'] );
	  //I want to post something
$data3=['link'=>'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.youtube.com%2Fwatch%3Fv%3DZa7K1flbsx4&psig=AOvVaw2AzWIaZktA6PnB93bwrV9q&ust=1586079882856000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCOCErfmVzugCFQAAAAAdAAAAABAD',
			'message'=>'Hello there!',];
try
{
	$response=$fb->post('/112510383726603/feed',$data3,
	'EAAQM6NoB0t0BABnukB3CrOFpxLyPra6r6QoHuKbbMnETb1egnrZCi8w7X7Ubk4ZCbUX0BxZA451Fjbk5LY4LNiTgZBtLyc5qTZBeZBKUaI8LvcfbwSyYQtBkayhIlNknuveOsfCiWdlpucDzBksbA8wb1sfEHaEeykn7FMfM7JLwuAi0guZAdbE');

}catch(FacebookExceptionsFacebookResponseException $e)
{
	echo 'Graph returne an error: ' . $e->getMessage();
	exit;
}catch(FacebookExceptionsFacebookSDKException $e)
{
	echo 'facebook SDK return an error: ' . $e->getMessage();
	exit;
}

$graphNode = $response->getGraphNode();		// display everything in the browser
    
		?>
		<div><b>Logged in as <?php echo $facebookUser['first_name']; ?> <?php echo $facebookUser['last_name']; ?></b></div>
		<div><b>FB User ID: <?php echo $facebookUser['id']; ?></b></div>
		<div><img src="<?php echo $facebookUser['picture']['url']; ?>" /></div>
		<br />
		<br />
		<hr />
		<br />
		<br />
		<b>User Info</b>
		<textarea style="height:200px;width:100%"><?php echo print_r( $facebookUser, true ); ?></textarea>
		<br />
		<br />
		<b>Access Token</b>
		<textarea style="height:200px;width:100%"><?php echo print_r( $accessToken, true ); ?></textarea>
		<br />
		<br />
		<b>Access Token Expires</b>
		<textarea style="height:100px;width:100%"><?php echo print_r( $accessToken->getExpiresAt(), true ); ?></textarea>
		<br />
		<br />
		<b>Access Token Is Valid</b>
		<textarea style="height:50px;width:100%"><?php echo print_r( $accessToken->getIsValid(), true ); ?></textarea>
		<br />
		<br />
		<?php
	} else { // not logged in
		$permissions = ['email']; // Optional permissions
		$loginUrl = $helper->getLoginUrl( 'http://localhost/fbTest/indexPostUrl.php', $permissions );///aici trebuie schimbat URL pt localhost. Al meu este cel definit inainte

		?>
		<a href="<?php echo $loginUrl; ?>">Log in with Facebook</a>
		<?php
	}
?>