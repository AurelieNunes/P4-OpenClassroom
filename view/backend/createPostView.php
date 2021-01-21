<?php 

$title = "Nouvel article"; ?>

<?php ob_start(); ?>

<section id="createPost" class="mx-auto">
	<h1 class="text-center">Panneau d'administration</h1>
	<div id="managerBlock" class="mx-auto">
		<p class="returnLink"><a href="index.php?action=admin">Retour au menu</a></p>
		<div id="updateBlock">
			<form action="index.php?action=submitPost" method="post">
				<label for="title">Titre : </label>
				<input type="text" name="title" id="title" placeholder="Votre titre" size="30" /><br />
				<textarea name="content" rows="20" cols="40"></textarea>
				<input class="mb-5" type="submit" value="Poster" />
			</form>
		</div>
	</div>
</section>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>