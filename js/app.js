
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

//liken
let btnLikes = document.querySelectorAll(".btnLike");

btnLikes.forEach((btn) => {
    btn.addEventListener("click", function(e){
        e.preventDefault();

        let postId = btn.dataset.postid;
        let userId = btn.dataset.userid;
        
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
            document.querySelector(".btnUnlike").style.display = "flex";
            

            let likes = parseInt(document.querySelector(".display-likes").innerHTML);

            likes += 1;

            

            document.querySelector(".display-likes").innerHTML = likes;
    
    })
    
})

//unliken

let btnUnlikes = document.querySelectorAll(".btnUnlike");

btnUnlikes.forEach((btn) => {
    btn.addEventListener("click", function(e){
        e.preventDefault();

        console.log("unlike")

        let postId = btn.dataset.postid;
        let userId = btn.dataset.userid;
        
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
            document.querySelector(".btnLike").style.display = "flex";

            let likes = parseInt(document.querySelector(".display-likes").innerHTML);

            likes -= 1;

            

            document.querySelector(".display-likes").innerHTML = likes;
    
    })
    
})