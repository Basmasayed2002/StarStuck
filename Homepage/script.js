let slides = document.querySelectorAll(".slide");
let index = 0;
function showSlide() {
    slides.forEach((slide, i) => {
        slide.style.display = (i === index) ? "block" : "none";
    });
    index = (index + 1) % slides.length;
    setTimeout(showSlide, 3000);
}
showSlide();