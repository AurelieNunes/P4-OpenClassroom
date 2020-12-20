<?php

// namespaces utilisés
use \blog\model\CommentManager;
use \blog\model\MemberManager;
use \blog\model\PostManager;

require_once '/wamp64/www/blog/model/Manager.php';

function displayLoginAdmin() {
	require('view/frontend/adminLoginView.php');
}

function loginAdmin() {
	if (isset($_POST['pass']) AND $_POST['pass'] == "TEST") {
		header('Location: index.php?action=admin');
	} else {
		header('Location: index.php?action=admin-login-view&account-status=unsuccess-login');
	}
}

function displayAdmin() {
	$postManager = new PostManager(); 
	$memberManager = new MemberManager();
	
	$posts = $postManager->getPosts();
 
	$members = $memberManager->getMembers();

	require('view/backend/adminView.php');
}

function displayUpdate() {
	$postManager = new PostManager();

	$post = $postManager->getPost($_GET['id']);
	require('view/backend/updatePostView.php');
}

function submitUpdate($title, $content, $postId) {
	$postManager = new PostManager();
	
	$updated = $postManager->updatePost($title, $content, $postId);

	Header('Location: index.php?action=admin&update-status=success');
}

function displayCreatePost() {
	require('view/backend/createPostView.php');
}

function newPost($title, $content) {
	$postManager = new PostManager();

	$newPost = $postManager->createPost($title, $content);

	Header('Location: index.php?action=admin&new-post=success');
}

function removePost($postId) {
	$postManager = new PostManager();

	$deletedPost = $postManager->deletePost($postId);

	Header('Location: index.php?action=admin&remove-post=success');
}

function removeComment($commentId) {
	$commentManager = new CommentManager();

	$deletedComment = $commentManager->deleteComment($commentId);

	Header('Location: index.php?action=admin&remove-comment=success');
}

function removeMember($memberId) {
	$memberManager = new MemberManager();

	$deletedMember = $memberManager->deleteMember($memberId);

	Header('Location: index.php?action=admin&remove-member=success');	
}