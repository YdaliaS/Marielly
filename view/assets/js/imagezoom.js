// ===========Box Modal===========
const images = document.querySelectorAll('.img-muestra');
const containerImage = document.querySelector('.container-img');
const imageContainer = document.querySelector('.img-show');
const copy = document.querySelector('.copy');
const closeModal = document.querySelector('.img-close');
const opcionCamara = document.querySelectorAll('.opcion-camara');


opcionCamara.forEach(camara => {
    camara.addEventListener('click', (e) => {
        const productId = e.currentTarget.dataset.productoId;
        const productImage = document.querySelector(`[data-producto-id="${productId}"] .img-muestra`);
        addImage(productImage.getAttribute('src'), productImage.getAttribute('alt'));
    });
});

// FUNCION PARA AGREGAR UNA IMAGEN
const addImage = (srcImage, altImage) => {
    containerImage.classList.toggle('move');
    imageContainer.classList.toggle('show');
    imageContainer.src = srcImage;
    copy.innerHTML = altImage;
};

// FUNCION PARA QUITAR EL CONTAINER DE LA IMAGEN AL DAR CLICK EN EL BOTÓN CLOSE
closeModal.addEventListener('click', () => {
    containerImage.classList.toggle('move');
    imageContainer.classList.toggle('show');
});

window.addEventListener("click", (e) => {
    if (e.target == containerImage) {
        containerImage.classList.toggle('move');
        imageContainer.classList.toggle('show');
    }
});
