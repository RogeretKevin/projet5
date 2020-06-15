<?php include('includes/header.php') ?>

    <div id="banner">
		<div id="textBanner">1: Bienvenue sur le site de réservation de vélos VeloLibre</div>
		<button id="stop"><i class="far fa-pause-circle"></i></button>
		<button id="start"><i class="far fa-play-circle"></i></button>
		<button id="left"><i class="fas fa-caret-left"></i></button>
		<button id="right"><i class="fas fa-caret-right"></i></button>
    </div>
    <div class="main">
        <div class="article">
            <p>Dernière actualité</p>
            <div>
                <h2><?= $lastPost['title']; ?></h2>
                <p><?= $lastPost['preview']; ?></p>
                <p><a href="">Lire la suite =></a></p>
            </div>
            
        </div>
        <div class="meteo">
            <div id="location">
                <span id="city_name"></span>
            </div>
            <div id="main_meteo">
                <div id="meteo_left">
                    <div>
                        <p><img id="weather_picture" src="" alt=""></p>
                        <p id="temperature"></p>
                        <p id="weather_desc"></p>
                    </div>
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
        <div id="contact">
            <div id="contact_left">
                <form action="index.php?p=form" method="post">
                    <label for="name">Enter your name: </label>
                    <input type="text" name="name" id="name" required></br>
                    <label for="firtName">Enter your firtName: </label>
                    <input type="text" name="firtName" id="firtName" required></br>
                    <label for="email">Enter your email: </label>
                    <input type="email" name="email" id="email" required></br>
                    
                    <p>Resident de la ville:</p>
                    <div>
                    <input type="radio" id="oui" name="valid" value="oui">
                    <label for="oui">oui</label>
                    </div>

                    <div>
                    <input type="radio" id="non" name="valid" value="non">
                    <label for="non">non</label>
                    </div>

                    <input type="submit" value="Envoyer!">
                </form>
            </div>
            <div id="contact_right"></div>
        </div>
    </div>

    <?php include('includes/footer.php') ?>