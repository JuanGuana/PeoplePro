    //vista empleado 
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
    //vista admmin
    function renderEmpleadosPorArea(empleadosPorArea) {
        new Chart(document.getElementById('empleadosPorArea'), {
            type: 'bar',
            data: {
                labels: empleadosPorArea.map(e => e.area),
                datasets: [{
                    label: 'Cantidad de empleados',
                    data: empleadosPorArea.map(e => e.total_empleados),
                    backgroundColor: '#007bff'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    }
