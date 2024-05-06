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

    if(isset($_POST['add_pelicula'])){//Agrega pelicula
        $nombre = $_POST['nombre'] ?? ''; 
        $codigo = $_POST['codigo'] ?? '';
        $clasificacion = $_POST['clasificacion'] ?? '';

        $sql ="INSERT INTO peliculas (nombre, codigo, clasificacion) ".
			  "VALUES ('$nombre', '$codigo', '$clasificacion')";
        $consulta = mysqli_query ($con,$sql)
        or die ("Fallo en la consulta");
    }

    if(isset($_POST['add_funcion'])){//Agrega funcion
        $codigo = isset($_POST['codigo']) ? $_POST['codigo'] : '';
        $sala_id = isset($_POST['sala_id']) ? $_POST['sala_id'] : '';
        $pelicula_id = isset($_POST['pelicula_id']) ? $_POST['pelicula_id'] : '';
        $fecha_hora = isset($_POST['fecha_hora']) ? $_POST['fecha_hora'] : '';

        $fecha_hora = date('Y-m-d H:i:s', strtotime($fecha_hora));

        $sql ="INSERT INTO funciones (codigo_funcion, fecha_hora, sala_id, pelicula_id) ".
            "VALUES ('$codigo', '$fecha_hora', '$sala_id', '$pelicula_id')";
        $consulta = mysqli_query($con, $sql) or die("Fallo en la consulta");
        
    }

    if(isset($_POST['del_sala'])){//Eliminar sala
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $del_sala = "DELETE FROM salas WHERE id = $id";
        $consulta = mysqli_query ($con ,$del_sala)
        or die ("Fallo en la eliminacion");
    }

    if(isset($_POST['del_pelicula'])){//Eliminar pelicula
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $del_sala = "DELETE FROM peliculas WHERE id = $id";
        $consulta = mysqli_query ($con ,$del_sala)
        or die ("Fallo en la eliminacion");
    }
    if(isset($_POST['del_funcion'])){//Eliminar funcion
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $del_sala = "DELETE FROM funciones WHERE id = $id";
        $consulta = mysqli_query ($con ,$del_sala)
        or die ("Fallo en la eliminacion");
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
                <input type="submit" name="del_sala" value="DEL">
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
                    <input type="submit" name="del_pelicula" value="DEL">
                </form>
                </TD>
            </TR>
        <?PHP
}
?>
    </TABLE>

<hr>
<br>

<h1>Funciones</h1>

<form method ="POST" action="index.php">
    <label for="codigo">Codigo de funcion:</label>
    <input type="number" name="codigo" value="" required>
    <label for="fecha_hora">Fecha y hora:</label>
    <input type="datetime-local" name="fecha_hora" >
    <label for="pelicula_id">Pelicula:</label>
    <select name="pelicula_id" id="pelicula_id">
        <option>-- selecciona --</option>
        <?php foreach ($arr_pelicula as $registro_pelicula) { ?>
        <option value="<?php echo $registro_pelicula['id']?>"><?php echo $registro_pelicula['nombre']?></option>
        <?php }?>
    </select>
    <label for="sala_id">Sala:</label>
    <select name="sala_id" id="sala_id">
        <option>-- selecciona --</option>
        <?php foreach ($arr_sala as $registro_sala) { ?>
        <option value="<?php echo $registro_sala['id']?>"><?php echo $registro_sala['nombre']?></option>
        <?php }?>
    </select>
    <button name="add_funcion">añadir pelicula</button>
</form> 

<br>

<TABLE BORDER>
        <TR>
            <TD>Codigo</TD>
            <TD>Hora de funcion</TD>
            <TD>Pelicula</TD>
            <TD>Sala</TD>
            <TD>Acciones</TD>
        </TR>
        <?php
    
            $sql_funcion = 'SELECT * FROM funciones';
            $result_funcion = $con->query($sql_funcion);      
            $arr_funcion = array();
            while ($fil_funcion = $result_funcion->fetch_assoc()) {
                $arr_funcion[] = $fil_funcion;
            }

            foreach ($arr_funcion as $registro_funcion) {
        ?>
            <TR>
                <TD><?php echo $registro_funcion['codigo_funcion']?></TD> 
                <TD><?php echo $registro_funcion['fecha_hora']?> </TD>
                <TD><?php echo $registro_funcion['pelicula_id']?></TD> 
                <TD><?php echo $registro_funcion['sala_id']?> </TD>
                <TD>
                <form action="index.php" method="post">
                    <input type="hidden" name="id" value=<?php echo $registro_funcion['id']?>>
                    <input type="submit" name="del_funcion" value="DEL">
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