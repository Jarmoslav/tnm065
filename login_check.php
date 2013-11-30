<?php
    session_start();
	if (isset( $_SESSION[ 'logged_in' ])==true){
	  echo "You are logged in<br/>";
	}else {
	  echo "You are not logged in, please login or sign up<br/>";
	 //login form
	  echo "<h1>Login Here</h1>
			<form name='login' action='login.php' method='POST'>
			  <label for 'username'>Username: </label>
			  <input type='text' name='username'/>
			  <label for 'password'>Password: </label>
			  <input type='password' name='password'/>
			  <br/>
			  <button type='submit'>Submit</button>
			 </form>";
	}
	//sign up form
	echo "</br>";
	echo "<h1>Registration</h1>
			<form name='registration' action='signup.php' method='POST'>
			  <label for 'username'>Username: </label>
			  <input type='text' name='username'/>
			  <label for 'password'>Password: </label>
			  <input type='password' name='password'/>
			  <br/>
			  <button type='submit'>Submit</button>
			 </form>";
?> 