// dark mode
const icon = document.getElementById("icon");
icon.addEventListener("click", function () {
    document.body.classList.toggle("dark-theme");
    if (document.body.classList.contains("dark-theme")) {
        icon.src = "../img/sun.png";
        icon2.src = "../img/top-white.png";
    } else {
        icon.src = "../img/moon.png";
        icon2.src = "../img/top-black.png";
    }
});
// login page
function redirectToSignInPage() {
    window.location.href = "signin.html";
}
// register page
function redirectToSignUpPage() {
    window.location.href = "signup.html";
}