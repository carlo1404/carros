document.addEventListener("DOMContentLoaded", () => {
    const track = document.querySelector('.carousel__track');
    const slides = Array.from(track.children);
    const nextButton = document.querySelector('.carousel__button--right');
    const prevButton = document.querySelector('.carousel__button--left');
    const nav = document.querySelector('.carousel__nav');
    const indicators = Array.from(nav.children);

    // Establece el ancho de cada slide
    const slideWidth = slides[0].getBoundingClientRect().width;
    slides.forEach((slide, index) => {
        slide.style.left = slideWidth * index + 'px';
    });

    const moveToSlide = (track, currentSlide, targetSlide) => {
        track.style.transform = 'translateX(-' + targetSlide.style.left + ')';
        currentSlide.classList.remove('current-slide');
        targetSlide.classList.add('current-slide');
    };

    const updateIndicators = (currentIndicator, targetIndicator) => {
        currentIndicator.classList.remove('current-slide');
        targetIndicator.classList.add('current-slide');
    };

    // Función para ir al siguiente slide
    const goToNextSlide = () => {
        const currentSlide = track.querySelector('.current-slide');
        const nextSlide = currentSlide.nextElementSibling || slides[0];
        const currentIndicator = nav.querySelector('.current-slide');
        const nextIndicator = currentIndicator.nextElementSibling || indicators[0];
        moveToSlide(track, currentSlide, nextSlide);
        updateIndicators(currentIndicator, nextIndicator);
    };

    // Eventos para los botones
    nextButton.addEventListener('click', () => {
        goToNextSlide();
        resetInterval();
    });

    prevButton.addEventListener('click', () => {
        const currentSlide = track.querySelector('.current-slide');
        const prevSlide = currentSlide.previousElementSibling || slides[slides.length - 1];
        const currentIndicator = nav.querySelector('.current-slide');
        const prevIndicator = currentIndicator.previousElementSibling || indicators[indicators.length - 1];
        moveToSlide(track, currentSlide, prevSlide);
        updateIndicators(currentIndicator, prevIndicator);
        resetInterval();
    });

    // Navegación mediante indicadores
    nav.addEventListener('click', e => {
        const targetIndicator = e.target.closest('button');
        if (!targetIndicator) return;
        const currentSlide = track.querySelector('.current-slide');
        const currentIndicator = nav.querySelector('.current-slide');
        const targetIndex = indicators.findIndex(indicator => indicator === targetIndicator);
        const targetSlide = slides[targetIndex];
        moveToSlide(track, currentSlide, targetSlide);
        updateIndicators(currentIndicator, targetIndicator);
        resetInterval();
    });

    // Auto slide cada 5 segundos
    let slideInterval = setInterval(goToNextSlide, 2000);

    // Reinicia el intervalo cuando se interactúa
    const resetInterval = () => {
        clearInterval(slideInterval);
        slideInterval = setInterval(goToNextSlide, 2000);
    };

    // Opcional: Actualiza la posición de los slides al cambiar el tamaño de la ventana
    window.addEventListener('resize', () => {
        const newSlideWidth = slides[0].getBoundingClientRect().width;
        slides.forEach((slide, index) => {
            slide.style.left = newSlideWidth * index + 'px';
        });
        const currentSlide = track.querySelector('.current-slide');
        track.style.transform = 'translateX(-' + currentSlide.style.left + ')';
    });
});

// Agregar mensaje de agregado al botón de comprar
document.addEventListener('DOMContentLoaded', () => {
    const botones = document.querySelectorAll('.boton__comprar');

    botones.forEach(boton => {
        boton.addEventListener('click', () => {
            const mensaje = boton.parentElement.querySelector('.mensaje-agregado');
            mensaje.textContent = "✅ Agregado al carrito";
            mensaje.classList.add('mostrar');

            // Ocultarlo luego de 3 segundos
            setTimeout(() => {
                mensaje.classList.remove('mostrar');
            }, 3000);
        });
    });
});