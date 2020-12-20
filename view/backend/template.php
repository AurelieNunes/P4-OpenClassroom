<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="Blog publiant 'Billet simple pour l'Alaska' de Jean Forteroche" />
		<title><?= $title ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

		<meta property="og:description" content="Blog publiant 'Billet simple pour l'Alaska' de Jean Forteroche" />
		<script src="https://cdn.tiny.cloud/1/vsjqdonn6y5iri7v53hee62c9cfmgeqr5e0iuxnwz44catki/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
		<script>tinymce.init({ selector:'textarea', content_css : '/public/css/style.css', 
  			language_url: 'https://olli-suutari.github.io/tinyMCE-4-translations/fr_FR.js',
			language: 'fr_FR' });</script>

	    <!-- ajouter meta -->
	</head>

	<body>
		<main>
			<header>
				<div id="barre-menu">
					<a href="#" class="header-icon" id="header-icon"></a>
					<nav id="menu">
						<ul>
							<li><a href="index.php">Accueil</a></li>
							<li><a href="index.php?action=about">À propos</a></li>
							<?php
							if (!empty($_SESSION)) {
	                            echo '<li><a href="#"><i class="fas fa-user"></i> ' . htmlspecialchars($_SESSION['pseudo']) . '</a></li>';
	                        }
	                      	if(!empty($_SESSION) && $_SESSION['groups_id'] == '1') {
	                            echo '<li><a href="index.php?action=admin-login-view"><i class="fas fa-key"></i> Administration</a></li>';
	                        }
	                        if (!empty($_SESSION))  {
	                            echo '<li><a href="index.php?action=logout">Déconnexion</a></li>';
	                        } else {
	                            echo '<li><a href="index.php?action=login">Connexion / Inscription</a></li>';
	                        }
							?>
							
						</ul>
					</nav>
				</div>
			</header>

			<?= $content ?>

			<footer>
			</footer>
		</main>

	</body>
</html>