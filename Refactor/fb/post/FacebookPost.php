<?php
require_once 'FacebookUser.php';
class FacebookPost extends FacebookUser
{
    public function postareUrl($url,$message)
    {
        $fb = new \Facebook\Facebook($this->appCreds);
        $data = ['link' => $url, 'message' => $message,];
        try {
            $response = $fb->post('/112510383726603/feed', $data, 'EAAQM6NoB0t0BABnukB3CrOFpxLyPra6r6QoHuKbbMnETb1egnrZCi8w7X7Ubk4ZCbUX0BxZA451Fjbk5LY4LNiTgZBtLyc5qTZBeZBKUaI8LvcfbwSyYQtBkayhIlNknuveOsfCiWdlpucDzBksbA8wb1sfEHaEeykn7FMfM7JLwuAi0guZAdbE');
        } catch (FacebookExceptionsFacebookResponseException $e) {
            echo 'Graph returne an error: ' . $e->getMessage();
            exit;
        } catch (FacebookExceptionsFacebookSDKException $e) {
            echo 'facebook SDK return an error: ' . $e->getMessage();
            exit;
        }
        $graphNode=$response->getGraphNode();
        var_dump($graphNode);
    }
    public function postareImage($name,$message)
    {
        echo 'da' .$name;
        $fb=new \Facebook\Facebook($this->appCreds);
        $data=['message' => $message ,  'source' => $fb->fileToUpload($name), ];
        try {
            $response = $fb->post('/112510383726603/photos', $data, 'EAAQM6NoB0t0BABnukB3CrOFpxLyPra6r6QoHuKbbMnETb1egnrZCi8w7X7Ubk4ZCbUX0BxZA451Fjbk5LY4LNiTgZBtLyc5qTZBeZBKUaI8LvcfbwSyYQtBkayhIlNknuveOsfCiWdlpucDzBksbA8wb1sfEHaEeykn7FMfM7JLwuAi0guZAdbE');
        } catch (FacebookExceptionsFacebookResponseException $e) {
            echo 'Graph returne an error: ' . $e->getMessage();
            exit;
        } catch (FacebookExceptionsFacebookSDKException $e) {
            echo 'facebook SDK return an error: ' . $e->getMessage();
            exit;
        }
        $graphNode=$response->getGraphNode();
        //var_dump($graphNode);
        echo json_encode($graphNode);
    }
    
    
}

//$cartier =new FacebookPost();
//$cartier->postareUrl('https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.youtube.com%2Fwatch%3Fv%3DZa7K1flbsx4&psig=AOvVaw2AzWIaZktA6PnB93bwrV9q&ust=1586079882856000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCOCErfmVzugCFQAAAAAdAAAAABAD',$message);
/*if(isset($_GET['url']) &&  isset($_GET['mesaj']))
{
$url=$_GET['url'];
$mesaj=$_GET['mesaj'];
$obiect=new FacebookPost();
$obiect->postareUrl($url,$mesaj);
}*/
if(isset($_GET['mesaj']) && isset($_GET['image']))
{
    $mesaj=$_GET['mesaj'];
    $name=$_GET['image'];
    $obiect=new FacebookPost();
    $obiect->postareImage($name,$mesaj);
}

?>
<html>
<body>
<form method="GET" >
Posting for URL:
    <br>
Mesaj:<input type="text" name="mesaj"><br>
Posting for Image:
ImageName:<input type="text" name="image">
<input type="submit"><br>
</form>
</body>
</html>
