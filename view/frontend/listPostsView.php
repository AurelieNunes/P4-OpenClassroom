<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<p>Derniers billets du blog :</p>

<?php
while ($data = $posts->fetch())
{
?>
    <div class="container">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">
                        <?= htmlspecialchars($data['title']) ?>
                        <em>le <?= $data['creation_date_fr'] ?></em>
                    </h3>
                    
                    <p class="card-text">
                        <?= nl2br(htmlspecialchars($data['content'])) ?>
                        <br />
                        <em><a href="index.php?action=post&amp;id=<?=$data['id']?>">Commentaires</a></em>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>