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
    const carouselItems = document.querySelectorAll('.carousel-item');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    let currentIndex = 0;

    function showCarouselItem(index) {
        carouselItems.forEach((item, i) => {
            if (i === index) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    prevBtn.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + carouselItems.length) % carouselItems.length;
        showCarouselItem(currentIndex);
    });

    nextBtn.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % carouselItems.length;
        showCarouselItem(currentIndex);
    });

    // Mostrar el primer elemento del carrusel al cargar
    showCarouselItem(currentIndex);
});

