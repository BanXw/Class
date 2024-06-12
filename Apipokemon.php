<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="backgroud.css">
    <title>Api pokemon</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <?php
    // Inicializar una nueva sesión de cURL
    $ch = curl_init();

    $url = 'https://pokeapi.co/api/v2/pokemon?limit=100&offset=0';
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        echo "Error al conectarse a la API";
    } else {
        curl_close($ch);

        $pokemon_data = json_decode($response, true);

        echo "<table>";
        echo "<tr><th>Nombre</th><th>Imagen</th><th>Altura</th><th>Peso</th></tr>";

        foreach ($pokemon_data['results'] as $pokemon) {
            $ch = curl_init();
            $url = $pokemon['url'];
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                $error_msg = curl_error($ch);
                echo "Error al conectarse a la API";
            } else {
                curl_close($ch);

                $pokemon_details = json_decode($response, true);

                // Mostrar los detalles del Pokémon en una fila de la tabla
                echo "<tr>";
                echo "<td>" . $pokemon_details['name'] . "</td>";
                echo "<td><img src='" . $pokemon_details['sprites']['front_default'] . "' alt=''></td>";
                echo "<td>" . $pokemon_details['height'] . "</td>";
                echo "<td>" . $pokemon_details['weight'] . "</td>";
                echo "</tr>";
            }
        }

        echo "</table>";
    }
    ?>
</body>

</html>