class Banner  {
    constructor(){
        this.banner = document.getElementById("banner");
        this.textBanner = document.getElementById("textBanner");
        this.right = document.getElementById("right");
        this.left = document.getElementById("left");
        this.stop = document.getElementById("stop");
        this.start = document.getElementById("start");
        this.images = ["images/banniere_1.jpg", "images/banniere_2.jpg"];
        this.text = ["1: Bienvenue sur le site de réservation de vélos VeloLibre",
                    "2: Pour commencer cliquer sur une station sur la carte ci-dessous",
                    "3: Rentrez vos informations puis signez électroniquement pour réserver",
                    "4: Toute réservation expire au bout de 20 minutes",
                    "5: Profitez de votre vélo VeloLibre"];
        this.result = 0; // Variable pour la position de la banniere
        this.animation = null;
        
        this.advance = this.advance.bind(this);
    }

    // Fonction qui fait avancer la banniere
    advance() {
        if (this.result === this.images.length - 1) {
            this.result = -1
        }
        this.result = this.result + 1
        this.banner.style.backgroundImage = `url(${this.images[this.result]})`;
        this.textBanner.textContent = this.text[this.result];
    }

    // Fonction qui fait reculer la banniere
    back() {
        if (this.result === 0) {
            this.result = this.images.length
        }
        this.result = this.result - 1
        this.banner.style.backgroundImage = `url(${this.images[this.result]})`;
        this.textBanner.textContent = this.text[this.result];
    }

    event() {

        window.addEventListener("load", function() {
            this.animation = setInterval(this.advance, 5000);
        }.bind(this))

        window.addEventListener("keydown", function (e) {
            if (e.keyCode === 39) { // 39 = Droite
                this.advance();
            }
            if (e.keyCode === 37) { // 37 = Gauche
                this.back();
            }
        }.bind(this))

        this.stop.addEventListener("click", function(){
            clearInterval(this.animation);
            this.stop.style.display = "none";
            this.start.style.display = "block";
        }.bind(this))

        this.start.addEventListener("click", function(){
            this.animation = setInterval(this.advance, 5000);
            this.start.style.display = "none";
            this.stop.style.display = "block";
        }.bind(this))

        this.right.addEventListener("click", function(){
            this.advance();  
        }.bind(this));

        this.left.addEventListener("click", function(){
            this.back();
        }.bind(this));
    }
}

let newBanner = new Banner();
newBanner.event();