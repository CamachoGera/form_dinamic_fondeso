<?php
// Conexión a la base de datos
$host = 'localhost';
$bbdd = 'form_dinamico';
$usuario = 'root';
$password = '';

$conexion = new mysqli($host, $usuario, $password, $bbdd);

if ($conexion->connect_errno) {
    die("Fallo la conexión: " . $conexion->connect_error);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#adicional").on('click', function () {
                $("#tabla").clone().removeClass('fila-fila').appendTo('#tabla');
            });

            $(document).on("click", ".eliminar input", function () {
                $(this).closest('tr').remove();
            });
        });
    </script>
</head>

<body>

    <form method="post">
        <h3>Agregar Nuevo Alumno</h3>
        <div id="tabla">
            <table>
                <tbody>
                    <tr class="fila-fila">
                        <td><input required name="idalumno[]" placeholder="ID Alumno"></td>
                        <td><input required name="nombre[]" placeholder="Nombre"></td>
                        <td><input required name="carrera[]" placeholder="Carrera"></td>
                        <td><input required name="grupo[]" placeholder="Grupo"></td>
                        <td class="eliminar"><input type="button" value="Menos -"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <input type="submit" name="insertar" value="Insertar Alumno">
        <button id="adicional" name="adicional" type="button">Más +</button>
    </form>

    <?php
    // Procesar el formulario
    if (isset($_POST['insertar'])) {
        $items1 = $_POST['idalumno'];
        $items2 = $_POST['nombre'];
        $items3 = $_POST['carrera'];
        $items4 = $_POST['grupo'];

        // Crear array para almacenar los valores
        $values = [];

        for ($i = 0; $i < count($items1); $i++) {
            $id = $conexion->real_escape_string($items1[$i]);
            $nom = $conexion->real_escape_string($items2[$i]);
            $carr = $conexion->real_escape_string($items3[$i]);
            $gru = $conexion->real_escape_string($items4[$i]);

            // Agregar a array de valores
            $values[] = "('$id', '$nom', '$carr', '$gru')";
        }

        // Crear la consulta SQL
        if (count($values) > 0) {
            $valuesString = implode(',', $values);
            $sql = "INSERT INTO alumno (idalumno, nombre, carrera, grupo) VALUES $valuesString";

            if ($conexion->query($sql) === TRUE) {
                echo "Nuevos registros insertados correctamente";
            } else {
                echo "Error: " . $sql . "<br>" . $conexion->error;
            }
        }
    }
    ?>

</body>

</html>