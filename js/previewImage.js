
//image laden in de preview
let figure = document.querySelector("figure");
figure.style.display = "none";
let fileSelect = document.querySelector("#file");

fileSelect.addEventListener("change", function(e){
    let preview = document.querySelector(".prev-image");
    preview.src = URL.createObjectURL(e.target.files[0]);
    figure.style.display = "flex";
})

//preview image de filter geven

let filterSelect = document.querySelector("#filter");

filterSelect.addEventListener("change", function(e){
    let filter = e.target.value;

    let figure = document.querySelector("figure");
    
    figure.className = filter;
    

    
})



