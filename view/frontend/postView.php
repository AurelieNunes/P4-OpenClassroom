<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
    </head>
        
    <body>
        <h1>Mon super blog !</h1>
        <p><a href="index.php">Retour à la liste des billets</a></p>

        <div class="news">
            <h3>
                <?= htmlspecialchars($post['title']) ?>
                <em>le <?= $post['creation_date_fr'] ?></em>
            </h3>
            
            <p>
                <?= nl2br(htmlspecialchars($post['content'])) ?>
            </p>
        </div>

        <h2>Commentaires</h2>

        <?php
        while ($comment = $comments->fetch())
        {
        ?>
            <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
            <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
        <?php
        }
		?>
		
		<?php 
	if (!empty($_SESSION)) {
?>
		<div id="commentForm">
			<p>N'hésitez pas à me laisser un commentaire !</p>
			<form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
				<label for="comment">Commentaire :</label></br>
				<textarea id="comment" name="comment"></textarea> 
				</br>
				<input type="submit" value="Envoyer"/>
			</form>
		</div>
<?php
	} else {
		echo '<div id="info">Pour me laisser un commentaire, veuillez vous <a href="index.php?action=login">connecter</a></div>';
	}
?>
	
</section>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
    </body>
</html>