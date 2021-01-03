<?php $title = "Connexion"; ?>

<?php ob_start(); ?>


<section id="loginFrame" class="h-50">

<?php
if (isset($_GET['account-status']) &&  $_GET['account-status'] == 'unsuccess-login') {
	
	echo '<p id="error" class="alert alert-dismissible alert-danger text-center">Mauvais identifiant ou mot de passe !<p>';
}
 
?>
	<div class="form-group mx-auto">
		<form action="index.php?action=loginSubmit" method="post">
			<label for="pseudo">Pseudo</label><br/>
			<input type="text" name="pseudo" id="pseudo" required /></br>
			<label for="pass">Mot de passe</label><br />
			<input type="password" name="pass" id="pass" required /></br>
			<input type="submit" value="Se connecter" />
		</form>
		<a href="index.php?action=subscribe">Pas encore inscrit? C'est ici</a>
	</div>
</section>



<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>