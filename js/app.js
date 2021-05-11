
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
