<form action="" method="post">
	User Name: <input type="text" name="username"><br>
	Password: <input type="password" name="password"><br>
	<input type="submit" name="login">
</form>

<?PHP	
if(isset($_POST['login'])){
	
	$link = new mysqli('localhost','root','','cinedb');
	
	if ($link->connect_errno) {
			echo "Falló la conexión a MySQL: (" . $link->connect_errno . ") " . $link->connect_error;
		}else{
			$username = $_POST['username'];
			$password = $_POST['password'];
			$sql ="SELECT password FROM administradores WHERE username = '$username' and password = '$password'";

			$result = $link->query($sql);
			if($result->fetch_assoc()){
				session_start();
				$_SESSION['Reg']='ok';
				header('Location: index.php');
			}else{
				$_SESSION['Reg']='fail';
				echo "Usuario o Contraseña Incorrecto";
			}
		}
	mysqli_close($link);
}
?>