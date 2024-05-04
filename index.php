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
    <h1>Lista de Administradores</h1>

<?php
    $con = new mysqli("localhost", "root", "", "cinedb");

    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);
    }
    
    $sql = 'SELECT * FROM administradores';
    $result = $con->query($sql);      
    $arr = array();
    while ($fil = $result->fetch_assoc()) {
        $arr[] = $fil;
    }

    foreach ($arr as $registro) {
?>
    <form action="" method="post">
        <input type="text" name="nombre" value=<?php echo $registro['nombre']?>>
        <input type="text" name="password" value=<?php echo $registro['username']?> disabled>
        <input type="text" name="mail" value=<?php echo $registro['password']?> disabled>
        <input type="text" name="edad" value=<?php echo $registro['correo']?>>
        <input type="submit" name="del" value="DEL">
        <input type="submit" name="edi" value="EDI">       
    </form>
<?PHP
}
}else{
    header("Location: login.php");
}

}else{
header("Location: login.php");
}		

?>
</body>
</html>