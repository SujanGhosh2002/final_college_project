// dark mode
const icon = document.getElementById("icon");
icon.addEventListener("click", function () {
  document.body.classList.toggle("dark-theme");
  if (document.body.classList.contains("dark-theme")) {
    icon.src = "img/sun.png";
    icon2.src = "img/top-white.png";
  } else {
    icon.src = "img/moon.png";
    icon2.src = "img/top-black.png";
  }
});
// login page
function redirectToSignInPage() {
  window.location.href = "signin.php";
}
// register page
function redirectToSignUpPage() {
  window.location.href = "signup.php";
}
// carousel
const slides = document.querySelectorAll(".box2");
const nextBtn = document.querySelector(".c2right");
const prevBtn = document.querySelector(".c2left");

slides.forEach((slide, index) => {
  slide.style.left = `${index * 100}%`;
});

let counter = 0;
nextBtn.addEventListener("click", function () {
  counter++;
  carousel();
});
prevBtn.addEventListener("click", function () {
  counter--;
  carousel();
});
function carousel() {
  if (counter === slides.length) {
    counter = 0;
  }
  if (counter < 0) {
    counter = slides.length - 1;
  }
  slides.forEach(function (slide) {
    slide.style.transform = `translateX(-${counter * 100}%)`;
  });
}
