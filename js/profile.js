async function report(){
    let username = document.getElementById("username").value
    await fetch("ajax/report.php?username=" + encodeURIComponent(username))
    alert("You succesfully reported " + username)
}

async function follow(){
    let username = document.getElementById("username").value
    await fetch("ajax/follow.php?username=" + encodeURIComponent(username))
}