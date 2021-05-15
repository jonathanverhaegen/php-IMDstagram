
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


let btnMore = document.querySelectorAll(".btn-more");

btnMore.forEach((btn) => {
    btn.addEventListener("click", function(e){
        e.preventDefault();
        console.log("test");
    })
})

//like and unlike

let posts = document.querySelectorAll(".post");

posts.forEach((e) => {
    
    let btnLike = e.querySelector(".btnLike");
    let btnUnlike = e.querySelector(".btnUnlike");
    let displayLikes = e.querySelector(".display-likes");

    //like

    btnLike.addEventListener("click", function(f){

        f.preventDefault();

        let postId = this.dataset.postid;
        let userId = this.dataset.userid;
        
        console.log(postId);
        console.log(userId);

        let formData = new FormData();
        formData.append('post_id', postId);
        formData.append('user_id', userId);

        fetch('ajax/like.php', {
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

            this.style.display = "none";
            btnUnlike.style.display = "flex";

            let likes = parseInt(displayLikes.innerHTML);

            likes += 1;
            displayLikes.innerHTML = likes;



    })

    //unlike

    btnUnlike.addEventListener("click", function(f){

        f.preventDefault();

        let postId = this.dataset.postid;
        let userId = this.dataset.userid;
        
        console.log(postId);
        console.log(userId);

        let formData = new FormData();
        formData.append('post_id', postId);
        formData.append('user_id', userId);

        fetch('ajax/unlike.php', {
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

            this.style.display = "none";
            btnLike.style.display = "flex";

            let likes = parseInt(displayLikes.innerHTML);

            likes -= 1;
            displayLikes.innerHTML = likes;
})
})

