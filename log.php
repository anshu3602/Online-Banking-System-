<html>
    <head>
        <link rel="stylesheet" type="text/css" href="log.css">
    </head>
<body>
    
    <form action="log.php" method="post">
    <div class="login">
        <p>Customer ID:</p>
        <div><input type="text" name="user"></div><br>
        <p>Password:</p>
        <div><input type="password" name="pass"></div><br>
        <div><input class="next" type="submit" value="Login"></div>
        </div>
        </form>
    </body>
</html>


<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{ 
$con = mysqli_connect('localhost','root','','project') or die("Failed to connect to MySQL: " . mysqli_error($con));


if(!empty($_POST['user'])) 
{ 
    $a = "select * from login where cusid = '$_POST[user]' and passwrd = '$_POST[pass]'";
    $result = mysqli_query($con,$a);
    $row = mysqli_fetch_array($result);
 if(!empty($row['cusid']) && !empty($row['passwrd'])) 
 { 
     $_SESSION['cusid'] = $row['cusid']; 
    header("Location: http://localhost/myproject/index.html");
 } 
    else 
 { 
    echo "<h2>Incorrect Id or Password!</h2>";
        include_once('login.html');
 }
   
}
    mysqli_close($con);
}
      
    ?>