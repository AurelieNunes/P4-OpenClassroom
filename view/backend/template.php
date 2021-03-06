<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?= $title ?></title>

	<link rel="icon" type="image/png" href="/public/images/newlogo.png">
	<meta name="description"
		content="Jean Forteroche, le blog ! Ici vous trouverez mon histoire au fur et à mesure de mes aventures">

	<meta name="author" content="NUNES Aurélie" />

	<!-- Twitter Card data -->
	<meta name="twitter:card" content="summary">

	<!--Open Graph data -->
	<meta property="og:title" content="Jean Forteroche, le blog !" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="http://p4-leblog.aurelie-nunes.fr/" />
	<meta property="og:description" content="Ici vous trouverez mon histoire au fur et à mesure de mes aventures" />

	<!--Bootstrap -->
	<link rel="stylesheet" href="https://bootswatch.com/4/cerulean/bootstrap.min.css" />
	<!-- Feuille CSS -->
	<link rel="stylesheet" href="public/style.css" />
</head>

<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<div class="logoHeader">
				<img src="/public/images/newlogo.PNG" alt="logo écran pc avec initiales">
			</div>
			<a class="navbar-brand mx-auto" href="index.php?action=listPosts">
				<h6>Jean Forteroche, le blog !</h6>
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
				aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarColor01">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active ml-auto p-2">
						<a class="nav-link" href="index.php?action=listPosts">Accueil</a>
					</li>
					<?php
									
						if(!empty($_SESSION) && $_SESSION['isAdmin'] == '1') {
							echo '<li class="nav-item ml-auto p-2"><a class="nav-link" href="index.php?action=admin"> Administration</a></li>';
							}
						if (!empty($_SESSION))  {
							echo '<li class="nav-item ml-auto p-2"><a class="nav-link" href="index.php?action=logout">Déconnexion</a></li>';
								} else {
									echo '<li class="nav-item ml-auto p-2"><a class="nav-link" href="index.php?action=login">Connexion / Inscription</a></li>';
										}
									if (!empty($_SESSION)) {
										echo '<li class="nav-item d-flex ml-auto p-2"><p class ="m-auto pr-2 text-white text-uppercase">Bienvenue<p class="m-auto text-white">'  . htmlspecialchars($_SESSION['pseudo']) . '</li>';
										}
					?>
				</ul>
			</div>
		</nav>
	</header>


	<section class="container">
		<?= $content ?>
	</section>

	<footer>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark d-flex mb-2">
			<div class="navbar-nav mr-auto w-100">
				<p class="fictif small font-weight-light text-white p-2">
					Ce blog est fictif ! Projet réalisé pour Openclassrooms par Aurélie Nunes</p>
			</div>
		</nav>

		<blockquote class="blockquote text-center">
			<p class="mb-0 font-italic font-weight-light">Le confort nous éloigne de la personne que nous sommes. Il
				faut
				savoir prendre du recul pour
				mieux se retrouver</p>
			<div class="blockquote-footer">Aurelie <cite title="Source Title">My Brain</cite></div>
		</blockquote>
	</footer>

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
	<script src="public/js/event.js"></script>
</body>

</html>