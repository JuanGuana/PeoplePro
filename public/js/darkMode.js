const botonConfiguracion = document.getElementById('boton-configuracion')
const menuConfiguracion = document.querySelector('.nav-seccion')

botonConfiguracion.addEventListener('click',()=>{
    menuConfiguracion.classList.toggle('open')
});