let mainBtn = document.querySelector('.main-btn');

mainBtn.addEventListener('click', function(event) {
    event.preventDefault(); 
    let targetElement = document.querySelector('.section2');
        targetElement.scrollIntoView({ behavior: 'smooth' });
    
});
