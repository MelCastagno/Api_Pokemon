<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokeInfo</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 3em;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        form {
            margin: 20px;
            text-align: center;
        }

        form input {
            padding: 8px;
            font-size: 14px;
            border: 1px solid #4cc9f0;
            border-radius: 4px;
            box-shadow: 2px 2px 2px 1px rgb(0 0 0 / 20%);
        }

        strong {
            color: #4cc9f0;
            border-bottom: 1px solid #4cc9f0;
            padding: 0 3em;
        }

        #resultado {
            font-weight: bold;
        }

        label {
            margin: 2em;
        }

        button {
            margin-top: 1em;
            padding: .5em 1em;
            background-color: #4cc9f0;
            border: 1px solid #4cc9f0;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            box-shadow: 2px 2px 2px 1px rgb(0 0 0 / 20%);
        }
    </style>
</head>

<body>
    <form id="searchForm">
        <label for="texto">BUSCADOR DE POKÉMON</label>
        <br />
        <input type="text" id="texto" name="texto" />
        <br>
        <button type="submit">Buscar</button>
    </form>
    <br />
    <p><strong>Resultados</strong></p>
    <span id="resultado"></span>

    <script type="text/javascript">
        $(document).ready(function() {
            // Manejar la presentación del formulario
            $('#searchForm').submit(function(event) {
                event.preventDefault(); // Prevenir el envío predeterminado del formulario

                var pokemonName = $('#texto').val(); // Obtener el nombre del Pokémon ingresado por el usuario

                // Realizar una solicitud AJAX para obtener información sobre el Pokémon
                $.ajax({
                    url: 'https://pokeapi.co/api/v2/pokemon/' + pokemonName.toLowerCase(),
                    method: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        var html = '<p>Nombre: ' + response.name + '</p>'; // Crear el HTML para el nombre del Pokémon
                        html += '<p>Altura: ' + response.height + '</p>'; // Agregar la altura del Pokémon al HTML
                        html += '<p>Peso: ' + response.weight + '</p>'; // Agregar el peso del Pokémon al HTML
                        html += '<p>Habilidades:</p>'; // Agregar un encabezado para las habilidades
                        html += '<ul>'; // Comenzar una lista desordenada para las habilidades
                        response.abilities.forEach(function(ability) { // Iterar sobre las habilidades del Pokémon
                            html += '<li>' + ability.ability.name + '</li>'; // Agregar cada habilidad a la lista
                        });
                        html += '</ul>'; // Cerrar la lista desordenada
                        $('#resultado').html(html); // Mostrar el HTML en el elemento resultado
                    },
                    error: function (xhr, status, error) {
                        $('#resultado').html('<p>Error: Pokémon no encontrado</p>'); // Mostrar mensaje de error
                        console.error('Error en la solicitud AJAX:', error);
                    }
                });
            });
        });
    </script>
</body>

</html>