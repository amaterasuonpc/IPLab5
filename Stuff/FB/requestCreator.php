<style>
    form {
        display: inline-block;
        background-color: whitesmoke;
        border: 5px solid black;
        padding: 5px;
        margin: 2px;
    }
</style>
<!-- -------------------------GET NAME-------------------------->

<form action="REST.php" method="get">
    <select id="do" name="do">
        <option value="getUserName">get user name</option>
        <option value="getPageName">get page name</option>
    </select><br>
    <label>FB ID:</label><br>
    <input type="text" name="fbid" /><br>
    <input type="submit" value="Submit" />
</form>
<!-- -------------------------LOGIN-------------------------->
<form action="REST.php" method="get">
    <select id="do" name="do">
        <option value="login">Login</option>
    </select><br>
    <label>ourAppUserId:</label><br>
    <input type="text" name="userId" /><br>
    <label>redirect:</label><br>
    <input type="text" name="redirect" /><br>
    <input type="submit" value="Submit" />
</form>
<!-- -------------------------GET -------------------------->
<form action="REST.php" method="get">
    <select id="do" name="do">
        <option value="getComments">comments</option>
        <option value="getCommentCount">comment count</option>
        <option value="getLikeCount">like count</option>
        <option value="last3comments">last 3 comments</option>
    </select><br>
    <label>post ID:</label><br>
    <input type="text" name="postId" /><br>
    <label>FB ID:</label><br>
    <input type="text" name="fbid" /><br>
    <input type="submit" value="Submit" />
</form>

<form action="REST.php" method="get">
    <select id="do" name="do">
        <option value="getPages">get pages</option>
    </select><br>
    <label>FB ID:</label><br>
    <input type="text" name="fbid" /><br>
    <input type="submit" value="Submit" />
</form>


<form action="REST.php" method="get">
    <select id="do" name="do">
        <option value="getPostsArray">get Posts</option>
        <option value="getBestPost">get best post</option>
    </select><br>
    <label>FB ID:</label><br>
    <input type="text" name="fbid" /><br>
    <input type="submit" value="Submit" />
</form>


<!-- -------------------------POST-------------------------->
<form action="REST.php" method="GET">
    <select id="do" name="do">
        <option value="PostUrl">Post URL</option>
        URL:<input type="text" name="url"><br>
        Mesaj:<input type="text" name="mesaj"><br>
        <label>FB ID:</label><br>
        <input type="text" name="fbid" /><br>
        <input type="submit" name="submit" value="Url"><br>
</form>

</form>
<form action="REST.php" method="GET">
    <select id="do" name="do">
        <option value="PostImage">Post Image</option>
        Image Name:<input type="text" name="image"><br>
        mesaj:<input type="text" name="mesaj"><br>
        <label>FB ID:</label><br>
        <input type="text" name="fbid" /><br>
        <input type="submit" name="submit" value="Image"><br>
</form>

</form>
<form action="REST.php" method="GET">
    <select id="do" name="do">
        <option value="PostMessage">Post Message</option>
        Mesajul dorit:<input type="text" name="messenger"><br>
        <label>FB ID:</label><br>
        <input type="text" name="fbid" /><br>
        <input type="submit" name="submit" value="Message"><br>
</form>
<form action="REST.php" method="GET">
<select id="do" name="do">
<option value="PostReply" >Post Reply</option>
Reply dorit : <input type="text" name ="reply"><br>
Id postarii : <input type="text" name="id_postare"><br>
<label>FB ID:</label><br>
        <input type="text" name="fbid" /><br>
<input type="submit" name="submit" value="Reply"><br>
</select>
</form>

<!-- <form action="REST.php" method="GET">
    <select id="do" name="do">
        <option value="PostVideo">Post Video</option>
        Video Name:<input type="text" name="video"><br>
        Title:<input type="text" name="title"><br>
        Description: <input type="text" name="descriere"><br>
        <label>FB ID:</label><br>
        <input type="text" name="fbid" /><br>
        <input type="submit" name="submit" value="Video"><br>
</form> -->
</body>

</html>