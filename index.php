<?php

$username="";
$password="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$ans=$_POST;

	if (empty($ans["username"]))  {
            header("Location:index.php?error=Unesite korisničko ime");
            exit();
		
    		}
	else if (empty($ans["password"]))  {
            header("Location:index.php?error=Unesite lozinku");
            exit();
		
    		}
	else {
		$username= $ans["username"];
		$password= $ans["password"];
	
		provjera($username,$password);
	}
}


function provjera($username, $password) {
	

	$xml=simplexml_load_file("users.xml");
	
	
	foreach ($xml->user as $usr) {
  	 	$usrn = $usr->username;
		$usrp = $usr->password;
		$usrime=$usr->ime;
		$usrprezime=$usr->prezime;
		if($usrn==$username){
			if($usrp == $password){
                header("Location:index.php?login=Prijavljeni ste kao $usrime $usrprezime");
				return;
				}
			else{
                header("Location:index.php?error=Netocna lozinka");
				return;
				}
			}
		}
        
    header("Location:index.php?error=Korisnik ne postoji");
	return;
}
?>


<html>
<head>
    <title>PRIJAVA</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form action="" method="post">
        <h2>PRIJAVA</h2>
        <?php if(isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        
        <?php } ?>
        <?php if(isset($_GET['login'])) { ?>
            <p class="login"><?php echo $_GET['login']; ?></p>
        
        <?php } ?>
        <label>Korisničko ime</label>
        <input id="name" type="text" name="username" placeholder="User Name"><br>

        <label>Lozinka</label>
        <input id="password" type="password" name="password" placeholder="Password"><br>

        <button type="sumbit" name="submit">Login</button>

    </form>
</body>
</html>