<?php 

$title = "Panneau d'administration"; ?>

<?php ob_start(); ?>

<section id="adminPanel">
	<h1>Panneau d'administration</h1>
	<div id="managerBlock">

		<p class="returnLink"><a href="index.php?action=admin">Retour au menu</a></p>
		<div id="updateBlock">
			<form action="index.php?action=submitUpdate&amp;id=<?= intval($post['id']); ?>" method="post">
				<label for="title">Titre : </label>
				<input type="text" name="title" id="title" value="<?= htmlspecialchars($post['title']);?>" /><br />
				<textarea name="content" rows="40" cols="40"><?= htmlspecialchars($post['content']);?></textarea>
				<input class="mb-5" type="submit" value="Poster" />
			</form>
		</div>
	</div>

</section>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>