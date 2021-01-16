<?php
session_start();

require './controller/frontend.php';
require './controller/backend.php';
require './model/Pagination.php';
require './model/PostManager.php';
require './model/CommentManager.php';
require './model/MemberManager.php';
require './model/ReportManager.php';

try {
	if (isset($_GET['action'])) {
		switch ($_GET['action']) {
			case 'listPosts':
				listPosts();
				break;

			case 'post':
				if (isset($_GET['id']) && $_GET['id'] > 0 && is_numeric($_GET['id'])) {
					post();
				} else {
					throw new Exception('Aucun identifiant de billet envoyé');
				}
				break;

			case 'addComment':
				if (isset($_GET['id']) && $_GET['id'] > 0) {
					if (!empty($_SESSION['pseudo']) && !empty($_POST['comment'])) {
						addComment($_GET['id'], $_SESSION['pseudo'], $_POST['comment']);
					} else {
						throw new Exception('Tous les champs ne sont pas remplis !');
					}
				} else {
					throw new Exception('Aucun identifiant de billet envoyé');
				}
				break;

			case 'subscribe':
				displaySubscribe();
				break;

			case 'addMember':
				if (!empty($_POST['pseudo']) && !empty($_POST['pass']) && !empty($_POST['pass_confirm']) && !empty($_POST['mail'])) {
					if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
						if ($_POST['pass'] == $_POST['pass_confirm']) {
							addMember(strip_tags($_POST['pseudo']), strip_tags($_POST['pass']), strip_tags($_POST['mail']));
						} else {
							throw new Exception('Les deux mots de passe ne correspondent pas.');
						}
					} else {
						throw new Exception('Pas d\'adresse mail valide.');
					}
				} else {
					throw new Exception('Tous les champs ne sont pas remplis !');
				}
				break;

			case 'login':
				displayLogin();
				break;

			case 'loginSubmit':
				loginSubmit(strip_tags($_POST['pseudo']), strip_tags($_POST['pass']));
				break;

			case 'logout':
				logout();
				break;

			case 'report':
				postReport($_GET['id'], $_GET['comment-id'], $_SESSION['id']);
				break;

			case 'about':
				displayAbout();
				break;

			case 'adminLogin':
				loginAdmin();
				break;

			case 'admin':
				if (isset($_SESSION) && $_SESSION['isAdmin'] == '1') {
					displayAdmin();
				} else {
					throw new Exception('Administrateur non identifié');
				}
				break;

			case 'updatePost':
				if (isset($_GET['id']) && $_GET['id'] > 0) {
					if (isset($_SESSION) && $_SESSION['isAdmin'] == '1') {
						displayUpdate();
					}
				} else {
					throw new Exception('Administrateur non identifié');
				}
				break;

			case 'submitUpdate':
				submitUpdate($_POST['title'], $_POST['content'], $_GET['id']);
				break;

			case 'createPost':
				if (isset($_SESSION) && $_SESSION['isAdmin'] == '1') {
					displayCreatePost();
				} else {
					throw new Exception('Administrateur non identifié');
				}
				break;

			case 'submitPost':
				if (!empty($_POST['title']) && !empty($_POST['content'])) {
					newPost($_POST['title'], $_POST['content']);
				} else {
					throw new Exception('Contenu vide !');
				}
				break;

			case 'deletePost':
				removePost(intval($_GET['id']));
				break;

			case 'deleteComment':
				removeComment(intval($_GET['id']));
				break;

			case 'deleteMember':
				removeMember(intval($_GET['id']));
				break;

			default:
				require('view/frontend/errorView.php');
		}
	} else {
		listPosts();
	}
} catch (Exception $e) {
	$errorMessage = $e->getMessage();
	require('view/frontend/errorView.php');
}
