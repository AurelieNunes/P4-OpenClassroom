<?php
$title = "Panel d'administration"; ?>

<?php ob_start(); ?>

<section id="adminPanel">
	<div class="jumbotron">
		<h2 class="text-center">
			<font style="vertical-align: inherit;"> Panel d'administration </font>
		</h2>
	</div>

	<!--Ecrire Article -->
	<div class="headPost mb-4 text-center">
		<h3>Ecrire un article</h3>
		<button class="btn btn-primary" id="writePost"><a class=" text-white" href="index.php?action=createPost">Ecrire
				un article</a></button>
	</div>

	<!-- Gestion des Artciles -->
	<div class="headPost text-center">
		<h3>Gestion des Articles</h3>
		<?php
				if (isset($_GET['update-status']) && $_GET['update-status'] == 'success') {
					echo '<p class="alert alert-dismissible alert-success text-center" id="success">L\'article a bient été modifié !<p>';
				}
				elseif (isset($_GET['new-post']) && $_GET['new-post'] == 'success') {
					echo '<p class="alert-dismissible alert-primary text-center" id="success">L\'article a bient été posté !<p>';
				}
				elseif (isset($_GET['remove-post']) && $_GET['remove-post'] == 'success') {
					echo '<p class="alert alert-dismissible alert-warning text-center" id="success">L\'article a bien été supprimé !</p>';
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
				<div <?= $countPost++ ?>></div>
			</li>
		</ul>

		<div class="modalContent">
			<button class="btnModal btn btn-secondary">Supprimer l'article
				<em><?= $post['title']; ?></button>
		</div>

		<div class="modal">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Supprimer</h5>
					</div>
					<div class="modal-body">
						<p>Voulez-vous vraiment supprimer
							l'article <em><?= $post['title']; ?></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary"> <a class="text-white"
								href="index.php?action=deletePost&amp;id=<?= $post['id']; ?>">Oui</a></button>
						<button type="button" class="btn btn-secondary closeBtn" data-dismiss="close">Non</button>
					</div>
				</div>
			</div>
		</div>


		<section id="updatepost">
			<a class="update" href="index.php?action=updatePost&amp;id=<?= $post['id']; ?>"></a>
			<p class="mb-0"><em><?= $post['date_fr']; ?></em></p>

			<?php if ($post['date_fr'] < $post['update_date_fr']) {
				echo '<p><em>modifié le ' . $post['update_date_fr'] . '</em></p>';
			} ?>
			<?php
						} else {
							echo "<p>Pas d'articles !</p>";
								}
						}
						$posts->closeCursor();
?>
		</section>
		<?php
	// Pagination
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

		<!-- Commentaires signalés -->
		<section class="headPost mb-4" id="commentManage">
			<h3 class="text-center">Gestion des commentaires signalés</h3>
			<?php 
	if (isset($_GET['remove-comment']) &&  $_GET['remove-comment'] == 'success') {
		echo '<p id="success">Le commentaire a bien été supprimé !</p>';
	}

	
	while ($report = $reports->fetch()) {
?>
			<div class="report">

				<div class="card border-primary mb-3">
					<div class="card-header"><?= $report['author']; ?></a></div>
					<div class="card-body">
						<h6 class="card-title text-black"><?= $report['comment']; ?></h6>
						<button type="button" class="btnModal btn btn-primary report removeComment ">Supprimer</button>
					</div>
				</div>

				<div class="modal">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Supprimer</h5>
							</div>
							<div class="modal-body">
								<p>Voulez-vous vraiment supprimer le commentaire de <em><?= $report['author']; ?></p>
							</div>
							<div class="modal-footer">
								<button id="btn" type="button" class="btn btn-primary">
									<a class="confirmDelete text-white"
										href="index.php?action=deleteComment&amp;id=<?= $report['id']; ?>">Oui</a></button>
								<button type="button" class="btn btn-secondary closeBtn"
									data-dismiss="modal">Non</button>
							</div>
						</div>
					</div>
				</div>
				<?php
	}
	$reports->closeCursor();
?>
		</section>

		<!-- Gestion des Membres -->
		<section class="headPost mb-4" id="memberManage">
			<h3 class="text-center">Gestion des membres</h3>

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
					<td><button type="button" class="btnModal btn btn-danger px-1">OUI</button>
					</td>
				</tr>

				<div class="modal">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Supprimer</h5>
							</div>
							<div class="modal-body">
								<p>Voulez-vous vraiment supprimer le membre <em><?= $member['pseudo']; ?></p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary"> <a class="text-white"
										href="index.php?action=deleteMember&amp;id=<?= $member['id']; ?>">Oui</a></button>
								<button type="button" class="btn btn-secondary closeBtn"
									data-dismiss="close">Non</button>
							</div>
						</div>
					</div>
				</div>


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
		</section>
</section>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
<script src="public/js/event.js"></script>