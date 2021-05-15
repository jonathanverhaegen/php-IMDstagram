class App{
    constructor(){
        this.getLocation();
    }

    getLocation(){
        navigator.geolocation.getCurrentPosition(this.succes);

    }

    succes(pos){
        
        let lat = pos.coords.latitude;
        let lng = pos.coords.longitude;

        app.getCity(lat,lng);
        
    }

    getCity(lat,lng){

        let key = "19b2bc6c45ce4513abb54cf86761a7d8";
        
        let url = `https://api.opencagedata.com/geocode/v1/json?q=${lat}+${lng}&key=${key}`;

        fetch(url).then((response) =>{
            return response.json();
        }).then((json) =>{

            let city = json.results[0].components.county;
            let country = json.results[0].components.country;
            let country_code = json.results[0].components.country_code;

            document.querySelector("#location").value = `${city} ${country}`;
            document.querySelector("#country_code").value = country_code      
        })

    }

    
}


let app = new App;