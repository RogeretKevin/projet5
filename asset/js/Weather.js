// CLASS POUR L'API METEO

class Weather {
    constructor(city){
        this.location = document.getElementById("city_name");
        this.picture = document.getElementById("weather_picture");
        this.temp = document.getElementById("temperature");
        this.wind = document.getElementById("wind");
        this.humidity = document.getElementById("humidity");
        this.pressure = document.getElementById("pressure");

        this.picture2 = document.getElementById("weather_picture2");
        this.temp2 = document.getElementById("temperature2");
        this.desc2 = document.getElementById("desc2");

        this.picture3 = document.getElementById("weather_picture3");
        this.temp3 = document.getElementById("temperature3");
        this.desc3 = document.getElementById("desc3");
        this.day3 = document.getElementById("day3");

        this.picture4 = document.getElementById("weather_picture4");
        this.temp4 = document.getElementById("temperature4");
        this.desc4 = document.getElementById("desc4");
        this.day4 = document.getElementById("day4");

        this.ajax = ajaxGet("http://api.openweathermap.org/data/2.5/forecast?appid=33b19dd492795a91a0c5cfa59b4aa5d1&lang=fr&units=metric&q=" + city, function (reponse) {
            let weatherReponse = JSON.parse(reponse); //Traduit la reponse JSON en JavaScript
            this.location.innerHTML = "Meteo de " + weatherReponse.city.name;
            let img = document.createElement("img");
            img.setAttribute('width', '90');
            img.src = "http://openweathermap.org/img/w/" + weatherReponse.list[0].weather[0].icon + ".png";
            this.picture.appendChild(img);
            this.temp.innerHTML = Math.round(weatherReponse.list[0].main.temp) + "C°";
            this.wind.textContent = "Vent: " + Math.round(weatherReponse.list[0].wind.speed * 3,484) + " km/h";
            this.humidity.innerHTML = "Humidité: " + weatherReponse.list[0].main.humidity + " %"
            this.pressure.innerHTML = "Pression: " + weatherReponse.list[0].main.pressure + " hPa"

            let img2 = document.createElement("img");
            img2.setAttribute('width', '48');
            img2.src = "http://openweathermap.org/img/w/" + weatherReponse.list[8].weather[0].icon + ".png";
            this.picture2.appendChild(img2);
            this.temp2.innerHTML = Math.round(weatherReponse.list[8].main.temp) + "C°";
            this.desc2.innerHTML = weatherReponse.list[8].weather[0].description;

            let img3 = document.createElement("img");
            img3.setAttribute('width', '48');
            img3.src = "http://openweathermap.org/img/w/" + weatherReponse.list[16].weather[0].icon + ".png";
            this.picture3.appendChild(img3);
            this.temp3.innerHTML = Math.round(weatherReponse.list[16].main.temp) + "C°";
            this.desc3.innerHTML = weatherReponse.list[16].weather[0].description;
            this.day3.innerHTML = weatherReponse.list[16].dt_txt.substring(0, 10);

            let img4 = document.createElement("img");
            img4.setAttribute('width', '48');
            img4.src = "http://openweathermap.org/img/w/" + weatherReponse.list[24].weather[0].icon + ".png";
            this.picture4.appendChild(img4);
            this.temp4.innerHTML = Math.round(weatherReponse.list[24].main.temp) + "C°";
            this.desc4.innerHTML = weatherReponse.list[24].weather[0].description;
            this.day4.innerHTML = weatherReponse.list[24].dt_txt.substring(0, 10);

        }.bind(this))
    }
}

let newWeather = new Weather("champagne-sur-oise");