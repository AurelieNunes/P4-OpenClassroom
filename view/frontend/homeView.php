<?php

$title = "Billet simple pour l'Alaska"; ?>

<?php ob_start(); ?>

<section class="listPosts w-100 d-flex flex-wrap justify-content-around">

	<?php

	// si compte bien créé, affiche message de confirmation à l'utilisateur
	if (isset($_GET['account-status']) && $_GET['account-status'] == 'account-successfully-created') {
		echo '<p id="success">Votre compte a bien été créé. <a href="index.php?action=login">Se connecter</a></p>';
	}

	if (isset($_GET['logout']) && $_GET['logout'] == 'success') {
		echo '<p id="success">Vous êtes bien deconnecté.</p>';
	}

	$data = $posts->fetchAll();
	$posts->closeCursor();

	if (!$data) {
		echo "Aucuns posts à afficher";
	} else {
		for ($i = 0; $i < count($data); $i++) {
	?>
			<div class="card row text-white justify-content-center bg-primary mb-3" style="max-width:45%;">
				<div class="card-header">le <?= $data[$i]['creation_date_fr']; ?></div>
				<div class="card-body">
					<h4 class="card-title"><?= htmlspecialchars($data[$i]['title']); ?></h4>
					<p class="card-text">
						<?php
						$extract = substr($data[$i]['content'], 0, 200);
						echo $extract . " ...";
						?>
						<div class="link-ReadMore">
							<a class="text-white nav-link" href="index.php?action=post&amp;id=<?= $data[$i]['id']; ?>">Lire la suite ...</a>
						</div>
						<p class="img-post">
							<img src="<?= $data[$i]['url']; ?>" alt="<?= $data[$i]['alt']; ?>">
						</p>
					</p>
				</div>
			</div>
	<?php
		}
	}
	?>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>