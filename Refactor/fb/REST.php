<?php
require_once("/xampp/htdocs/ip/Refactor/fb/get/FacebookGet.php");
function deliver()
{
	if (isset($_GET) && count($_GET) >= 3) {
		if (isset($_GET['do']) && isset($_GET['postId']) && isset($_GET['token'])){
			$x = new FacebookGet($_GET['token']);
			$post = new Post($x->getWholePost($_GET['postId']));
	
			switch ($_GET['do']) {
				case 'get1':
					print_r($post->getComments());
					break;

				case 'get2':
					print_r($post->getCommentCount());
					break;

				case 'get3':
					print_r($post->getLikeCount());
					break;
				default:
					break;
			}
		
		}else {
			echo "invalid arguments";
		} 
	} else {
		echo "invalid request";
	}
}
deliver();
?>