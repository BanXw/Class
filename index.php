<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Api Pokemon</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    function getPokemonData($id)
    {
        $url = "https://pokeapi.co/api/v2/pokemon/$id";
        $response = file_get_contents($url);
        return json_decode($response, true);
    }

    for ($i = 1; $i <= 100; $i++) {
        $pokemon = getPokemonData($i);
        $name = ucfirst($pokemon['name']);
        $image = $pokemon['sprites']['front_default'];
        $height = $pokemon['height'] / 10; // Convert decimetres to metres
        $weight = $pokemon['weight'] / 10; // Convert hectograms to kilograms
        $hp = 0;
        foreach ($pokemon['stats'] as $stat) {
            if ($stat['stat']['name'] == 'hp') {
                $hp = $stat['base_stat'];
                break;
            }
        }

        echo "
        <div class='pokemon-card'>
            <div class='perspective'>
                <div class='carta_fondo'>
                    <div class='img_charizard' style='background-image: url($image);'></div>
                    <div class='nombre'><h2>$name</h2></div>
                    <div class='nivel'><h6>HP: $hp</h6></div>
                    <div class='altura-peso'>
                        <p>Altura: {$height}m</p>
                        <p>Peso: {$weight}kg</p>
                    </div>
                    <div class='descripcion'><h3>¡Atrápalos ya!</h3></div>
                </div>
            </div>
        </div>";
    }
    ?>
</body>

</html>