class Map {
    constructor(coord, zoom) {
        this.map = L.map('map').setView(coord, zoom);
        this.tilelaye = L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox.streets',
            accessToken: 'pk.eyJ1Ijoia2V2aW45NTY2MCIsImEiOiJjazJwNDVic3AwMGRnM2JyMHVvZTE5cm13In0.IsjagDHBcNrtSAr4bHwgTQ'
        }).addTo(this.map);
        
        this.iconMonument = L.icon({
            iconUrl: "images/map-marker-alt-solid.svg",
            iconSize: [25, 25],
            iconAnchor: [25, 50],
            popupAnchor: [0, -50],
        });

        this.iconTrain = L.icon({
            iconUrl: "images/train-solid.svg",
            iconSize: [25, 25],
            iconAnchor: [25, 50],
            popupAnchor: [0, -50],
        });

        this.iconChurch = L.icon({
            iconUrl: "images/church-solid.svg",
            iconSize: [25, 25],
            iconAnchor: [25, 50],
            popupAnchor: [0, -50],
        });
    }

    myMarker = (coord, myIcon, image) =>{
        let markers = {
            marker: L.marker(coord, {
                icon: myIcon
            }).addTo(this.map).bindPopup(image),
        }
    }
}

newMap = new Map([49.1339431,2.2312397], 13);
newMap.myMarker([49.13326437340835, 2.2302923680681364], newMap.iconMonument, '<img id="icon" src="images/icon_1.jpg"><br>Calvaire devant l\'église.');
newMap.myMarker([49.13969882079125, 2.2429553061596774], newMap.iconMonument, '<img id="icon" src="images/icon_2.jpg"><br>Ancien hôtel-Dieu.');
newMap.myMarker([49.137451670887636, 2.2399261073637167], newMap.iconMonument, '<img id="icon" src="images/icon_3.jpg"><br><p id="text_icon">L\'obélisque et la fontaine de la place Quideau.</p>');
newMap.myMarker([49.1351203918457, 2.2349607944488525], newMap.iconMonument, '<img id="icon" src="images/icon_4.jpg"><br><p id="text_icon">Maison du peintre Auguste Boulard.</p>');
newMap.myMarker([49.137236839688036, 2.236438506825711], newMap.iconMonument, '<img id="icon" src="images/icon_5.jpg"><br><p id="text_icon">Lavoir de la fin du xixe siècle.</p>');
newMap.myMarker([49.138638421943114, 2.2357361529020903], newMap.iconMonument, '<img id="icon" src="images/icon_6.jpg"><br><p id="text_icon">Maison de garde de l\'ancien château.</p>');
newMap.myMarker([49.13372637029173, 2.2306817099631404], newMap.iconMonument, '<img id="icon" src="images/icon_7.jpg"><br><p id="text_icon">Monument aux morts.</p>');
newMap.myMarker([49.133436003594326, 2.230554678921135], newMap.iconMonument, '<img id="icon" src="images/icon_8.jpg"><br><p id="text_icon">Stèles funéraires des époux Corbineau.</p>');
newMap.myMarker([49.13339006332821, 2.2302449081466236], newMap.iconMonument, '<img id="icon" src="images/icon_9.jpg"><br><p id="text_icon">Le presbytère de 1868.</p>');
newMap.myMarker([49.13513860257433, 2.226738079193078], newMap.iconMonument, '<img id="icon" src="images/icon_10.jpg"><br><p id="text_icon">Tombes de poilus.</p>');
newMap.myMarker([49.13326696664962, 2.227636188855797], newMap.iconMonument, '<img id="icon" src="images/icon_11.jpg"><br><p id="text_icon">Clos Patrix, maison natale de Claude Viseux.</p>');
newMap.myMarker([49.13378209922619, 2.2309858108096847], newMap.iconMonument, '<img id="icon" src="images/icon_12.jpg"><br><p id="text_icon">Mairie.</p>');
newMap.myMarker([49.135718228096565, 2.241542335122264], newMap.iconTrain, '<img id="icon" src="images/icon_13.jpg"><br><p id="text_icon">Gare.</p>');
newMap.myMarker([49.13346717145107, 2.23089965290983], newMap.iconChurch, '<img id="icon" src="images/icon_14.jpg"><br><p id="text_icon">Église.</p>');