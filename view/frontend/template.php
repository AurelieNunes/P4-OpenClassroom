<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="Blog" />
		<title><?= $title ?></title>
	</head>

	<body>
		<main>
			<header>
				<div id="barre-menu">
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

				<div id="headerFrame">
					<div id="headerImg">
						<a href="index.php"></a>
					</div>
					<div id="header_content">
						<h1>Billet simple pour l'Alaska</h1>
						<p id="authorName">Jean Forteroche</p>
					</div>
				</div>
			</header>

			<?= $content ?>

			
		</main>
	</body>
</html>