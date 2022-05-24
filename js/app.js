let username = "";
document.querySelector("#usernameInput").addEventListener("keyup", function (e) {
    username = this.value;
    console.log(username);
    console.log(fetch("../ajax/usernameAvailable.php", {
        method: "POST",
        body: username
    }))
});