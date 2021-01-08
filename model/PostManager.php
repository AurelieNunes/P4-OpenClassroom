<?php
namespace blog\model;

use \blog\model\Manager;

class PostManager extends Manager
{
    //fonction pour récupérer tous les posts
    public function getPosts($cPage, $postsPerPage)
{
    $db = $this->dbConnect();
    $req = $db->query("SELECT id, title, content, lien, alt, DATE_FORMAT(creation_date, '%d/%m/%Y %H:%i:%s') AS date_fr, DATE_FORMAT(update_date, '%d/%m/%Y %H:%i:%s') AS update_date_fr FROM posts ORDER BY creation_date DESC LIMIT $cPage, $postsPerPage");

    return $req;
}

    //fontcion pour récupérer un post précis
    public function getPost($postId)
{
    $db = $this->dbConnect();
    $req = $db->prepare('SELECT id, title, content, lien, alt, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_fr, DATE_FORMAT(update_date, "%d/%m/%Y %H:%i:%s") AS update_date_fr FROM posts WHERE id = ?');
    $req->execute(array($postId));
    $post = $req->fetch();

    return $post;
}

    //Fonction pour mettre à jour un post
    public function updatePost($title, $content, $postId) {
    $db = $this->dbConnect();
    $req = $db->prepare('UPDATE posts SET title = ?, content = ?, update_date = NOW() WHERE id = ?');
    $req->execute(array($title, $content, $postId));
    $updated = $req->fetch();

    return $updated;
}

    //Fonction pour créer un post
    public function createPost($title, $content) {
    $db = $this->dbConnect();
    $req = $db->prepare('INSERT INTO posts(title, content,creation_date, update_date) VALUES (?, ?, NOW(), NOW())');
    $req->execute(array($title, $content));
    $newPost = $req->fetch();

    return $newPost;
}

    //Fonction pour sup un post
    public function deletePost($postId) {
    $db = $this->dbConnect();
    $req = $db->prepare('DELETE FROM posts WHERE id = ?');
    $req->execute(array($postId));
    $deletedPost = $req->fetch();

    return $deletedPost;
}
}