<?php

$title = "Erreur"; ?>

<?php ob_start(); ?>

<div class="jumbotron">
  <h1 class="display-3">Oups !</h1>
  <p class="lead">La page demandée n'a pas été trouvée</p>
  <hr class="my-4">
  <p>Que s'est il passé ? Le fichier requis n'a pas été trouvé. Il peut s'agir d'une erreur technique. Veuillez
    réessayer ultérieurement. Si vous ne pouvez pas accéder au fichier après plusieurs tentatives, cela signifie qu'il a
    été supprimé.</p>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>