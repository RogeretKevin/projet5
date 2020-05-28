class Weather {
    constructor(city){
        this.location = document.getElementById("city_name");
        this.picture = document.getElementById("weather_picture");
        this.desc = document.getElementById("weather_desc");
        this.temp = document.getElementById("temperature");
        this.wind = document.getElementById("wind");
        this.humidity = document.getElementById("humidity");
        this.pressure = document.getElementById("pressure");
        this.ajax = ajaxGet("http://api.openweathermap.org/data/2.5/weather?appid=33b19dd492795a91a0c5cfa59b4aa5d1&lang=fr&units=metric&q="+ city, function (reponse) {
            let weatherReponse = JSON.parse(reponse); //Traduit la reponse JSON en JavaScript
            this.location.innerHTML = weatherReponse.name;
            this.picture.src = "http://openweathermap.org/img/w/" + weatherReponse.weather[0].icon + ".png";
            this.desc.innerHTML = weatherReponse.weather[0].description
            this.temp.innerHTML = weatherReponse.main.temp + "C°";
            this.wind.innerHTML = "Vent: " + Math.round(weatherReponse.wind.speed * 3,484) + " km/h";
            this.humidity.innerHTML = "Humidité: " + weatherReponse.main.humidity + " %"
            this.pressure.innerHTML = "Pression: " + weatherReponse.main.pressure + " hPa"
        }.bind(this))
    }
}

let newWeather = new Weather("champagne-sur-oise");

console.log(new Date().getTime() / 1000)