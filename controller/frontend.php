<?php

// Chargement des classes
use \blog\model\PostManager;
use \blog\model\CommentManager;
use \blog\model\MemberManager;


require_once '/wamp64/www/blog/model/Manager.php';

function listPosts()
{
	$postManager = new PostManager(); // Création d'un objet

    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    require('view/frontend/homeView.php');
}

function post()
{
    $postManager = new PostManager();
	$commentManager = new CommentManager();

	$post = $postManager->getPost($_GET['id']);

    if ($post) {
		$comments = $commentManager->getComments($_GET['id']);
		$comments;

    } else {
    	header('Location: index.php');
    }
    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId . '#commentsFrame');
    }
}

function displaySubscribe() {
	require('view/frontend/subscribeView.php');
}

function addMember($pseudo, $pass, $email) {
	$memberManager = new MemberManager();

	//$reCaptcha = $memberManager->getReCaptcha($_POST['g-recaptcha-response']);
	
	//if ($reCaptcha->success == true) {
		$usernameValidity = $memberManager->checkPseudo($pseudo);
		$mailValidity = $memberManager->checkMail($email);

		if ($usernameValidity) {
			header('Location: index.php?action=subscribe&error=invalidUsername');	
		}

		if ($mailValidity) {
			header('Location: index.php?action=subscribe&error=invalidMail');
		}

		if (!$usernameValidity && !$mailValidity) {
			// Hachage du mot de passe
			$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
			
			$newMember = $memberManager->createMember($pseudo, $pass, $email);
			$newMember;
			
			// redirige vers page d'accueil avec le nouveau paramètre
			header('Location: index.php?account-status=account-successfully-created');
		}	
    //}
    // else 
    // {
	// 	header('Location: index.php?action=subscribe&error=google-recaptcha');
	// }
}

function displayLogin() {
	require('view/frontend/loginView.php');
}

function loginSubmit($pseudo, $pass) {
	$memberManager = new MemberManager();

	$member = $memberManager->loginMember($pseudo);

	$isPasswordCorrect = password_verify($_POST['pass'], $member['pass']);

	if (!$member) {
        header('Location: index.php?action=login&account-status=unsuccess-login');
    }
    else {
    	if ($isPasswordCorrect) {
    		$_SESSION['id'] = $member['id'];
    		$_SESSION['pseudo'] = ucfirst(strtolower($pseudo));
    		$_SESSION['groups_id'] = $member['groups_id'];
    		header('Location: index.php');
    	}
        else {
        	header('Location: index.php?action=login&account-status=unsuccess-login');
        }
    }
}