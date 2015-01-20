<div id="login">

<?php

/* er is net uitgelogd */
if(array_key_exists('logout', $_GET)){

	session_destroy();
	
}

/* er is net ingelogd */
if(array_key_exists('login', $_POST) && array_key_exists('username', $_POST) && 
   array_key_exists('password', $_POST) && 
   !empty($_POST['username']) && !empty($_POST['password'])) {
  dbconnect();
  $res = dbquery("SELECT * FROM users 
                  WHERE username=:username",
                  array('username'=>$_POST['username']));
  $user = $res->fetchObject();
  if($user && password_verify($_POST['password'], $user->passwd)) {
    $_SESSION['user'] = $user;
    $_SESSION['login'] = true;
  } else {
    echo "Wrong username or password.";
  }
}

/* er is ingelogd */
if(array_key_exists('user', $_SESSION) && $_SESSION['login']){

	echo '<br /><br />Welcome <b>' . $_SESSION['user']->username . '</b>!<br /><br />';
	echo '<a href="?logout=0">Log uit</a>';

}
/* er is niet ingelogd */
else { 

$_SESSION['login'] = false;
?>

<br />
<form method="post">
<input type="text" name="username" /> <br />
<input type="password" name="password" /> <br />
<a href="#">Forgot password?</a><br />
<a href="index.php?page=agreement">Register</a>
<input type="hidden" name="login" value="1" />
<div class="buttons">
	<button type="submit" value="submit">Submit</button>
</div>
</form>

<?php } ?>


</div>




