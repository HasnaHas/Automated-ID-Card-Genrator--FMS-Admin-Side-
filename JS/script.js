var i = 0;
var images = ['a.jpg', 'b.jpg', 'c.jpg', 'd.jpg', 'e.jpg'];
var time = 4000;
var slide = document.getElementById('slide-login');
var prevButton = document.getElementById('prevButton-login');
var nextButton = document.getElementById('nextButton-login');

function changeImage(direction) {
    if (direction === 'next') {
        i = (i + 1) % images.length;
    } 
    else if (direction === 'prev') {
        i = (i - 1 + images.length) % images.length;
    }

    slide.src = "images/slideshow/" + images[i];
}

function nextImage() {
    changeImage('next');
}

function prevImage() {
    changeImage('prev');
}

function startSlideshow() {
    setInterval(nextImage, time);
}

slide.src = "images/slideshow/" + images[i];
startSlideshow();

prevButton.addEventListener('click', prevImage);
nextButton.addEventListener('click', nextImage);
