<?session_start();
if(isset($_SESSION['connect'])){ 
	header("Location:page.php");
}else{
function foonc($var){
			
			 $res=htmlspecialchars(trim(strip_tags($var)));
			 return $res; 
		}
if(mb_strlen($_POST['login'])<4 || mb_strlen($_POST['login'])>25){
	echo "Логин от 4 до 25 сивловов";
}elseif (mb_strlen($_POST['password'])<6 || mb_strlen($_POST['password'])>25) {
	echo "Пароль от 6 до 25 символов";
}else{
	$login=foonc($_POST['login']);
	$password=md5(foonc($_POST['password']));
	

	require_once 'connect.php';
	$link=mysqli_connect($host, $user, $passwordDB, $database) or die(" Error".mysqli_error($link));
		$query="SELECT id FROM users WHERE (login='$login' or email='$login ') and password='$password'";
		$result=mysqli_query($link, $query) or die(" Error".mysqli_error($link));
		$result=mysqli_fetch_assoc($result);
		if($result>0){
			$_SESSION['connect']=$login;
			header("Location:page.php");
			
		}else{echo "Не верно введен логин или пароль";}
} 
?>

<link rel="stylesheet" type="text/css" href="css/style.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Авторизация</title>
	
<div class="content">
<br><br>
<form method="POST">
	<input type="text" name="login" placeholder="Логин или email" value="<? echo $_POST['login'] ?>" autofocus  required><br><br>
	<input type="password" name="password" placeholder="Пароль" required><br><br>
	<input type="submit" value="Выйти" name="go"><br>
	<a href="index.php">Регистрация</a>
</form><?

}