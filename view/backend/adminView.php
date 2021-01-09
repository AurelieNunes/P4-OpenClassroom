<?php $title = "Panneau d'administration"; ?>

<?php ob_start(); ?>

<section id="adminPanel">
	<div class="jumbotron">
		<h2 class="text-center">
			<font style="vertical-align: inherit;"> Panel d'administration </font>
		</h2>
	</div>
	<div class="headPost mb-4 text-center">
		<h3>Ecrire un article</h3>
		<button class="btn btn-primary" id="writePost"><a class=" text-white" href="index.php?action=createPost">Ecrire
				un article</a></button>
	</div>

	<div class="headPost text-center">
		<h3>Gestion des Articles</h3>
		<?php
				if (isset($_GET['update-status']) && $_GET['update-status'] == 'success') {
					echo '<p id="success">L\'article a bient été modifié !<p>';
				}
				elseif (isset($_GET['new-post']) && $_GET['new-post'] == 'success') {
					echo '<p id="success">L\'article a bient été posté !<p>';
				}
				elseif (isset($_GET['remove-post']) && $_GET['remove-post'] == 'success') {
					echo '<p id="success">L\'article a bien été supprimé !</p>';
				}

				$countPost = 0;
				while ($post = $posts->fetch()) 
				{
					if (!empty($post)) {
			?>

			<ul class="list-group">
				<li class="list-group-item d-flex justify-content-between align-items-center">

					<p><a class="linkAdmin"
							href="index.php?action=updatePost&amp;id=<?= $post['id']; ?>"><?= $post['title']; ?></a></p>
					<p><?= $post['date_fr']; ?></p>
					<div id="postModal<?= $countPost++ ?>" class="modal">
				</li>
			</ul>
		<div id="Modal" class="modalContent">
			<a class="confirmDelete" href="index.php?action=deletePost&amp;id=<?= $post['id']; ?>">Supprimer l'article <em><?= $post['title']; ?></a>	
		</div>
			<a class="report" href="index.php?action=updatePost&amp;id=<?= $post['id']; ?>"></a><p class="mb-8"><em><?= $post['date_fr']; ?></em></p>


		<?php if ($post['date_fr'] < $post['update_date_fr']) {
				echo '<p><em>modifié le ' . $post['update_date_fr'] . '</em></p>';
			} ?>
				<?php
						} else {
							echo "<p>Pas d'articles !</p>";
								}
						}
						$posts->closeCursor();

	if ($nbPage >= 2) {
?>
		<section id="Pagination" class="text-right ">
			<div id="pageFrame">
<?php
		for ($i = 1; $i <= $nbPage; $i++) {
			if ((!isset($_GET['page']) && $i == 1) || (isset($_GET['page']) && $_GET['page'] == $i)) {
				echo "<span class='cPageFrame'>$i</span>";
			} else {
				echo "<a class='pageBlock' href=\"index.php?action=admin&amp;page=$i\">$i</a>";
			}
		}
?>
		</div>
<?php
	}

?>
		</section>


	<div class="headPost mb-4" id="commentManage">
		<h3>Gestion des commentaires signalés</h3>
		<?php 
	if (isset($_GET['remove-comment']) &&  $_GET['remove-comment'] == 'success') {
		echo '<p id="success">Le commentaire a bien été supprimé !</p>';
	}

	
	while ($report = $reports->fetch()) {
?>
		<div class="listPanel">
			<p><a class="linkAdmin" href="#"><?= $report['author']; ?></a></p>
			<p><?= $report['comment']; ?></p>
			<button type="button" class="btn btn-primary report removeComment">Supprimer</button>
			<div class="modal">
  				<div class="modal-dialog" role="document">
    				<div class="modal-content">
      					<div class="modal-header">
        					<h5 class="modal-title">Suppression</h5>
        						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          							<span aria-hidden="true">&times;</span>
        						</button>
      					</div>
      					<div id="Modal" class="modal-body">
        					<p>Voulez-vous vraiment supprimer le commentaire de <em><?= $report['author']; ?></p>
      					</div>
      					<div class="modal-footer">
        					<button id="btnModal" type="button" class="btn btn-primary">
								<a class="confirmDelete" href="index.php?action=deleteComment&amp;id=<?= $report['id']; ?>">Oui</a></button>
        					<button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
      					</div>
    				</div>
  				</div>
			</div>
		<?php
	}
	$reports->closeCursor();
?>
	</div>

	<div class="headPost mb-4" id="memberManage">
		<h3>Gestion des membres</h3>

		<?php 
			if (isset($_GET['remove-member']) &&  $_GET['remove-member'] == 'success') 
			{
				echo '<p id="success">Le membre a bien été supprimé !</p>';
			}
		?>

		<table class="mx-auto">
			<tr class="table-warning text-center">
				<td class="px-3">Id</td>
				<td class="px-2">Pseudo</td>
				<td class="px-2">Date <br>d'inscription</td>
				<td class="px-2">Supprimer</td>
			</tr>
			
			<?php
	$countMember = 0;
	while ($member = $members->fetch()) {
		if(!empty($member)) {
?>
			<tr class="text-center">
				<td><?= $member['id']; ?></td>
				<td><?= $member['pseudo']; ?></td>
				<td><em><?= $member['date_sub']; ?></em></td>
				<td><button type="button" class="btn btn-warning px-1">OUI</button>
				
					<div id="Modal<?= $countMember ?>" class="modal">
						<div class="modalContent">
							<p>Voulez-vous vraiment supprimer le membre <em><?= $member['pseudo']; ?></em> ?</p>
							<button id="btnModal"><a class="confirmDelete"
								href="index.php?action=deleteMember&amp;id=<?= $member['id']; ?>">Oui</a></button>
							<span id="closeModal<?= $countMember++ ?>" class="closeModal">Non</span>
						</div>
					</div>
				</td>
			</tr>
			<?php
		} else {
			echo "<p>Pas de membres enregistrés</p>";
		}
	}
?>
		</table>
		<?php
	$members->closeCursor();
?>
	</div>
</section>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>