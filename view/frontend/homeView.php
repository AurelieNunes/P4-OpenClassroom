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

<section class="listPosts h-100">

	<?php

	$data = $posts->fetchAll();

	if (!$data) {
		echo "Aucuns posts à afficher";
	} else {
		for ($i = 0; $i < count($data); $i++) {
	?>
	<div class="card row text-white bg-primary mb-3">
		<div class="card-header">le <?= $data[$i]['date_fr']; ?></div>
		<div class="card-body">
			<h4 class="card-title"><?= htmlspecialchars($data[$i]['title']); ?></h4>
			<p class="card-text">
				<?php
						$extract = substr($data[$i]['content'], 0, 200);
						echo $extract . " ...";
						?>
				<div class="link-ReadMore">
					<a class="text-white nav-link" href="index.php?action=post&amp;id=<?= $data[$i]['id']; ?>">Lire la
						suite ...</a>
				</div>
				<div class="img-posts w-50 mx-auto">
					<img class="img-posts h-auto w-100" src="<?= $data[$i]['lien'];?>"
						alt="<?= $data[$i]['alt']; ?>"></img>
				</div>
			</p>
		</div>
	</div>
	<?php
		}
	} ?>
</section>

<?php
	if ($nbPage >= 2) {
		?>
<div class="pagination text-right">
	<ul class="pagination pagination-sm">

		<?php
				for ($i = 1; $i <= $nbPage; $i++) {
					if ((!isset($_GET['page']) && $i == 1) || (isset($_GET['page']) && $_GET['page'] == $i)) {
						?>
		<li class="page-item disabled">
			<?php
						echo "<span class='cPageFrame page-link'>$i</span>"; ?>
		</li>
		<?php	} else {
					?>
		<li class="page-item active"> <?php
						echo "<a class='pageBlock page-link' href=\"index.php?page=$i\">$i</a>";?>
		</li>
		<?php	}
				}
			}
		?>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>