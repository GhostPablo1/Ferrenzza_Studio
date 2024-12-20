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

document.addEventListener('DOMContentLoaded', function() {
    var mensaje = document.querySelector('.mensaje');
    if (mensaje) {
      setTimeout(function() {
        mensaje.style.opacity = '0';
        setTimeout(function() {
          mensaje.remove();
        }, 500);
      }, 4000);
    }
  });
  
//drop
  document.addEventListener('DOMContentLoaded', function() {
    const accountToggle = document.getElementById('accountToggle');
    const dropdownMenu = document.getElementById('dropdownMenu');
    let isDropdownOpen = false;
    
    accountToggle.addEventListener('click', function(event) {
        event.stopPropagation();
        
        if (!isDropdownOpen) {
            dropdownMenu.style.display = 'block';
            dropdownMenu.style.opacity = '1';
            dropdownMenu.style.transform = 'translateY(0)';
            isDropdownOpen = true;
        } else {
            dropdownMenu.style.display = 'none';
            dropdownMenu.style.opacity = '0';
            dropdownMenu.style.transform = 'translateY(-10px)';
            isDropdownOpen = false;
        }
    });

    document.addEventListener('click', function() {
        if (isDropdownOpen) {
            dropdownMenu.style.display = 'none';
            dropdownMenu.style.opacity = '0';
            dropdownMenu.style.transform = 'translateY(-10px)';
            isDropdownOpen = false;
        }
    });

    dropdownMenu.addEventListener('click', function(event) {
        event.stopPropagation();
    });
});