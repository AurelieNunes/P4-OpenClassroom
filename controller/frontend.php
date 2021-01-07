<?php

// Chargement des classes
use \blog\model\PostManager;
use \blog\model\Pagination;
use \blog\model\CommentManager;
use \blog\model\MemberManager;
use \blog\model\ReportManager;

require_once './model/Manager.php';

//Fonction liste des posts
function listPosts()
{
	$postManager = new PostManager(); // Création d'un objet
	$pagination = new Pagination();
	//determine le nb de posts par page
	$postsPerPage = 4;

	$nbPosts = $pagination->getTotalPosts();
	$nbPage = $pagination->getNbPages($nbPosts, $postsPerPage);

	if (!isset($_GET['page'])) {
		$cPage = 0;
	} else {
		if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbPage) {
			$cPage = (intval($_GET['page']) - 1) * $postsPerPage;
		}
	}

	$posts = $postManager->getPosts($cPage,$postsPerPage); // Appel d'une fonction de cet objet

    require('view/frontend/homeView.php');
}

//Fonction Récupération d'un post
function post()
{
    $postManager = new PostManager();
	$commentManager = new CommentManager();
	$reportManager = new ReportManager();

	$post = $postManager->getPost($_GET['id']);

    if ($post) {
		$comments = $commentManager->getComments($_GET['id']);
		$idComment = $_GET['id'];

    } else {
    	header('Location: index.php');
    }
    require('view/frontend/postView.php');
}

//Fonction pour ajouter des commentaires
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

function postReport($postId, $commentId, $memberId) {
	$reportManager = new ReportManager();

	$reported = $reportManager->postReports($commentId, $memberId);

	header('Location: index.php?action=post&id=' . $postId . '&report=success#commentsFrame');
}

function displaySubscribe() {
	require('view/frontend/subscribeView.php');
}

//fonction Ajouter un membre
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
			$_SESSION['isAdmin'] = $member['isAdmin'];
    		header('Location: index.php');
    	}
        else {
        	header('Location: index.php?action=login&account-status=unsuccess-login');
        }
    }
}

function logout() {
	$_SESSION = array();
	setcookie(session_name(), '', time() - 42000);
	session_destroy();

	header('Location: index.php?logout=success');
}

function displayAbout() {
	require('view/frontend/aboutMeView.php');
}
