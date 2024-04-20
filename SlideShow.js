let slideIndex = 0;
slideShow();

function slideShow(){
    let slides = document.getElementsByClassName("mySlide");

    // Hide all slides
    for (let i = 0; i < slides.length; i++){
        slides[i].style.display = "none";
    }
    slideIndex++;

    // If slideIndex is greater than the number of slides, reset it to 1
    if (slideIndex > slides.length) {
        slideIndex = 1;
    }

    // Display the current slide
    slides[slideIndex-1].style.display = "block";

    // Call slideShow again after 3 seconds
    setTimeout(slideShow, 3000);
}
