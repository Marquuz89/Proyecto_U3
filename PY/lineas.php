<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img\business.ico" type="image/x-icon">
    <title>Gráfica de Líneas</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div class="container">
        <h1>Gráfica de Apartementos o Oficinas</h1>
        <p>seleciones las opciones de apartementos, oficinas o completa y despues dar clik en Mostrar para mostrar la grafica de la opcion selecionada</p>
        <p>las opciones de (Electricidad, Gas y de Agua), puedes ser selecionados por si quiere solo ver la electricidad, gas o agua, solo preciones las baras.</p>
        <form action="" method="post">
            <input type="radio" id="completa" name="tipo" value="completa">
            <label for="completa">Completa</label>
            <input type="radio" id="oficinas" name="tipo" value="oficinas">
            <label for="oficinas">Oficinas</label>
            <input type="radio" id="apartamentos" name="tipo" value="apartamentos">
            <label for="apartamentos">Apartamentos</label>
            <button type="submit">Mostrar</button>
        </form>
    </div>
    <canvas id="lineChart" width="800" height="400"></canvas>
    <div class="container">
        <p>Fecha: 2024-05-01 a 2024-05-09</p>
    </div>
    <?php
        $csvFile = file('csv/datos24v3.csv');
        $fechas = [];
        $electricidad = [];
        $agua = [];
        $gas = [];
        $tipoSeleccionado = isset($_POST['tipo']) ? $_POST['tipo'] : 'completa'; // Obtener el tipo seleccionado por el usuario
        
        foreach ($csvFile as $line) {
            $data = str_getcsv($line);
            
            if ($data[0] == 'area') continue;

            // Verificar si el tipo seleccionado coincide con el área o el apartamento
            if (($tipoSeleccionado == 'completa') || 
                ($tipoSeleccionado == 'oficinas' && strpos($data[0], 'Oficina') === false) || 
                ($tipoSeleccionado == 'apartamentos' && strpos($data[0], 'Oficina') !== false)) {
                $fechas[] = date('Y-m-d', strtotime($data[4]));
                $electricidad[] = $data[1];
                $agua[] = $data[2];
                $gas[] = $data[3];
            }
        }
    ?>
    <script>
        var ctx = document.getElementById('lineChart').getContext('2d');
        var lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($fechas); ?>,
                datasets: [{
                    label: 'Electricidad (kWh)',
                    data: <?php echo json_encode($electricidad); ?>,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    fill: false
                }, {
                    label: 'Agua (litros)',
                    data: <?php echo json_encode($agua); ?>,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    fill: false
                }, {
                    label: 'Gas (m³)',
                    data: <?php echo json_encode($gas); ?>,
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</body>
</html>

        