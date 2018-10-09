<?session_start();
if($_SESSION['connect']!==NULL){
	header("location: page.php");	
 }else{
if(empty($_POST['login'])){


	if(isset ($_POST['login'])){
	echo "Поле логин не может быть пустым"; } 
}elseif(empty($_POST['email'])) {
	echo "Поле email не может быть пустым";
}elseif (empty($_POST['realname'])) {
	echo "Введите свое настоящее имя";
}elseif (empty($_POST['password1'])) {
	echo "Введите пароль";
}elseif ($_POST['password1']==$_POST['password2']) {
	if(mb_strlen($_POST['password1'])<6 || mb_strlen($_POST['password1'])>25)echo "Пароль не может быть меньше 6 символов и больше 25";
	else{
	if(empty($_POST['date']))echo "Введите дату рождения";
	elseif (empty($_POST['country'])) {
		echo "Выберите свою страну";
		
	}elseif (empty($_POST['checkbox'])) {
		echo "Прочтите лицензионное соглашение и поставьте галочку";
	}else {

function foo($var){
			 $res=htmlspecialchars(trim(strip_tags($var)));
			return $res; 
		}

		if(mb_strlen($_POST['login'])<4 || mb_strlen($_POST['login'])>25){
			echo "Логин от 4 до 25 символов";
		}else {
			$login=foo($_POST['login']);
			if(mb_strlen($_POST['email'])<5 || mb_strlen($_POST['email'])>35){
			echo "Ел. адрес от 5 до 35 символов";
		}else {$email=foo($_POST['email']);
		if(mb_strlen($_POST['realname'])<6 || mb_strlen($_POST['realname'])>30){ 
			echo "Полное имя от 6 до 30 символов";
		}else{
			
			$realname=foo($_POST['realname']) ;
			$password=md5(foo($_POST['password1']));
			$country=foo($_POST['country']);
			$date=foo($_POST['date']);
			 require_once 'connect.php';

		$link=mysqli_connect($host, $user, $passwordDB, $database) or die(" Error".mysqli_error($link));
		$query="SELECT id FROM users WHERE login='$login' or email='$email'";
		$result=mysqli_query($link, $query) or die(" Error".mysqli_error($link));
		$result=mysqli_fetch_assoc($result);
		


		if($result>0)echo "Пользователь с такием именем уже зарегистрирован";else{
		session_start();
		$_SESSION['connect']=$login;
		

		$query="INSERT INTO users VALUES (null,'$login','$email','$realname','$password','$date','$country')";
		$result=mysqli_query($link, $query) or die(" Error".mysqli_error($link));
		
		header("location: page.php");	
		
		}
		}
		}
		}
		}
		}
} else echo "Пароли не совпадают";
		}

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Регистрация</title>
	
</head>
<body>
<div class="header">
	

Регистрация 

</div>


<div class="content">
Заполните форму<hr>
<form method="POST">
	<input type="text" name="login" value="<? echo htmlspecialchars(trim(strip_tags($_POST['login']))) ?>" placeholder="login"  autofocus required >         
	<input type="email" name="email" placeholder="email" value="<? echo $_POST['email'] ?>" required>
	<input type="text" name="realname" placeholder="realname" value="<? echo $_POST['realname'] ?>" required>
	<input type="password" name="password1" placeholder="password" required>
	<input type="password" name="password2" placeholder="password 2" required>
	<input type="date" name="date" value="<? echo $_POST['date']?>" required>
	<select name="country" required>
    <option disabled selected value="<?echo $_POST['country']?>"> <? echo $_POST['country']?> </option>
 
	 
	 <? 
	 require_once 'connect.php';
	 	$link=mysqli_connect($host, $user, $passwordDB, $database) or die(" Error".mysqli_error($link));
		$query="SELECT * FROM country";
		$result=mysqli_query($link, $query) or die(" Error".mysqli_error($link));
		$result=mysqli_fetch_assoc($result);
		$result=implode(" ",$result);
		$result=explode(" ",$result);
		
		$i=1;
		
		while ($i <= count($result)-1) {
		?><option value=" <?echo $result[$i];?>"> <? echo $result[$i] ?> </option><?
			$i++;
		}
		?> 
</select>

	<br> Cогласен с правилами <a href="licension.html"> лицензионного соглашения</a> <? 
	?>
	<input type="checkbox" name="checkbox"  <? if(isset($_POST['checkbox'])) echo "checked" ?>required ><br>
 
	<input type="submit" value="Регистрация" name="go"><a href="autorization.php">Авторизация</a>
</form>




</body>
</html>