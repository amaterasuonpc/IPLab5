<?php

require '../InstagramUser.php'

class InstagramGet extends InstagramUser {
    public function getPost($postId){
        $post=this->fb->get($postId . '?fields=caption,comment_count,like_count,media_type,media_url');
        return $post;

    }
};

#EAAQM6NoB0t0BAD6fyvsOyKqAbdMijXAhPiLe7wQZBp4KrFV1f08LTYNptC4Wa6Yqw8ZAJLHlbIl5SpxhsTeab8KJkIlX5jwJ1f6DJ9Bu3ZBhuAbQHwpCPZA3G4ZBJKDzBxZAKhGypAvAbXTe23vs182Yrw1AZBZBguVfgdR46lJ8IFiI6qvVtQe3AfMusXZBK3z4ZD
$Idinsta='17841403789483121';

$test = new InstagramGet('EAAQM6NoB0t0BAD6fyvsOyKqAbdMijXAhPiLe7wQZBp4KrFV1f08LTYNptC4Wa6Yqw8ZAJLHlbIl5SpxhsTeab8KJkIlX5jwJ1f6DJ9Bu3ZBhuAbQHwpCPZA3G4ZBJKDzBxZAKhGypAvAbXTe23vs182Yrw1AZBZBguVfgdR46lJ8IFiI6qvVtQe3AfMusXZBK3z4ZD');

echo $test ;

