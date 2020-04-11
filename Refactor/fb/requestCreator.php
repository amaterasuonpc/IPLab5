<form action="REST.php" method="get">
    <select  id="do" name="do">
            <option value="get1">comments</option>
            <option value="get2">comment count</option>
            <option value="get3 like count">like count</option>
    </select><br>
    <label>user ID:</label><br>
    <input type="text" name="userId" /><br>
    <label>post ID:</label><br>
    <input type="text" name="postId" /><br>
    <label>access_token:</label><br>
    <input type="text" name="token" /><br>
    <input type="submit" value="Submit" />
</form>