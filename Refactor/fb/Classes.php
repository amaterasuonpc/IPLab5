<?php
require_once 'C:\xampp\htdocs\ip\Refactor\fb/vendor/php-graph-sdk/autoload.php';
class FacebookUser
{
	//access token de la Proiect IP
	public $accessToken;
	public $fb;
	function __construct($accessToken)
	{
		$this->fb = new Facebook\Facebook([
			'app_id' => '1140094136341213',
			'app_secret' => 'f3ccb98dc558350d9dc80914ac413655',
			'default_graph_version' => 'v3.2'
		]);
		$this->accessToken = $accessToken;
	}
};

class FacebookGet extends FacebookUser
{
	//for pages
	public function execute($command)
	{
		try {
			$response = $this->fb->get($command, $this->accessToken);
		} catch (Facebook\Exceptions\FacebookResponseException $e) {
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch (Facebook\Exceptions\FacebookSDKException $e) {
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}
		return $response;
	}

	public function getWholePost($postId)
	{
		$response = $this->execute($postId . "?fields=comments{message,from},likes");
		return $response->getDecodedBody();
	}
	public function getCommentCount($postId)
	{ //obsolete
		$response = $this->execute($postId . "?fields=comments");
		return count($response->getDecodedBody()['comments']['data']);
	}

	public function getLikeCount($postId)
	{ //obsolete
		$response = $this->execute($postId . "?fields=likes");
		return count($response->getDecodedBody()['likes']['data']);
	}
	public function getComments($postId)
	{ //obsolete
		$response = $this->execute($postId . "?fields=message,comments{message}");
		return $response->getDecodedBody()['comments']['data'];
	}
	//for user
	public function getPages($userId)
	{
		$response = $this->execute($userId . "/accounts?fields=id");
		return $response->getDecodedBody()['data'];
	}
	public function getPageToken($pageId)
	{
		$response = $this->execute($pageId . "?fields=access_token");
		return $response->getDecodedBody();
	}
	public function getPostsArray($pageId)
	{
		$response = $this->execute($pageId . "?fields=posts{likes, comments, message}");
		return $response->getDecodedBody()['posts']['data'];
	}
	public function last3Comments($postId)
	{
		$response = $this->execute($postId . "?fields=comments.limit(3)");
		return $response->getDecodedBody()['comments']['data'];
	}
	public function getBestPost($pageId)
	{
		$response = $this->execute($pageId . "?fields=posts{likes, comments, message}");
		$decoded = $response->getDecodedBody();
		$maxim = -1;
		$bestPost = 0;
		
		if (array_key_exists('posts', $decoded))
			if (array_key_exists('data', $decoded['posts'])) {
				$postList = $decoded['posts']['data'];
				for ($i = 0; $i < count($postList); $i++) {
					if (array_key_exists('likes', $postList[$i]))
						if (array_key_exists('data', $postList[$i]['likes']))
							if ($maxim < count($postList[$i]['likes']['data'])) {
								$maxim = count($postList[$i]['likes']['data']);
								$bestPost = $postList[$i]['id'];
							}
				}
			}
		return $bestPost;
	}
};

class Post
{
	private $post;
	function __construct($post)
	{
		$this->post = $post;
	}
	public function getComments()
	{
		if (array_key_exists('comments', $this->post))
			if (array_key_exists('data', $this->post['comments']))
				return $this->post['comments']['data'];
		return 0;
	}
	public function getLikes()
	{
		if (array_key_exists('likes', $this->post))
			if (array_key_exists('data', $this->post['likes']))
				return $this->post['likes']['data'];
		return 0;
	}
	public function getCommentCount()
	{
		if (array_key_exists('comments', $this->post))
			if (array_key_exists('data', $this->post['comments']))
				return count($this->post['comments']['data']);
		return 0;
	}
	public function getLikeCount()
	{
		if (array_key_exists('likes', $this->post))
			if (array_key_exists('data', $this->post['likes']))
				return count($this->post['likes']['data']);
		return 0;
	}
};

class FacebookPost extends FacebookUser
{
	public function postareUrl($url, $message)
	{
		echo $message . '   ' . $url;
		$data = ['link' => $url, 'message' => $message,];
		try {
			$response = $this->fb->post('/112510383726603/feed', $data, $this->accessToken);
		} catch (FacebookExceptionsFacebookResponseException $e) {
			echo 'Graph returne an error: ' . $e->getMessage();
			exit;
		} catch (FacebookExceptionsFacebookSDKException $e) {
			echo 'facebook SDK return an error: ' . $e->getMessage();
			exit;
		}
		$graphNode = $response->getGraphNode();
		var_dump($graphNode);
	}
	public function postareImage($name, $message)
	{
		echo 'da' . $name;
		$data = ['message' => $message,  'source' => $this->fb->fileToUpload($name),];
		try {
			$response = $this->fb->post('/112510383726603/photos', $data, $this->accessToken);
		} catch (FacebookExceptionsFacebookResponseException $e) {
			echo 'Graph returne an error: ' . $e->getMessage();
			exit;
		} catch (FacebookExceptionsFacebookSDKException $e) {
			echo 'facebook SDK return an error: ' . $e->getMessage();
			exit;
		}
		$graphNode = $response->getGraphNode();
		//var_dump($graphNode);
		echo json_encode($graphNode);
	}
	public function postareMesaj($mesaj)
	{
		$data = ['message' => $mesaj,];
		try {
			$response = $this->fb->post('/112510383726603/feed', $data, $this->accessToken);
		} catch (FacebookExceptionsFacebookResponseException $e) {
			echo 'Graph returne an error: ' . $e->getMessage();
			exit;
		} catch (FacebookExceptionsFacebookSDKException $e) {
			echo 'facebook SDK return an error: ' . $e->getMessage();
			exit;
		}
		$graphNode = $response->getGraphNode();
		//var_dump($graphNode);
		echo json_encode($graphNode);
	}
	public function postareVideo($name, $title, $descriere)
	{
		$data = ['title' => $title, 'description' => $descriere, 'source' => $this->fb->videoToUpload($name),];
		try {
			$response = $this->fb->post('/112510383726603/videos', $data, $this->accessToken);
		} catch (FacebookExceptionsFacebookResponseException $e) {
			echo 'Graph returne an error: ' . $e->getMessage();
			exit;
		} catch (FacebookExceptionsFacebookSDKException $e) {
			echo 'facebook SDK return an error: ' . $e->getMessage();
			exit;
		}
		$graphNode = $response->getGraphNode();
		//var_dump($graphNode);
		echo json_encode($graphNode);
	}
}
