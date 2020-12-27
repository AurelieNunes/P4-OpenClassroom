<?php 

$title = "Billet simple pour l'Alaska"; ?>

<?php ob_start(); ?>

<section class="listPosts d-flex justify-content-between">

	<?php

// si compte bien créé, affiche message de confirmation à l'utilisateur
if (isset($_GET['account-status']) && $_GET['account-status'] == 'account-successfully-created') {
	echo '<p id="success">Votre compte a bien été créé. <a href="index.php?action=login">Se connecter</a></p>';
}

if (isset($_GET['logout']) && $_GET['logout'] == 'success') {
	echo '<p id="success">Vous êtes bien deconnecté.</p>';
}


while ($data = $posts->fetch()) {
	if (!empty($data)) {
?>

	<div class="card row text-white justify-content-center bg-primary mb-3" style="max-width: 20rem;">
		<div class="card-header">le <?= $data['creation_date_fr']; ?></div>
		<div class="card-body">
			<h4 class="card-title"><?= htmlspecialchars($data['title']); ?></h4>
			<p class="card-text">
				<?php
					$extract = substr($data['content'], 0, 1000);
					echo $extract . " ...";
				?>
				<div class="link-ReadMore">
					<a class="text-white nav-link" href="index.php?action=post&amp;id=<?= $data['id']; ?>">Lire la suite ...</a>
				</div>
				<svg xmlns="http://www.w3.org/2000/svg" class="d-block user-select-none" width="100%" height="200"
				aria-label="Placeholder: Image cap" focusable="false" role="img" preserveAspectRatio="xMidYMid slice"
				viewBox="0 0 318 180" style="font-size:1.125rem;text-anchor:middle">
				<rect width="100%" height="100%" fill="#868e96"></rect>
				<text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
				</svg>
			</p>
		</div>
	</div>

	<div class="postNull">
		<?php
			} else {
				echo "Ce billet n'existe pas.";
			}
		}
		$posts->closeCursor();
	?>
	</div>

</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>