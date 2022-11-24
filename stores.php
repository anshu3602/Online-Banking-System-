<?php 
include('index.html')?>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="all.css">
    </head>
    <body>
        <div class="ac">
        Account Table:<br><br>
        </div>
    </body>
</html>


<?php 
    $con = mysqli_connect('localhost','root','','project') or die("Unable to selectdatabase: ". mysqli_error($con));
    echo "Creating Stored Procedure.. ";
      
             $sql1 = "create procedure display1() select cusid from customer where cusid = '03'";

            mysqli_query($con,$sql1);

    echo " Calling Stored Procedure<BR/>";
    if ($result = mysqli_query($con,"call display1()"))
   {             
                while($row = mysqli_fetch_assoc($result))
                {
                      echo "<table><tr><th>Count(cusid)</th><th>amount</th></tr>";
                    
                        echo "<tr><td>".$row["cusid"]."</td></tr>";
                    
                    echo "</table>";
                }
    }else{
                    echo "Table is Empty!";
                }  
     mysqli_close($con); 
?>