<html>
<head>
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="indexs.css">
    </head>
    
<body>
    <div class="menu">
        <div class="img">ONLINE BANKING</div>
          <nav><ul class="list"><li><a href="index.html">HOME</a></li></ul>
          </nav>
    </div>
    <div class="ac">
      <form action="cdatabase.php" method="post">
        <div><b>Creation of Database</b></div><br>
        Name: <input type="text" name="dbname" placeholder="Enter the Database name" required><br><br>
        <input type="submit" value="create">
      </form>
    </div>
    </body>
</html>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $con = mysqli_connect("localhost","root","");
        $name=$_POST['dbname'];
        $sql1 = "create database $name";
        
        if(mysqli_query($con,$sql1))
        {
            echo "<p style='padding:20px; border-radius:5px; margin:20px;margin-right:800px; font-size:15px; border:1px solid green; background-color:rgba(50,255,50,0.3); color:green;'><b>Database Created.</b></p>";
        }
        else
        {
             echo "<p style='padding:20px; border-radius:5px; margin:20px;margin-right:800px; font-size:15px; border:1px solid rgba(255,0,0,10); background-color:rgba(255,50,50,0.3); color:red;'><b>Error:</b>".mysqli_error($con);
            echo "</p>";
        }

  mysqli_close($con); 
}
?>