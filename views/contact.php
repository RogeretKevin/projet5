<?php include('includes/header.php'); ?>

	<main class="main-content">
		<div class="container">
			<div class="breadcrumb">
				<a href="index.php">Accueil</a>
				<span>Contact</span>
			</div>
		</div>
		<div class="fullwidth-block">
			<div class="container">
				<div class="col-md-5">
					<div class="contact-details">
					<!-- map -->
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2610.52354957842!2d2.2289109156841405!3d49.133683279315406!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e65bc9d3828da7%3A0x9c5f047cd1c651b!2s8%20Place%20G%C3%A9n%C3%A9ral%20de%20Gaulle%2C%2095660%20Champagne-sur-Oise!5e0!3m2!1sfr!2sfr!4v1598059396238!5m2!1sfr!2sfr" width="800" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
						<!-- info -->
						<div class="contact-info">
							<address>
							<img src="asset/images/icon-marker.png" alt="">
								<p><a href="http://maps.google.com/?q=8bisPlaceGénéraldeGaulle,95660Champagne-sur-Oise">Mairie<br>8 bis Place Général de Gaulle, 95660 Champagne-sur-Oise</a></p>
							</address>
							<a href="tel:+33130287777"><img src="asset/images/icon-phone.png" alt="">+33 1 30 28 77 77</a>
							<a href="mailto:contact@companyname.com"><img src="asset/images/icon-envelope.png" alt="">contact@companyname.com</a>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-md-offset-1">
					<h2 class="section-title">Contactez nous</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi consectetur inventore ducimus, facilis, numquam id soluta omnis eius recusandae nesciunt vero repellat harum cum. Nisi facilis odit hic, ipsum sed!</p>
					<!-- formulaire de contact -->
					<form action="index.php?p=form" method="POST" class="contact-form">
						<div class="row">
							<div class="col-md-6"><input type="text" name="name" id="name" placeholder="Votre Nom..." maxlength="30" required></div>
							<div class="col-md-6"><input type="email" name="email" id="email" placeholder="Votre Email..." required></div>
						</div>
						<textarea name="message" id="message" placeholder="Message..." maxlength="255" required></textarea>
						<div class="row row col-md-12">
							<input type="checkbox" id="valid" name="valid" value="oui">
							<label for="valid">Etes-vous resident de la ville ?</label>
						</div>
						<div class="text-right">
							<input type="submit" id="button" value="Envoyer">
						</div>
					</form>
					<!-- erreur validation -->
					<ul id="ul-form">
						<?php if(!empty($error)): 
							foreach($error as &$valeur): ?>
								<li><?= $valeur;?></li> 
							<?php endforeach;
						endif; ?>	
					</ul>	
				</div>
			</div>
		</div>
	</main>

<!-- script du formulaire -->
<script src="asset/js/Form.js"></script>
<?php include('includes/footer.php'); ?>