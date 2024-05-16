<!DOCTYPE html>
<html>
<head>
    <title>Tabla de Datos</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div style="text-align: center;"> 
        <table border="1">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Electricidad (kWh)</th>
                    <th>Agua (litros)</th>
                    <th>Gas (m³)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $csvFile = file('csv/datos24v3.csv');
                    foreach ($csvFile as $line) {
                        $data = str_getcsv($line);

                        if ($data[0] == 'area') continue;

                        echo "<tr>";
                        echo "<td>" . date('Y-m-d', strtotime($data[4])) . "</td>";
                        echo "<td>" . $data[1] . "</td>";
                        echo "<td>" . $data[2] . "</td>";
                        echo "<td>" . $data[3] . "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
