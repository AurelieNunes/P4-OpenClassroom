<?php
namespace blog\model;

require_once '/wamp64/www/blog/model/Manager.php';

class PostManager extends Manager
{
    public function getPosts()
{
    $db = $this->dbConnect();
    $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

    return $req;
}

    public function getPost($postId)
{
    $db = $this->dbConnect();
    $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
    $req->execute(array($postId));
    $post = $req->fetch();

    return $post;
}

public function updatePost($title, $content, $postId) {
    $db = $this->dbConnect();
    $req = $db->prepare('UPDATE posts SET title = ?, content = ?, update_date = NOW() WHERE id = ?');
    $updated = $req->execute(array($title, $content, $postId));
    return $updated;
}

public function createPost($title, $content) {
    $db = $this->dbConnect();
    $req = $db->prepare('INSERT INTO posts(title, content, creation_date, update_date) VALUES (?, ?, NOW(), NOW())');
    $newPost = $req->execute(array($title, $content));

    return $newPost;
}

public function deletePost($postId) {
    $db = $this->dbConnect();
    $req = $db->prepare('DELETE FROM posts WHERE id = ?');
    $deletedPost = $req->execute(array($postId));

    return $deletedPost;
}
}