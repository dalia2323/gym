let mainBtn = document.querySelector('.main-btn');

mainBtn.addEventListener('click', function(event) {
    event.preventDefault(); 
    let targetElement = document.querySelector('.section2');
        targetElement.scrollIntoView({ behavior: 'smooth' });
    
});
document.addEventListener('DOMContentLoaded', function () {
    let infoBtn = document.querySelector('.updateinfo');
    if (infoBtn) {
        infoBtn.addEventListener('click', function (event) {
            event.preventDefault();
            let targetElement = document.querySelector('.health-profile');
            if (targetElement) {
                targetElement.scrollIntoView({ behavior: 'smooth' });
            } else {
                console.error('Target element not found: .health-profile');
            }
        });
    } else {
        console.error('Button not found: .updateinfo');
    }
});




