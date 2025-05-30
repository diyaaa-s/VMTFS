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
