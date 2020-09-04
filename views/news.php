<?php include('includes/header.php'); ?>

	<main class="main-content">
		<div class="container">
			<div class="breadcrumb">
				<a href="index.php">Accueil</a>
				<span>Articles</span>
			</div>
		</div>
		<div class="fullwidth-block">
			<div class="container">
				<div class="row">
					<div class="content col-md-8 col-md-push-2 col-sm-12">
						<!-- affiche la liste des articles -->
						<?php while ($data = $post->fetch()): ?>
							<div class="post">
								<h2 class="entry-title"><?= $data['title']; ?></h2>
								<div class="featured-image"><img src="<?= $data['lien_image']; ?>" alt=""></div>
								<p><?= $data['preview']; ?></p>
								<a href="index.php?p=post&id=<?= $data['id']; ?>" class="button">Lire la suite</a>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
			</div>
		</div>
	</main>

<?php include('includes/footer.php'); ?>