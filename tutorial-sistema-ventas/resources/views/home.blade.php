@extends('layouts.app')

@section('content')


<!--.side-menu-->

<h2 class="text-center text-secondary pb-2">PANEL DE CONTROL</h2>

<div class="container-fluid text-center">
    <div class="row">

        <!--.col-->
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-3">
                    <article class="statistic-box red">
                        <div>
                            <div class="number text-light">{{ $total_usuario }}</div>
                            <div class="caption">
                                <div>USUARIO</div>
                            </div>
                        </div>
                    </article>
                </div>
                <!--.col-->
                <div class="col-12 col-sm-6 col-lg-3">
                    <article class="statistic-box purple">
                        <div>
                            <div class="number text-light">{{$total_cliente}}</div>
                            <div class="caption">
                                <div>CLIENTE</div>
                            </div>
                        </div>
                    </article>
                </div>
                <!--.col-->
                <div class="col-12 col-sm-6 col-lg-3">
                    <article class="statistic-box green">
                        <div>
                            <div class="number text-light">{{$total_venta}}</div>
                            <div class="caption">
                                <div>VENTAS DE HOY</div>
                            </div>
                        </div>
                    </article>
                </div>
                <!--.col-->
                <div class="col-12 col-sm-6 col-lg-3">
                    <article class="statistic-box yellow">
                        <div>
                            <div class="number text-light">{{$total_producto}}</div>
                            <div class="caption">
                                <div>PRODUCTO</div>
                            </div>
                        </div>
                    </article>
                </div>


                <!--.col-->
            </div>
            <!--.row-->
        </div>
        <!--.col-->

        <!--.col-->
        <div class="container" style="width: 100%;">
            <canvas id="grafica" height="90"></canvas>
        </div>
        <!--.row-->

    </div>
</div>

<!--.container-fluid-->
<!--.page-content-->
</body>
<script>
    let datas = <?php echo json_encode($ventas); ?>

    const $grafica = document.querySelector("#grafica");
    const etiquetas = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre",
        "Octubre", "Noviembre", "Diciembre"
    ]

    const datosVentas2021 = {
        label: "Ventas - " + <?= date('Y') ?>,
        data: datas, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
        backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
        borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
        borderWidth: 1, // Ancho del borde
    };

    new Chart($grafica, {
        type: 'bar', // Tipo de gráfica
        data: {
            labels: etiquetas,
            datasets: [
                datosVentas2021,
                // Aquí más datos...
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }],
            },
            plugins: {
                title: {
                    display: true,
                    text: 'REPORTE DE VENTAS REALIZADAS'
                }
            }
        }
    });
</script>





@endsection