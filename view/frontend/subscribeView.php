<?php $title = "Inscrivez-vous"; ?>

<?php ob_start(); ?>

<section id="subscribeFrame" class="mx-auto">
<?php 
if (isset($_GET['error']) && $_GET['error'] == 'invalidUsername') {
	echo '<p id="error" class="alert alert-dismissible alert-danger">Pseudo déjà utilisé</p>';
}

if (isset($_GET['error']) && $_GET['error'] == 'invalidMail') {
	echo '<p id="error" class="alert alert-dismissible alert-danger">Adresse email déjà utilisée</p>';
}

if (isset($_GET['error']) && $_GET['error'] == 'google-recaptcha') {
	echo '<p id="error" class="alert alert-dismissible alert-danger">Vous devez cocher la case du captcha.</p>';
}

?>
	<div class="form-group">
		<form action="index.php?action=addMember" method="post">
			<label for="pseudo">Pseudo</label><br />
			<input type="text" name="pseudo" id="pseudo" required /><br />
			<label for="pass">Mot de passe</label><br />
			<input type="password" name="pass" id="pass" required /><br />
			<label for="pass_confirm">Retapez votre mot de passe</label><br />
			<input type="password" name="pass_confirm" id="pass_confirm" required /><br />
			<label for="mail">Adresse email</label><br />
			<input type="email" name="mail" id="mail" required /><br />
			<input type="submit" value="S'inscrire" />
            <!-- <input type="hidden" id="recaptchaResponse" name="recaptcha-response">
			<div class="g-recaptcha" data-sitekey="6LedxgAaAAAAAOAprewvpCwnCMdxhqKK3NEQT82h"></div> -->
		</form>
	</div>




</section>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

<!-- <script src="https://www.google.com/recaptcha/api.js?render=ICI_LA_CLE_DU_SITE"></script>
<script>
grecaptcha.ready(function() {
    grecaptcha.execute('ICI_LA_CLE_DU_SITE', {action: 'homepage'}).then(function(token) {
        document.getElementById('recaptchaResponse').value = token
    });
}); -->
</script>