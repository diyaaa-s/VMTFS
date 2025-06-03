let slideIndex = 0;

function showSlides() {
  const slides = document.querySelectorAll(".slide");

  slides.forEach((slide) => {
    slide.classList.remove("active-slide");
  });

  slides[slideIndex].classList.add("active-slide");

  slideIndex++;

  if (slideIndex >= slides.length) {
    slideIndex = 0;
  }

  setTimeout(showSlides, 3000);
}

window.onload = function () {
  showSlides();
};

const menuToggle = document.getElementById("menuToggle");
const menu = document.getElementById("menu");
const body = document.body;

menuToggle.addEventListener("click", () => {
  menu.classList.toggle("show");
  body.classList.toggle("no-scroll");
});

// Close menu after clicking a menu link
document.querySelectorAll(".menu li a").forEach(link => {
  link.addEventListener("click", () => {
    if (window.innerWidth <= 768) {
      menu.classList.remove("show");
      body.classList.remove("no-scroll");
    }
  });
});

// Optional: Close menu on resize
window.addEventListener("resize", () => {
  if (window.innerWidth > 768) {
    menu.classList.remove("show");
    body.classList.remove("no-scroll");
  }
});
