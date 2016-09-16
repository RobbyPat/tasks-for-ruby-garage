<link rel="stylesheet" type="text/css" href="./css/style.css">

<?php

$url=parse_url(getenv("https://github.com/RobbyPat/tasks-for-ruby-garage/blob/master/tasks.sql"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"],1);

mysqli_connect($server, $username, $password);
mysqli_select_db($db);

$error=$pass=$mail=$pass2="";

if (isset($_SESSION['email'])) destroy_session();

if (isset($_POST['email']))
{
    $mail=$_POST['email'];
    $pass=$_POST['password'];
    $pass2=$_POST['password2'];
    if ($mail=='' || $pass=='' || $pass2=='') echo $error="<br/><br/><label class='error'>Error. Please enter in all the filds...</label><br /><br />";
    else
    {
        $query="SELECT * FROM users WHERE email='$mail'";
        if (mysql_num_rows(query_mysql($query)))
        {
            echo $error="<br/><br/><label class='error'>This user is already exists. Please choose another email.</label><br /><br />";
        }
        else
        {
            if ($pass!=$pass2)
            {
                echo $error="<br/><br/><label class='error'>Passwords do not match...</label><br /><br />";
            }
            else
            {
                $temppass=md5($pass);
                $query="INSERT INTO users VALUES('$mail', '$temppass')";
                query_mysql($query);
                die ("<br/><h4>Your account has been created</h4><br/><label class='error'>Please sign in using your login and password...</label><br/><a href='login.php' id='a'>Login</a>");
            }
        }
    }
}

echo <<< _REGFORM

<form method="post" action="reg.php" id="reg">
<br/>
<h3>Registration form</h3><br/>
<label>Enter your email and password</label><br/><br/>
<input type="email" name="email" id="email" placeholder="Email"><br/><br/>
<input type="password" name="password" id="password" placeholder="Password"><br/><br/>
<input type="password" name="password2" id="password2" placeholder="Repeat the password"><br/><br/>
<button type="submit" value="submit" id="submit">Submit</button>
</form>

_REGFORM;

function query_mysql($query)
{
    $result=mysql_query($query) or die("Unable to query the database: ".mysql_error());
    return $result;
}

function destroy_session()
{
    $_SESSION=array();
    if (session_id()!="" || isset($_COOKIE[session_name()]))
    setcookie(session_name(), '', time()-2592000,'/');
    session_destroy();
}


?>