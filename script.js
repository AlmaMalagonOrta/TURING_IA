const imagenes = document.querySelectorAll(".imagen");
const contenedorImagenes = document.querySelector(".contenedor-imagenes");
const anterior = document.querySelector(".anterior");
const siguiente = document.querySelector(".siguiente");

let posicionActual = 0;

const mostrarImagen = (posicion) => {
    imagenes.forEach((imagen, i) => {
        imagen.classList.remove("active");
        if (i === posicion) {
            imagen.classList.add("active");
        }
    });

    contenedorImagenes.style.transform = `translateX(-${posicionActual * 300}px)`; // Ajustar según el tamaño de las imágenes
}

mostrarImagen(posicionActual);

anterior.addEventListener("click", () => {
    if (posicionActual > 0) {
        posicionActual--;
        mostrarImagen(posicionActual);
    }
});

siguiente.addEventListener("click", () => {
    if (posicionActual < imagenes.length - 1) {
        posicionActual++;
        mostrarImagen(posicionActual);
    }
});

imagenes.forEach((imagen) => {
    imagen.addEventListener("click", () => {
        window.location.href = imagen.dataset.enlace;
    });
});
