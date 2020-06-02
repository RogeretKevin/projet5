<?php include('includes/header.php') ?>

    <div id="banner">
		<div id="textBanner">1: Bienvenue sur le site de réservation de vélos VeloLibre</div>
		<button id="stop"><i class="far fa-pause-circle"></i></button>
		<button id="start"><i class="far fa-play-circle"></i></button>
		<button id="left"><i class="fas fa-caret-left"></i></button>
		<button id="right"><i class="fas fa-caret-right"></i></button>
    </div>
    <div class="main">
        <div class="article"></div>
        <div class="meteo">
            <div id="location">
                <span id="city_name"></span>
            </div>
            <div id="main_meteo">
                <div id="meteo_left">
                    <div>
                        <img id="weather_picture" src="" alt="">
                        <p id="weather_desc"></p>
                    </div>
                    <div id="temperature"></div>
                </div>
                <div id="meteo_rigth">
                    <span id="wind"></span><br>
                    <span id="humidity"></span><br>
                    <span id="pressure"></span><br>
                </div>
            </div>
        </div>
    </div>
      
    <div class="main">
        <div id="map"></div>
        <div id="contact"></div>
    </div>

    <?php include('includes/footer.php') ?>