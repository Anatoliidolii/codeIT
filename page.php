<?session_start();?>
<link rel="stylesheet" type="text/css" href="css/style.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Домашняя страничка</title>
<div class="content"><br>
<?
if(isset($_SESSION['connect'])){
	
	$login=$_SESSION['connect'];
require_once 'connect.php';
		
		$link = mysqli_connect($host, $user, $passwordDB, $database) or die("Ошибка " . mysqli_error($link));

		$query="SELECT login, email FROM users WHERE login='$login' or email='$login'";
		$result=mysqli_query($link, $query) or die(" Error".mysqli_error($link));
		$result=mysqli_fetch_assoc($result);
		$result=implode(" ",$result);
		$result=explode(" ",$result);
		echo '<br>'."Добрый день ".$result[0].".".'<br>'."Ваш email: ".$result[1];


 ?>
<form method="get"><br><br><br>
	<input type="submit" value="Выйти" name="logon">
</form>
<? }else{


?><a href="index.php">Registration</a> or <a href="autorization.php">autorization</a>
	
 <? }

if(isset($_GET['logon'])){
	$_SESSION['connect']=0;
	session_destroy();
	

}

 ?>


</div>



