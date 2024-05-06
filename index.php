<?php
session_start();
if(isset($_SESSION['Reg'])){
	if($_SESSION['Reg']=='ok'){

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>    Administradores</h1>
<?php
    $con = new mysqli("localhost", "root", "", "cinedb");

    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);
    }

    if(isset($_POST['add_sala'])){//Agrega sala
        $nombre = $_POST['nombre'] ?? ''; 
        $codigo = $_POST['codigo'] ?? '';
        $capacidad = $_POST['capacidad'] ?? '';

        $sql ="INSERT INTO salas (nombre, codigo, capacidad) ".
			  "VALUES ('$nombre', '$codigo', '$capacidad')";
        $consulta = mysqli_query ($con,$sql)
        or die ("Fallo en la consulta");
    }

    if(isset($_POST['add_pelicula'])){//Agrega sala
        $nombre = $_POST['nombre'] ?? ''; 
        $codigo = $_POST['codigo'] ?? '';
        $clasificacion = $_POST['clasificacion'] ?? '';

        $sql ="INSERT INTO peliculas (nombre, codigo, clasificacion) ".
			  "VALUES ('$nombre', '$codigo', '$clasificacion')";
        $consulta = mysqli_query ($con,$sql)
        or die ("Fallo en la consulta");
    }
    
    $sql = 'SELECT * FROM administradores';
    $result = $con->query($sql);      
    $arr = array();
    while ($fil = $result->fetch_assoc()) {
        $arr[] = $fil;
    }

    foreach ($arr as $registro) {
?>

    <TABLE BORDER>
	<TR>
		<TD>Nombre</TD>
        <TD>Usuario</TD>
        <TD>Correo</TD>
	</TR>
	<TR>
		<TD><?php echo $registro['nombre']?></TD>
        <TD><?php echo $registro['username']?></TD>
        <TD><?php echo $registro['correo']?></TD>
	</TR>
</TABLE>
<?PHP
}
?>


<hr>
<br>

<h1>Salas</h1>

<form method ="POST" action="index.php">
    <label for="nombre">Nombre de la sala:</label> 
    <input type="text" name="nombre" value=""  required > 
    <label for="codigo">Codigo de sala:</label>
    <input type="number" name="codigo" value="" required>
    <label for="capacidad">Capacidad de sala:</label>
    <input type="number" name="capacidad" value=""required>
    <button name="add_sala">añadir sala</button>
</form> 

<br>


    <TABLE BORDER>
        <TR>
            <TD>Nombre</TD>
            <TD>Codigo</TD>
            <TD>Capacidad</TD>
            <TD>Acciones</TD>
        </TR>
        <?php
    
    $sql_sala = 'SELECT * FROM salas';
    $result_sala = $con->query($sql_sala);      
    $arr_sala = array();
    while ($fil_sala = $result_sala->fetch_assoc()) {
        $arr_sala[] = $fil_sala;
    }

    foreach ($arr_sala as $registro_sala) {
?>
        <TR>
            <TD><?php echo $registro_sala['nombre']?></TD>
            <TD><?php echo $registro_sala['codigo']?></TD> 
            <TD><?php echo $registro_sala['capacidad']?> </TD>
            <TD>
            <form action="index.php" method="post">
                <input type="hidden" name="id" value=<?php echo $registro_sala['id']?>>
                <input type="submit" name="del" value="DEL">
            </form>
            </TD>
        </TR>
        <?PHP
}
?>
    </TABLE>
    


<hr>
<br>

<h1>Peliculas</h1>

<form method ="POST" action="index.php">
    <label for="nombre">Nombre de pelicula:</label> 
    <input type="text" name="nombre" value=""  required > 
    <label for="codigo">Codigo de pelicula:</label>
    <input type="number" name="codigo" value="" required>
    <label for="clasificacion">Clasificacion:</label>
    <select name="clasificacion" id="clasificacion">
        <option>-- selecciona --</option>
        <option value="TP">TP</option>
        <option value="7">7</option>
        <option value="12">12</option>
        <option value="15">15</option>
        <option value="18">18</option>
    </select>
    <button name="add_pelicula">añadir pelicula</button>
</form> 

<br>


    <TABLE BORDER>
        <TR>
            <TD>Nombre</TD>
            <TD>Codigo</TD>
            <TD>Clasificacion</TD>
            <TD>Acciones</TD>
        </TR>
        <?php
    
            $sql_pelicula = 'SELECT * FROM peliculas';
            $result_pelicula = $con->query($sql_pelicula);      
            $arr_pelicula = array();
            while ($fil_pelicula = $result_pelicula->fetch_assoc()) {
                $arr_pelicula[] = $fil_pelicula;
            }

            foreach ($arr_pelicula as $registro_pelicula) {
        ?>
            <TR>
                <TD><?php echo $registro_pelicula['nombre']?></TD>
                <TD><?php echo $registro_pelicula['codigo']?></TD> 
                <TD><?php echo $registro_pelicula['clasificacion']?> </TD>
                <TD>
                <form action="index.php" method="post">
                    <input type="hidden" name="id" value=<?php echo $registro_pelicula['id']?>>
                    <input type="submit" name="del" value="DEL">
                </form>
                </TD>
            </TR>
        <?PHP
}
?>
    </TABLE>
    


<?php
}else{
    header("Location: login.php");
}

}else{
header("Location: login.php");
}		

?>
</body>
</html>