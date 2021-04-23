<?php
include ('conexion.php');
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$consultaRegion = "SELECT * FROM region";
$resultadoRegion = $conexion->prepare($consultaRegion);
$resultadoRegion->execute();
$datosRegion = $resultadoRegion->fetchAll();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>
<body>
<title>Votacion</title>
<h2>Formulario de Votación</h2>

<div>
    <form action="/action_page.php">
        <div>
            <label for="nombre">Nombre y Apellido</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>

        <div>
            <label for="alias">Alias</label>
            <input type="text" id="alias" name="alias" required>
        </div>

        <div>
            <label for="rut">RUT</label>
            <input type="text" id="rut" name="rut" required>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="text" id="email" name="email" required>
        </div>


        <div>
            <label>Region:</label>
            <select id="region" name="region">
                <option value="0">Escoja una region</option>
                <?php
                foreach ($datosRegion as $dr){
                    echo '<option value="'.$dr[0].'">'.$dr[1].'</option>';
                }
                ?>
            </select>
        </div>

        <div id="comuna"></div>

        <input type="submit" value="Votar">
    </form>
</div>

</body>
</html>
<script type="text/javascript">
    $(document).ready(function () {
        recargarLista();
        $('#region').change(function () {
            recargarLista();
        });
    })
</script>
<script type="text/javascript">
    function recargarLista() {
        $.ajax({
            type:"POST",
            url:"datos.php",
            data:"region=" + $('#region').val(),
            success:function(r){
                $('#comuna').html(r);
            }
        });
    }
</script>
<style>
    input[type=text], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type=submit] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }

    div {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
    }
</style>