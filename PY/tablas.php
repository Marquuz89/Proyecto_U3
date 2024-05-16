<!DOCTYPE html>
<html>
<head>
    <title>Tabla de Datos</title>
    <link rel="icon" href="img\table2.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div style="text-align: center;">
    <?php
            $registros_por_pagina = 5;
            $csvFile = file('csv/datos24v3.csv');

            $total_registros = count($csvFile) - 1; 
            $total_paginas = ceil($total_registros / $registros_por_pagina);

            $pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

            $indice_inicio = ($pagina_actual - 1) * $registros_por_pagina;
            $indice_fin = $indice_inicio + $registros_por_pagina;
            $datos_pagina = array_slice($csvFile, $indice_inicio + 1, $registros_por_pagina); 

            echo "<table border='1'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Área</th>";
            echo "<th>Fecha</th>";
            echo "<th>Electricidad (kWh)</th>";
            echo "<th>Agua (litros)</th>";
            echo "<th>Gas (m³)</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($datos_pagina as $line) {
                $data = str_getcsv($line);
                echo "<tr>";
                echo "<td>" . $data[0] . "</td>";
                echo "<td>" . date('Y-m-d', strtotime($data[4])) . "</td>";
                echo "<td>" . $data[1] . "</td>";
                echo "<td>" . $data[2] . "</td>";
                echo "<td>" . $data[3] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";

 
            echo "<div class='pagination'>";
            for ($i = 1; $i <= $total_paginas; $i++) {
                echo "<a href='?pagina=$i' " . ($i == $pagina_actual ? "class='active'" : "") . ">$i</a>";
            }
            echo "</div>";
        ?>
        <div class="btn">
            <a href="tacompleta.php">Tabla completa</a>
            <br>
            <img src="Zeabur/dark.svg" alt="LOGO">
        </div>
    </div>
</body>
</html>
