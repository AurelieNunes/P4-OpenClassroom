<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://bootswatch.com/4/cerulean/bootstrap.min.css" />
	<title><?= $title ?></title>
	
</head>

<header>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<a class="navbar-brand" href="index.php?action=listPosts">Jean Forteroche, le blog !</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
			aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarColor01">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="index.php?action=listPosts">Accueil</a>
				</li>
				<?php
							if(!empty($_SESSION) && $_SESSION['isAdmin'] == '1') {
	                            echo '<li class="nav-item"><a class="nav-link" href="index.php?action=admin"> Administration</a></li>';
	                        }
	                        if (!empty($_SESSION))  {
	                            echo '<li class="nav-item"><a class="nav-link" href="index.php?action=logout">Déconnexion</a></li>';
	                        } else {
	                            echo '<li class="nav-item"><a class="nav-link" href="index.php?action=login">Connexion / Inscription</a></li>';
							}
							?>
				<?php
							if (!empty($_SESSION)) {
	                            echo '<li class="nav-item d-flex"><p class ="m-auto pr-2 text-white text-uppercase">Bienvenue<p class="m-auto text-white">'  . htmlspecialchars($_SESSION['pseudo']) . '</li>';
	                        }
							?>
			</ul>
			<li class="nav-item">
				<a class="nav-link " href="index.php?action=about">À propos</a>
			</li>
			</ul>
		</div>
	</nav>
</header>

<body>
	<div class="container">
		<?= $content ?>
	</div>

	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
		integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
	</script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
		integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
	</script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
		integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
	</script>
</body>
<footer>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="index.php?action=about"><h5>Qui suis-je</h5></a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" href="index.php?action=listPosts"><h5>Me contacter</h5></a>
			</li>
		</ul>
	</nav>

</footer>

</html>