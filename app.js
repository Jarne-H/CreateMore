let submitButton = document.querySelector("#submitComment");
let commentAmount = document.querySelector(".amountOfComments");

submitButton.addEventListener("click", function (e) {
//postId
//userName
//comment text

let text = document.querySelector("#textComment").value;
//Post naar database via AJAX;
let formData = new FormData();
//Vraagt specifiek element waarop geklikt werd uit de HTML
let userName = submitButton.dataset.username;
let postId = submitButton.dataset.postid;
//console.log(postId);

formData.append("text", text);
formData.append("username", userName);
formData.append("postId", postId);

fetch("ajax/saveComment.php", {

    method: "POST",
    body: formData
})
.then(response=>response.json()

)
.then(result => {
        let newComment = document.createElement("li");
        newComment.innerHTML = result.user + " " + result.body;
        document.querySelector(".commentList").appendChild(newComment);
        commentAmount.innerHTML ++ ;
        document.querySelector("#textComment").value = "";

})
.catch (error=> {

    console.error("Error:", error);
});

e.preventDefault();
})

let buttonCount = 0;
let amount =  document.querySelector(".amount");

let likeButton = document.querySelector(".like");
likeButton.addEventListener("click", function (e) {

    //postId moet worden meegegeven 
    let postId = likeButton.dataset.postid;

    let userName = likeButton.dataset.username;
    let heart = document.querySelector("#heart");
    

    let data = new FormData();
    data.append("postId",postId);
    data.append("username", userName);
    //console.log(data);

if (buttonCount == 0) {
    fetch("ajax/saveLike.php", {

        method: "POST",
        body:data
      


    })
    .then(response => response.json())
    .then (data=> {
        console.log(data);
        buttonCount ++;

        amount.innerHTML ++;
        heart.src = "actie.png";        
        //buttonCount.style.display = "none";

    })
    .catch (error => {
        console.error('Error:', error);
    })
    e.preventDefault();


};
if (buttonCount == 1) {
    fetch("ajax/deleteLike.php", {

        method: "POST",
        body:data
      


    })
    .then(response => response.json())
    .then (data=> {
        console.log(data);
        buttonCount -- ;

        amount.innerHTML -- ;
        heart.src = "unknown.png";        
        //buttonCount.style.display = "none";

        
    })
    .catch (error => {
        console.error('Error:', error);
    })
    e.preventDefault();




}

//Als je nog eens op de like button klikt, dan moet het PHP script deleteLike runnen



    
    //postId moet worden meegegeven 
 
    

    
   /* fetch("ajax/deleteLike.php", {
        method: "POST",
        body:dataDel
    })
    .then(response2 => response2.json())
    .then (dataDel=> {
        console.log(dataDel);
        let amount =  document.querySelector("#amount");
        amount.innerHTML --;
        heart.src = "unknown.png";        
        
        
    })
    .catch (error => {
        console.error('Error:', error);
    })
    e.preventDefault();*/

})