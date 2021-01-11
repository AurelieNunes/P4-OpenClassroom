<?php $title = "Inscrivez-vous"; ?>

<?php ob_start(); ?>

<section id="subscribeFrame" class="h-50 mb-5">
<?php 
if (isset($_GET['error']) && $_GET['error'] == 'invalidUsername') {
	echo '<p id="error" class="alert alert-dismissible alert-danger text-center mx-auto">Pseudo déjà utilisé</p>';
}

if (isset($_GET['error']) && $_GET['error'] == 'invalidMail') {
	echo '<p id="error" class="alert alert-dismissible alert-danger text-center mx-auto">Adresse email déjà utilisée</p>';
}

if (isset($_GET['error']) && $_GET['error'] == 'google-recaptcha') {
	echo '<p id="error" class="alert alert-dismissible alert-danger text-center mx-auto">Vous devez cocher la case du captcha.</p>';
}

?>
	<div class="form-group mx-auto">
		<form action="index.php?action=addMember" method="post">
			<label for="pseudo">Pseudo</label><br />
			<input class="mb-2" type="text" name="pseudo" id="pseudo" required /><br />
			<label for="pass">Mot de passe</label><br />
			<input class="mb-2" type="password" name="pass" id="pass" required /><br />
			<label for="pass_confirm">Retapez votre mot de passe</label><br />
			<input class="mb-2" type="password" name="pass_confirm" id="pass_confirm" required /><br />
			<label for="mail">Adresse email</label><br />
			<input class="mb-2" type="email" name="mail" id="mail" required /><br />
			<input class="mb-2" type="submit" value="S'inscrire" />
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