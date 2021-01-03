<?php $title = "Se connecter au panneau d'administration"; ?>

<?php ob_start(); ?>

<section id="adminLoginFrame">
	<h3>Se connecter au panneau d'administration</h3>
<?php
if (isset($_GET['account-status']) &&  $_GET['account-status'] == 'unsuccess-login') {
	echo '<p id="error class="text-center">Mauvais mot de passe !<p>';
}
?>
	<div class="form-group">
		<form action="index.php?action=adminLogin" method="post">
		<label for="pseudo">Pseudo</label><br/>
			<input type="text" name="pseudo" id="pseudo" required /></br>
			<label for="pass">Mot de passe</label><br />
			<input type="password" name="pass" id="pass" required /></br>
			<input type="submit" value="Se connecter" />
		</form>
	</div>
</section>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>