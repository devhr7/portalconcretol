<?php 
$usuario=$_POST['usuario'];
$contrasena=$_POST['contraseña'];
$nivel;
session_start();
$_SESSION['usuario']=$usuario;
$_SESSION['nivel']=0;
$conexion = mysqli_connect("localhost", "root", "", "paginaweb");
$query="SELECT * FROM usuario where CORREO='$usuario' and CONTRASENA='$contrasena' and IDTIPOUSER=1 and statusUser=1";
$resultado=mysqli_query($conexion,$query);
$query1="SELECT * FROM usuario where CORREO='$usuario' and CONTRASENA='$contrasena' and IDTIPOUSER=2 and statusUser=1";
$resultado1=mysqli_query($conexion,$query1);

$filas=mysqli_num_rows($resultado);
$filas1=mysqli_num_rows($resultado1);
if($filas){
	
	$_SESSION['nivel']=1;
	header("location:../vista/Home.php");
}
else if ($filas1){
	$nivel=2;
	$_SESSION['nivel']=2;
	header("location:../vista/homeAdmin.php");

}


else{
	?>
	<?php 
	include ("../vista/iniciarsesion.php");
	 ?>
	 <center>
	 <h1 class="bad">Error Al Iniciar Sesion</h1></center>
	 <?php
}


mysqli_free_result($resultado);
mysqli_close($conexion);
?>



