<?php include('includes/header.php'); ?>

	<!-- banniere -->
	<div class="hero" data-bg-image="asset/images/banniere_2.jpg">
		<div class="container"></div>
	</div>
	<div class="forecast-table">
		<div class="container">
			<div class="forecast-container">
				<div class="today forecast">
					<div class="forecast-header">
						<div class="day">Aujourd'hui</div>
					</div>
					<!-- meteo du jour -->
					<div class="forecast-content">
						<div id="city_name"></div>
						<div class="degree">
							<div class="num" id="temperature"></div>
							<div class="forecast-icon" id="weather_picture"></div>	
						</div>
						<span id="humidity"></span>
						<span id="wind"></span>
						<span id="pressure"></span>
					</div>
				</div>

				<!-- meteo des jours suivant -->
				<div class="forecast">
					<div class="forecast-header">
						<div class="day">Demain</div>
					</div>
					<div class="forecast-content">
						<div class="forecast-icon" id="weather_picture2"></div>						
						<div class="degree" id="temperature2"></div>
						<small id="desc2"></small>
					</div>
				</div>
				<div class="forecast">
					<div class="forecast-header">
						<div class="day" id="day3"></div>
					</div> 
					<div class="forecast-content">
						<div class="forecast-icon" id="weather_picture3"></div>
						<div class="degree" id="temperature3"></div>
						<small id="desc3"></small>
					</div>
				</div>
				<div class="forecast">
					<div class="forecast-header">
						<div class="day" id="day4"></div>
					</div> 
					<div class="forecast-content">
						<div class="forecast-icon" id="weather_picture4"></div>				
						<div class="degree" id="temperature4"></div>
						<small id="desc4"></small>
					</div>
				</div>
			</div>
		</div>
	</div>
	<main class="main-content">
		<div class="fullwidth-block">
			<div class="container">
				<h2 class="section-title">Derniers Articles</h2>
				<div class="row">
					<!-- affiche les 4 derniers articles -->
					<?php while($data = $lastPost->fetch()):?>
					<div class="col-md-3 col-sm-6">
						<div class="live-camera">
							<a href="index.php?p=post&id=<?=$data['id']; ?>"><figure class="live-camera-cover"><img src="<?= $data['lien_image']; ?>" alt=""></figure></a>
							<h3 class="location"><?= $data['preview']; ?></h3>
							<small class="date"><?=$data['creation_date_fr']; ?></small>
						</div>
					</div>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
	</main>
	
<!-- script de la meteo -->
<script src="asset/js/ajax_get.js"></script>
<script src="asset/js/Weather.js"></script>
<?php include('includes/footer.php'); ?>
	