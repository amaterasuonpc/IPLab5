<form action="REST.php" method="get">
    <select  id="do" name="do">
            <option value="getComments">comments</option>
            <option value="getCommentCount">comment count</option>
            <option value="getLikeCount">like count</option>
            <option value="getPages">get pages</option>
            <option value="getPostsArray">get Posts</option>
            
    </select><br>
    <label>user ID:</label><br>
    <input type="text" name="userId" /><br>
    <label>post ID:</label><br>
    <input type="text" name="postId" /><br>
    <label>access_token:</label><br>
    <input type="text" name="token" /><br>
    <input type="submit" value="Submit" />
</form>