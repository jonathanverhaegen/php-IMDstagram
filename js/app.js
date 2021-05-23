
let reportBtns = document.querySelectorAll(".report");

reportBtns.forEach((reportBtn) => {
    reportBtn.addEventListener("click", function(e){
        e.preventDefault();

        let postId = this.dataset.postid;
        let userId = this.dataset.userid;

        

        let formData = new FormData();
        formData.append('post_id', postId);
        formData.append('user_id', userId);

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

//like and unlike and comments

let posts = document.querySelectorAll(".post");

posts.forEach((e) => {
    
    let btnLike = e.querySelector(".btnLike");
    let btnUnlike = e.querySelector(".btnUnlike");
    let displayLikes = e.querySelector(".display-likes");
    let btnComment = e.querySelector(".btnComment");
    let commentField = e.querySelector(".commentInput");

    //like

    btnLike.addEventListener("click", function(f){

        f.preventDefault();

        let postId = this.dataset.postid;
        let userId = this.dataset.userid;
        
        // console.log(postId);
        // console.log(userId);

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
            btnUnlike.style.display = "block";

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
            btnLike.style.display = "block";

            let likes = parseInt(displayLikes.innerHTML);

            likes -= 1;
            displayLikes.innerHTML = likes;
})

        //comment toevoegen
        commentField.addEventListener("keydown", function(f){
            
            if(f.keyCode === 13){
                
                let comment = f.target.value;
                let userId = this.dataset.userid;
                let postId = this.dataset.postid;

                console.log(comment);
                console.log(userId);
                console.log(postId);
                

                let formData = new FormData();
                formData.append('post_id', postId);
                formData.append('user_id', userId);
                formData.append('comment', comment);

                fetch('ajax/comment.php', {
                    method: 'POST',
                    body: formData
                    })
                    .then(response => response.json())
                    .then(result => {
                        console.log('Success:', result);
                        
                        //data uit de json halen
                        let avatar = result.avatar;
                        let username = result.username;
                        let text = result.text;
                        
                        let commentNew = document.createElement("li");
                        let avatarField = document.createElement("img");
                        let usernameField = document.createElement('a');
                        let commentField = document.createElement('p');
                        let time = document.createElement('span');

                        commentNew.className = "comment";
                        avatarField.className = "commentAvatar";
                        avatarField.src = "images/" + avatar;
                        usernameField.className = "commentName";
                        usernameField.innerHTML = username;
                        usernameField.href = "userpage.php?user=" + userId;
                        commentField.className = "commentText";
                        commentField.innerHTML = text;
                        time.className = "commentTime"
                        time.innerHTML = "just now";

                        // nieuwe comment plaatsen
                        e.querySelector('.comments').appendChild(commentNew);
                        commentNew.appendChild(avatarField);
                        commentNew.appendChild(usernameField);
                        commentNew.appendChild(commentField);
                        commentNew.appendChild(time);

                        //comment bijtellen
                        let number = parseInt(document.querySelector(".display-comments").innerHTML);
                        number += 1;
                        document.querySelector(".display-comments").innerHTML = number;
                        

                        
                        

                        

                        

                    })
                    .catch(error => {
                    console.error('Error:', error);
                    });

                 f.target.value = "";
            }
        })
})



