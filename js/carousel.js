document.addEventListener("DOMContentLoaded", () => {
    const track = document.querySelector('.carousel__track');
    const slides = Array.from(track.children);
    const nextButton = document.querySelector('.carousel__button--right');
    const prevButton = document.querySelector('.carousel__button--left');
    const nav = document.querySelector('.carousel__nav');
    const indicators = Array.from(nav.children); // esto es para obtener los indicadores

    // Establece el ancho de cada slide
    const slideWidth = slides[0].getBoundingClientRect().width; // Obtener el ancho del primer slide
    slides.forEach((slide, index) => { // Recorrer cada slide y establecer su posición
        slide.style.left = slideWidth * index + 'px'; // Establecer la posición del slide
    });

    const moveToSlide = (track, currentSlide, targetSlide) => { // Función para mover el track a la posición del slide
        track.style.transform = 'translateX(-' + targetSlide.style.left + ')'; // Establecer la posición del track
        currentSlide.classList.remove('current-slide'); // Eliminar la clase current-slide del slide actual
        targetSlide.classList.add('current-slide'); // Agregar la clase current-slide al slide destino
    };

    const updateIndicators = (currentIndicator, targetIndicator) => { // esta es una  Función para actualizar los indicadores
        currentIndicator.classList.remove('current-slide');
        targetIndicator.classList.add('current-slide');
    };

    // Función para ir al siguiente slide
    const goToNextSlide = () => { // Esta es la función que se ejecuta cada vez que se hace click en el botón de siguiente slide
        const currentSlide = track.querySelector('.current-slide'); // Obtener el slide actual
        const nextSlide = currentSlide.nextElementSibling || slides[0]; //  Obtener el siguiente slide o el primero
        const currentIndicator = nav.querySelector('.current-slide'); // Obtener el indicador actual
        const nextIndicator = currentIndicator.nextElementSibling || indicators[0]; // Obtener el siguiente indicador o el primero
        moveToSlide(track, currentSlide, nextSlide); // esto es para que el track se mueva a la posición del siguiente slide
        updateIndicators(currentIndicator, nextIndicator); // esto para que los indicadores se actualicen
    };

    // Eventos para los botones
    nextButton.addEventListener('click', () => {
        goToNextSlide();
        resetInterval(); // esto es para reiniciar el intervalo cuando se haga click en el botón de siguiente slide
    });

    prevButton.addEventListener('click', () => {
        const currentSlide = track.querySelector('.current-slide');
        const prevSlide = currentSlide.previousElementSibling || slides[slides.length - 1];
        const currentIndicator = nav.querySelector('.current-slide');
        const prevIndicator = currentIndicator.previousElementSibling || indicators[indicators.length - 1];
        moveToSlide(track, currentSlide, prevSlide);
        updateIndicators(currentIndicator, prevIndicator);
        resetInterval();// esto es para reiniciar el intervalo cuando se haga click en el botón de atras
    }); // 

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
    }); // esto es para que cuando se haga click en los indicadores se muevan los slides

    // Auto slide cada 5 segundos
    let slideInterval = setInterval(goToNextSlide, 4000);

    // Reinicia el intervalo cuando se interactúa
    const resetInterval = () => {
        clearInterval(slideInterval);
        slideInterval = setInterval(goToNextSlide, 4000);
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
}); //esto es para que cuando hagamos el resize del navegador se actualicen los slides

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
}); // esto es para ejecutar la función cuando el DOM esté cargado