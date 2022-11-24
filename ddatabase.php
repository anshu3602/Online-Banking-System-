<html>
    <head>
        <link rel="stylesheet" href="all.css">
        <link rel="stylesheet" href="indexs.css">
        <link rel="stylesheet" type="text/css" href="list.css">
    </head>
    
 <body>
    <div class="menu">
        <div class="img">ONLINE BANKING</div>
          <nav>
            <ul class="list"><li><a href="index.html">HOME</a></li></ul>
          </nav>
    </div>
    <div class="ac">
      <form action="ddatabase.php" method="post">
        <div><b>Drop Database</b></div><br>
        <div>Database: <div class="dropdown">
                  <select name="data" id="drop" class="drop-content">
                    <?php
                        $con = mysqli_connect('localhost','root','');
                        $result = mysqli_query($con,"show databases");
                        while($row = mysqli_fetch_array($result))
                        echo "<option value=",$row[0],">",$row[0],"</option>";
                    ?>
                  </select>
            </div>
        </div><br>
        <input type="submit" value="DROP">
      </form>
    </div>
 </body>
</html>

<?php 
    $con = mysqli_connect("localhost","root","") or die("<p style='padding:20px; border-radius:5px; margin:20px; font-size:15px;margin-right:800px; border:1px solid rgba(255,0,0,10); background-color:rgba(255,50,50,0.3); color:red;'><b>Error:</b>Unable to selectdatabase: ". mysqli_error($con)."</p>");
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $name=$_POST['data'];
        $sql1 = "drop database $name";
        
        if(mysqli_query($con,$sql1))
        {
            echo "<p style='padding:20px; border-radius:5px; margin:20px;margin-right:800px; font-size:15px; border:1px solid green; background-color:rgba(50,255,50,0.3); color:green;'><b>Database Dropped.</b></p>";
        }
        else
        {
            echo "<p style='padding:20px; border-radius:5px; margin:20px; font-size:15px;margin-right:800px; border:1px solid rgba(255,0,0,10); background-color:rgba(255,50,50,0.3); color:red;'><b>Error:</b>".mysqli_error($con);
            echo ".</p>";
        }
    }
  mysqli_close($con); 

?>