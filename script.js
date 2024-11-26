document.addEventListener('DOMContentLoaded', function () {
    // Funcionalidad del menú desplegable (modal)
    const menuToggle = document.getElementById('menu-toggle');
    const modalMenu = document.getElementById('modal-menu');
    const modalClose = document.getElementById('modal-close');

    // Abrir modal al hacer clic en el botón de menú
    menuToggle.addEventListener('click', function () {
        modalMenu.classList.add('active');
    });

    // Cerrar modal al hacer clic en el botón de cerrar
    modalClose.addEventListener('click', function () {
        modalMenu.classList.remove('active');
    });

    // Cerrar modal al hacer clic fuera del contenido
    modalMenu.addEventListener('click', function (event) {
        if (event.target === modalMenu) {
            modalMenu.classList.remove('active');
        }
    });

    // Funcionalidad del carrusel de imágenes
    const track = document.querySelector('.carousel-track');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    const items = Array.from(document.querySelectorAll('.carousel-item'));
    
    let currentIndex = 0; 
    let offset = 0; 
    
    //blucle
    const firstClone = items[0].cloneNode(true);
    const lastClone = items[items.length - 1].cloneNode(true);
    
    track.appendChild(firstClone);
    track.insertBefore(lastClone, items[0]);
    

    const itemWidth = items[0].clientWidth;
    track.style.transform = `translateX(-${itemWidth}px)`;
    offset = -itemWidth;
    

    function updateCarousel() {
        track.style.transition = `transform 0.5s ease-in-out`;
        track.style.transform = `translateX(${offset}px)`;
    }
    

    nextBtn.addEventListener('click', () => {
        currentIndex++;
        offset -= itemWidth;
        updateCarousel();
    

        if (currentIndex === items.length) {
            setTimeout(() => {
                track.style.transition = 'none';
                offset = -itemWidth; 
                track.style.transform = `translateX(${offset}px)`;
                currentIndex = 0; 
            }, 500);
        }
    });
    

    prevBtn.addEventListener('click', () => {
        currentIndex--;
        offset += itemWidth;
        updateCarousel();
    

        if (currentIndex < 0) {
            setTimeout(() => {
                track.style.transition = 'none'; 
                offset = -(itemWidth * items.length); 
                track.style.transform = `translateX(${offset}px)`;
                currentIndex = items.length - 1; 
            }, 500); 
        }
    });
});    

