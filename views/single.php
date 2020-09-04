<?php include('includes/header.php'); ?>

	<main class="main-content">
		<div class="container">
			<div class="breadcrumb">
				<a href="index.php">Accueil</a>
				<a href="index.php?p=news">Articles</a>
				<span><?= $post['title']; ?></span>
			</div>
		</div>
		<div class="fullwidth-block">
			<div class="container">
				<div class="row">
					<div class="content col-md-8 col-md-push-2 col-sm-12">
						<div class="post single">
							<!-- post -->
							<h2 class="entry-title"><?= $post['title']; ?></h2>
							<div class="featured-image"><img src="<?= $post['lien_image']; ?>" alt="image_du_post"></div>
							<div class="entry-content">
								<p><?= $post['content']; ?></p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="content col-md-8 col-md-push-2 col-sm-12">
						<!-- nombre de commentaire -->
						<h2 class="entry-title">Commentaires (<?= $result['nbcomment']; ?>)</h2>	
					</div>
				</div>
				<!-- formulaire -->
				<form action="index.php?p=comment" method="POST" class="contact-form">
					<div class="row">
						<div class="content col-md-8 col-md-push-2 col-sm-12"><input type="text" id="pseudo-comment" name="pseudo" placeholder="Votre Nom..." maxlength="20" required></div>
					</div>
					<div class="row">
						<div class="content col-md-8 col-md-push-2 col-sm-12">
							<textarea name="comment" id="comment" placeholder="Message..." maxlength="255" required></textarea>
						</div>
					</div>
					<div class="row">
						<div class="content col-md-8 col-md-push-2 col-sm-12 text-right">
							<input type="submit" id="button-comment" value="Envoyer">
						</div>
					</div>
					<input name="id_post" type="hidden" value="<?= $post['id']; ?>">
				</form></br>
				<!-- erreur validation -->
				<ul class="content col-md-8 col-md-push-2 col-sm-12" id="ul-comment">
					<?php if(!empty($error)): 
						foreach($error as &$valeur): ?>
							<li><?= $valeur;?></li> 
						<?php endforeach;
					endif; ?>	
				</ul>	
				
				<div class="row">
					<?php if($result['nbcomment'] == 0): ?>
						<div class="content col-md-8 col-md-push-2 col-sm-12" id="comment">Soyez le premier à commenter...</div>
					<?php else: ?>
						<div class="content col-md-8 col-md-push-2 col-sm-12">
							<!-- commentaires -->
							<?php while ($data = $comments->fetch()): ?>
									<div class="alert alert-secondary">
										<p><strong><?= $data['pseudo']; ?></strong> le <span><?= $data['comment_date_fr']; ?> </span> - 
										<!-- boutton report -->
										<?php if($data['report'] >= 0):?>
											<a id="verrou" href="index.php?p=report&amp;id=<?= $post['id'];?>&amp;idcomment=<?= $data['id'];?>"><i
											class="fas fa-flag"></i> Signalé</a> <?php else:?>
											<i class="fas fa-check-circle"></i> <?php endif; ?></p>
										<p id="test2"><?= $data['comment']; ?></p>
										<hr>
										</br>
									</div>
							<?php endwhile; ?>
						</div>						
					<?php endif; ?>
				</div>
			</div>
		</div>
	</main>

<!-- script des commentaires -->
<script src="asset/js/Comment.js"></script>
<?php include('includes/footer.php'); ?>