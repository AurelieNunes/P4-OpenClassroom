<?php $title = "Panneau d'administration"; ?>

<?php ob_start(); ?>

<section id="adminPanel">
	<div class="jumbotron">
		<h1 class="display-3 text-center">
			<font style="vertical-align: inherit;"> Panel d'administration </font>
		</h1>
	</div>
	<div class="headPost mb-4">
		<h3>Ecrire un article</h3>
		<button class="btn btn-primary" id="writePost"><a class=" text-white" href="index.php?action=createPost">Ecrire
				un article</a></button>
	</div>

	<div class="headPost">
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
				<p><?= $post['creation_date_fr']; ?></p>
				<div id="postModal<?= $countPost ?>" class="modal">
			</li>
		</ul>
		<div class="modalContent mb-4">
			<p class="mb-0">Voulez-vous vraiment supprimer l'article <em><?= $post['title']; ?></em> ?</p>
			<a class="confirmDelete" href="index.php?action=deletePost&amp;id=<?= $post['id']; ?>">Oui</a>
			<span id="closePostModal<?= $countPost++ ?>" class="closeModal">Non</span>
		</div>
		<a class="report" href="index.php?action=updatePost&amp;id=<?= $post['id']; ?>"></a>




	<!-- //if ($post['creation_date_fr'] < $post['update_date_fr']) {
		//echo '<p><em>modifié le ' . $post['update_date_fr'] . '</em></p>';
	}
// -->
			<?php
				} else {
					echo "<p>Pas d'articles !</p>";
						}
				}

			?>
	</div>


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
			<button class="report removeComment"><i class="fas fa-trash-alt"></i></button>
			<div id="reportModal" class="modal">
				<div class="modalContent">
					<p>Voulez-vous vraiment supprimer le commentaire de <em><?= $report['author']; ?></em> ?</p>
					<a class="confirmDelete"
						href="index.php?action=deleteComment&amp;id=<?= $report['id']; ?>">Oui</a>
					<span id="closeCommentModal" class="closeModal">Non</span>
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

		<table>
			<tr class="table-warning text-center">
				<td class="w-25 p-3">Identifiant</td>
				<td class="w-25 p-3">Pseudo</td>
				<td class="w-25 p-3">Date d'inscription</td>
				<td class="w-25 p-3">Supprimer</td>
			</tr>
			<?php
	$countMember = 0;
	while ($member = $members->fetch()) {
		if(!empty($member)) {
?>
			<tr class="text-center">
				<td class="w-25 p-3"><?= $member['id']; ?></td>
				<td class="w-25 p-3"><?= $member['pseudo']; ?></td>
				<td class="w-25 p-3"><em><?= $member['date_sub']; ?></em></td>
				<td class="w-25 p-3"><button type="button" class="btn btn-warning">OUI</button>
				
					<div id="memberModal<?= $countMember ?>" class="modal">
						<div class="modalContent">
							<p>Voulez-vous vraiment supprimer le membre <em><?= $member['pseudo']; ?></em> ?</p>
							<a class="confirmDelete"
								href="index.php?action=deleteMember&amp;id=<?= $member['id']; ?>"><button>Oui</a></button>
							<span id="closeMemberModal<?= $countMember++ ?>" class="closeModal">Non</span>
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