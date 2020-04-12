<?php
require_once("FacebookGet.php");
function deliver()
{
	echo "<pre>";
	if (isset($_GET) && count($_GET) >= 3) {
		if (isset($_GET['do']) && isset($_GET['postId']) && isset($_GET['token'])){
			$x = new FacebookGet($_GET['token']);
			$post = new Post($x->getWholePost($_GET['postId']));
			switch ($_GET['do']) {
				case 'getComments':
					print_r($post->getComments());
					break;

				case 'getCommentCount':
					print_r($post->getCommentCount());
					break;

				case 'getLikeCount':
					print_r($post->getLikeCount());
					break;

				case 'getPages':
					print_r($x->getPages($_GET['userId']));
					break;
				
				case 'getPostsArray':
					print_r($x->getPostsArray($_GET['userId']));
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
	echo "</pre>";
}
deliver();
?>