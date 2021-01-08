<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
</head>

<body>

        <p class="text-center">
            <a href="index.php">Retour à la liste des billets</a>
        </p>

        <div class="card border-primary mb-4 mx-auto" style="max-width: 40rem;">
            <div class="card-header">le <?= $post['date_fr']?>
            <?php 
	            if ($post['date_fr'] < $post['update_date_fr']) {
                echo '<p id="updateDate">modifié le ' . $post['update_date_fr'] . '</p>';
	            }
            ?>	
            </div>
            <div class="card-body">
                <h4 class="card-title"><?= htmlspecialchars($post['title']) ?></h4>
                <p class="card-text"><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                <div class="img-posts w-50 mx-auto">
					<img class="img-posts h-auto w-100" src="<?= $post['lien'];?>" alt="<?= $post['alt']; ?>"></img>
				</div>
            </div>
        </div>

        <h2 class="text-center">Commentaires</h2>

        <?php

        if (isset($_GET['report']) && $_GET['report'] == 'success') {
            echo '<p id="success">Le commentaire a bien été signalé.</p>';
        }
        while ($comment = $comments->fetch())
        {
        ?>
        <div class="modal-dialog mb-2" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= htmlspecialchars($comment['author']) ?></strong> le
                        <?= $comment['comment_date_fr'] ?></h5>

                </div>
                <div class="modal-body">
                    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                </div>
            </div>
        </div>

        <?php 
        if (!empty($_SESSION)) {
            if ($comment['author'] !== $_SESSION['pseudo']) {
                echo '<p class="report text-center"><a href="index.php?action=report&amp;id=' . $comment['post_id'] . '&amp;comment-id=' . $comment['id'] . '">Signaler</a></p>';
            }
        }
    }
        ?>
        <p><?= nl2br(htmlspecialchars($comment['comment'])); ?></p>

        <?php
	    if (!empty($_SESSION)) {
        ?>
        <div id="commentForm" class="pb-5 pt-5">
            <p class="text-center">N'hésitez pas à me laisser un commentaire !</p>
            <form class="mx-auto" action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
                <label for="comment">Commentaire :</label></br>
                <textarea id="comment" name="comment"></textarea>
                </br>
                <input type="submit" value="Envoyer" />
            </form>
        </div>
        <?php
	} else {
		echo '<div id="info" class="text-center text-uppercase mb-5"><em>Pour me laisser un commentaire, veuillez vous<em> <a href="index.php?action=login">connecter</a></div>';
	}
?>

</section>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
</body>

</html>