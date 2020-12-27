<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
    </head>
        
    <body>
        <div class="container">
            <p>
                <a href="index.php">Retour à la liste des billets</a>
            </p>

            <div class="card border-primary mb-4" style="max-width: 40rem;">
                <div class="card-header">le <?= $post['creation_date_fr'] ?>
                </div>
                <div class="card-body">
                    <h4 class="card-title"><?= htmlspecialchars($post['title']) ?></h4>
                    <p class="card-text"><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                </div>
            </div>
            
        <h2>Commentaires</h2>

        <?php

        if (isset($_GET['report']) && $_GET['report'] == 'success') {
            echo '<p id="success">Le commentaire a bien été signalé.</p>';
        }
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
            if (!in_array($comment['id'], $idComment) && $comment['author'] !== $_SESSION['pseudo']) {
                echo '<p class="report"><a href="index.php?action=report&amp;id=' . $comment['id_post'] . '&amp;comment-id=' . $comment['id'] . '">Signaler</a></p>';
            }
        }
        ?>
			<p><?= nl2br(htmlspecialchars($comment['comment'])); ?></p>
        
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