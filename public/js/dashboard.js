    const maxMostrar = 4; // cantidad visible
    const tarjetasBf = document.querySelectorAll('.beneficio-card');
    const tarjetaCp = document.querySelectorAll('.capacitacion-card');

    tarjetasBf.forEach((tarjeta, i) => {
        if (i >= maxMostrar) {
        tarjeta.style.display = 'none';
        }
    });
    tarjetaCp.forEach((tarjeta, i) => {
        if (i >= maxMostrar) {
        tarjeta.style.display = 'none';
        }
    });
