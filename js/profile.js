async function report(){
    let username = document.getElementById("username").value
    await fetch("ajax/report.php?username=" + encodeURIComponent(username))
    alert("You succesfully reported " + username)
}

async function follow(){
    let username = document.getElementById("username").value
    await fetch("ajax/follow.php?username=" + encodeURIComponent(username))

    // Zet de knop text juist
    if(document.getElementById("follow").innerText == "Follow"){
        document.getElementById("follow").innerText = "Unfollow";
    }
    else if(document.getElementById("follow").innerText == "Unfollow"){
        document.getElementById("follow").innerText = "Follow";
    }

    // TODO: zet het aantal volgers juist
    let request = await fetch("ajax/getFollowCount.php?username=" + encodeURIComponent(username))
    let count = await request.text()

    document.getElementById("followCount").innerText = count
}