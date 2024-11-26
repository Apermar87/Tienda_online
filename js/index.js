const contenedor = document.querySelector('.contenedor');
const registerboton = document.querySelector('.register-boton');
const loginboton = document.querySelector('.login-boton');

registerboton.addEventListener('click', ()=>{
    contenedor.classList.add('activo');
});

loginboton.addEventListener('click', ()=>{
    contenedor.classList.remove('activo');
});