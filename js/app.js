
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

            document.querySelector("#location").value = `${city}, ${country}`;
            
        })

    }

    
}


let app = new App;




let reportBtns = document.querySelectorAll(".report");

reportBtns.forEach((reportBtn) => {
    reportBtn.addEventListener("click", function(e){
        e.preventDefault();

        let postId = this.dataset.postid;

        console.log(postId);

        let formData = new FormData();
        formData.append('post_id', postId);

        fetch('ajax/saveReport.php', {
            method: 'POST',
            body: formData
            })
            .then(response => response.json())
            .then(result => {
                console.log('Success:', result);
            })
            .catch(error => {
            console.error('Error:', error);
            });

        this.innerHTML = "post is reported";

    })
})


let deleteBtns = document.querySelectorAll("#deletePost");

deleteBtns.forEach((deleteBtn) => {
    deleteBtn.addEventListener("click", function(e){
        e.preventDefault();

        let postId = this.dataset.postid;

        console.log(postId);

        let formData = new FormData();
        formData.append('post_id', postId);

        fetch('ajax/deletePost.php', {
            method: 'POST',
            body: formData
            })
            .then(response => response.json())
            .then(result => {
                console.log('Success:', result);
            })
            .catch(error => {
            console.error('Error:', error);
            });

        
            this.innerHTML = "post is deleted form buckle up"
        
    })
})

let postOkBTns = document.querySelectorAll("#postOk");

postOkBTns.forEach((postOkBtn) => {
    postOkBtn.addEventListener("click", function(e){
        e.preventDefault();


        let postId = this.dataset.postid;

        console.log(postId);

        let formData = new FormData();
        formData.append('post_id', postId);

        fetch('ajax/deleteReport.php', {
            method: 'POST',
            body: formData
            })
            .then(response => response.json())
            .then(result => {
                console.log('Success:', result);
            })
            .catch(error => {
            console.error('Error:', error);
            });

            this.innerHTML = "the post is now report free"

    })
})
