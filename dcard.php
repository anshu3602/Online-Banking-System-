<html>
     <head>
    <link rel="stylesheet" type="text/css" href="all.css">
        <link rel="stylesheet" type="text/css" href="indexs.css">
    </head>
    <body>
           <div class="menu">
            <div class="img">ONLINE BANKING</div>
           <nav>
             <ul class="list">
                <li><a href="index.html">HOME</a></li> 
                <li><a href="#">INSERT</a>                
                    <ul><li><a href="iaccount.php">account</a></li>
                        <li><a href="ibank.php">bank</a></li>
                        <li><a href="icard.php">card</a></li>
                        <li><a href="icustomer.php">customer</a></li>
                        <li><a href="ifund.php">fund</a></li>
                    </ul>
                </li>
                <li><a href="#">DELETE</a>                
                    <ul><li><a href="daccount.php">account</a></li>
                        <li><a href="dbank.php">bank</a></li>
                        <li><a href="dbranch.php">branch</a></li>
                        <li><a href="dcard.php">card</a></li>
                        <li><a href="dcontact.php">contact</a></li>
                        <li><a href="dcustomer.php">customer</a></li>
                        <li><a href="dfund.php">fund</a></li>
                    </ul>
                </li>
                <li><a href="#">RETRIVE</a>            
                    <ul><li><a href="raccount.php">account</a></li>
                        <li><a href="rbank.php">bank</a></li>
                        <li><a href="rbranch.php">branch</a></li>
                        <li><a href="rcard.php">card</a></li>
                        <li><a href="rcontact.php">contact</a></li>
                        <li><a href="rcustomer.php">customer</a></li>
                        <li><a href="rfund.php">fund</a></li>
                        <li><a href="rlogin.php">login</a></li>
                        <li><a href="rmaintains.php">maintains</a></li>
                        <li><a href="rprovide.php">provide</a></li>
                    </ul>
                </li>
                 <li><a href="#">Display</a>            
                    <ul><li><a href="account.php">account</a></li>
                        <li><a href="bank.php">bank</a></li>
                        <li><a href="branch.php">branch</a></li>
                        <li><a href="card.php">card</a></li>
                        <li><a href="contact.php">contact</a></li>
                        <li><a href="customer.php">customer</a></li>
                        <li><a href="fund.php">fund</a></li>
                        <li><a href="login.php">login</a></li>
                        <li><a href="maintains.php">maintains</a></li>
                        <li><a href="provide.php">provide</a></li>
                    </ul>
                </li>
            </ul> 
           </nav>
        </div>
    <div class="ac">
    <form action="dcard.php" method="post">
        <div><b>Enter the Details to Delete Card:</b></div><br>
   Card Number: <input type="number" name="cno" placeholder="Enter the Card No" required>
        IFSC: <input type="text" name="ifsc" placeholder="Enter the Branch ifsc" required><br><br>
        <input type="submit" value="Delete">
</form>
    </div>
    </body>
</html>
    
    <?php
 if ($_SERVER["REQUEST_METHOD"] == "POST") 
{ 
     $con = mysqli_connect('localhost','root','','project') or die("<p style='padding:20px; border-radius:5px; margin:20px; font-size:15px;margin-right:800px; border:1px solid rgba(255,0,0,10); background-color:rgba(255,50,50,0.3); color:red;'><b>Error:</b>Unable to selectdatabase: ". mysqli_error($con)."</p>");
     $_POST['cno'];
     $ifsc=$_POST['ifsc'];
     
	if($cno!="")  
	{ 
        $sql1 = "select * from card where cno='$cno' and ifsc='$ifsc'";
        
        $result = mysqli_query($con,$sql1);
        if(mysqli_num_rows($result)>0){
        echo "<table><tr><th>cno</th><th>ctype</th><th>expdate</th><th>cvv</th><th>ifsc</th></tr>";
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr><td>".$row["cno"]."</td><td>".$row["ctype"]."</td><td>".$row["expdate"]."</td><td>".$row["cvv"]."</td><td>".$row["ifsc"]."</td></tr>";
        }
        echo "</table>";
        
        
        $sql3 = "delete from card where cno = '$cno' and ifsc='$ifsc'";
        
        mysqli_query($con,$sql3);
        echo "<p style='padding:20px; border-radius:5px; margin:20px;margin-right:800px; font-size:15px; border:1px solid green; background-color:rgba(50,255,50,0.3); color:green;'><b>Successfully Deleted!!</b></p>";
        }else{
            echo "$cno,$ifsc is not Exist!";
        }
	} else 
	{ 
		echo "<p style='padding:20px; border-radius:5px; margin:20px; font-size:15px;margin-right:800px; border:1px solid rgba(255,0,0,10); background-color:rgba(255,50,50,0.3); color:red;'>One of the fields is empty!</p>"; 
	} 
     
 mysqli_close($con); 
} 
?>