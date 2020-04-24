<?php
if (!session_id()) {
	session_start();
}
require_once("./classes.php");
require_once("./QueryManager.php");
function deliver()
{
	echo "<pre>";
	if (isset($_GET)) {
		if (isset($_GET['do'])) {
			if (isset($_GET['token']))
				$x = new FacebookGet($_GET['token']);

			switch ($_GET['do']) {
				case 'register':
					$obiect = new QueryManager();
					$obiect->getConexiune();
					$sql = 'INSERT INTO facebook_token(user_id, access_token) VALUES(' . $_SESSION['userId'] . ', \'' . $_GET['token'] . '\')';
					$obiect->query($sql);
					
					$pages = $x->getPages('_');
					for ($i = 0; $i < count($pages); $i++) {
						$pageToken = $x->getPageToken($pages[$i]['id']);
					
						$sql = 'INSERT INTO facebook_pages(user_id, page_id, access_token) VALUES(' . $_SESSION['userId'] . ', ' . $pages[$i]['id'] . ', \'' . $pageToken['access_token'] . '\')';
						$obiect->query($sql);
					}

					header('Location: ' . $_SESSION['redirect']);
					break;
				case 'login':
					$_SESSION['userId'] = $_GET['userId'];
					$_SESSION['redirect'] = $_GET['redirect'];
					$x = new FacebookUser(" ");
					$x->login($_GET['userId']);
					break;
					//for GET requests DOWN-------------------------------------------------------------
				case 'getComments':
					$post = new Post($x->getWholePost($_GET['postId']));
					print_r($post->getComments());
					break;

				case 'getCommentCount':
					$post = new Post($x->getWholePost($_GET['postId']));
					print_r($post->getCommentCount());
					break;

				case 'getLikeCount':
					$post = new Post($x->getWholePost($_GET['postId']));
					print_r($post->getLikeCount());
					break;

				case 'getPages':
					print_r($x->getPages($_GET['userId']));
					break;

				case 'getPostsArray':
					print_r($x->getPostsArray($_GET['userId']));
					break;
				case 'last3comments':
					print_r($x->last3Comments($_GET['postId']));
					break;
				case 'getBestPost':
					print_r($x->getBestPost($_GET['userId']));
					break;
					//for POST requests DOWN--------------------------------------------------------
				case 'PostUrl':
					$obiect = new FacebookPost($x->accessToken);
					print_r($obiect->postareUrl($_GET['url'], $_GET['mesaj']));
					break;
				case 'PostImage':
					$obiect = new FacebookPost($x->accessToken);
					print_r($obiect->postareImage($_GET['url'], $_GET['mesaj']));
					break;
				case 'PostMessage':
					$obiect = new FacebookPost($x->accessToken);
					print_r($obiect->postareMesaj($_GET['image'], $_GET['mesaj']));
					break;
				case 'PostVideo':
					$obiect = new FacebookPost($x->accessToken);
					print_r($obiect->postareVideo($_GET['url'], $_GET['mesaj']));
					break;
					//for LOGIN

				default:
					break;
			}
		} else {
			echo "invalid arguments";
		}
	} else {
		echo "invalid request";
	}
	echo "</pre>";
}
deliver();
?>