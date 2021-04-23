<?php
include ('conexion.php');
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$region=$_POST['region'];
    $sql="SELECT * FROM comuna WHERE comuna.id_region = '$region'";
    $resultadoComuna = $conexion->prepare($sql);
$resultadoComuna->execute();
$datosComuna = $resultadoComuna->fetchAll();
$cadena="<label>Comuna:</label> 
			<select id='comuna' name='comuna'>";

foreach ($datosComuna as $dc){
    $cadena=$cadena.'<option value='.$dc[0].'>'.utf8_encode($dc[2]).'</option>';
}

echo  $cadena."</select>";
