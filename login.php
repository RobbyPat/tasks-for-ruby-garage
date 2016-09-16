<link rel="stylesheet" type="text/css" href="./css/style.css">

<?php
$url=parse_url(getenv("mysql://bba73e1861313d:5ba94561@us-cdbr-iron-east-04.clear
db.net/heroku_a5ca1c082fe3990?reconnect=true"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"],1);

mysqli_connect($server, $username, $password);
mysqli_select_db($db);

$mail=$pass="";

if (isset($_POST['email']))
{
    $mail=sanitize_string($_POST['email']);
    $pass=sanitize_string($_POST['password']);
    if ($mail=='' || $pass=='') echo $error="</br></br> <label class='error'>You entered data is not in all fields</label>";
    else
    {
        $temppass=md5($pass);
        $query="SELECT * FROM users WHERE email='$mail' AND pass='".md5($pass)."'";
        if (mysql_num_rows(query_mysql($query)))
        {
            $_SESSION['email']=$mail;
            $_SESSION['pass']=md5($pass);
            die("</br><br/><label class='error'>Login success</label></br><a href='title.html' id='a'>Go to create TODO List</a>");
          
        }
        else echo $error="</br> <label class='error'>Invalid login or password...</label>";
    }    
}

echo <<< _FORMLOGIN

<form method="post" id="log" action='login.php'>
<br/></br>
<h3>Login to your personal page</h3></br>
<label>Enter your email and password</label></br></br>
<input type="email" name="email" id="email" placeholder="Email"></br></br>
<input type="password" name="password" id="password" placeholder="Password"></br></br>
<button type="submit" value="submit" id="submit">Submit</button>
</form>

_FORMLOGIN;

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

function sanitize_string($var)
{
        $var=strip_tags($var);
        $var=stripcslashes($var);
        $var=htmlentities($var, ENT_QUOTES, 'cp1251');
        return mysql_real_escape_string($var);
 }

?>