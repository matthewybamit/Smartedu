document.getElementById("signUp").addEventListener("click", function () {
    document.querySelector(".container").classList.add("move-left");
});

document.getElementById("signIn").addEventListener("click", function () {
    document.querySelector(".container").classList.remove("move-left");
});
