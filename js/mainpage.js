let mainBtn = document.querySelector('.main-btn');

mainBtn.addEventListener('click', function(event) {
    event.preventDefault(); 
    let targetElement = document.querySelector('.section2');
        targetElement.scrollIntoView({ behavior: 'smooth' });
    
});
document.addEventListener('DOMContentLoaded', function() {
    let infoBtn = document.querySelector('.submit-btn-info');
    if (infoBtn) {
        infoBtn.addEventListener('click', function(event) {
            event.preventDefault();
            infoBtn.textContent = 'Update your inform';
        });
    } else {
        console.error('Element with class .submit-btn-info not found!');
    }
});
