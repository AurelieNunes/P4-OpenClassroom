<?php

$title = "Billet simple pour l'Alaska"; ?>

<?php ob_start(); ?>
<?php

// si compte bien créé, affiche message de confirmation à l'utilisateur
if (isset($_GET['account-status']) && $_GET['account-status'] == 'account-successfully-created') {
	echo '<div class="alert alert-dismissible alert-success text-center" id="success">
	<p><strong>Votre compte a bien été créé.</strong></p>
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>';
}

if (isset($_GET['logout']) && $_GET['logout'] == 'success') {
	echo '<p class="alert alert-dismissible alert-warning text-center" id="success">Vous êtes bien deconnecté.</p>';
}
?>

<section class="listPosts">

<?php

	$data = $posts->fetchAll();
	$posts->closeCursor();

	if (!$data) {
		echo "Aucuns posts à afficher";
	} else {
		for ($i = 0; $i < count($data); $i++) {
	?>
			<div class="card row text-white bg-primary mb-3">
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