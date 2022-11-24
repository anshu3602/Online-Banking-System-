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
    <form action="iaccount.php" method="post">
     <div class="ad"><h4>Account Details</h4><br>
        Customer ID: <input type="text" name="cusid" required><br><br>
        Account Number: <input type="number" name="accno" required><br><br>
         Type: <select name="atype" required>
                <option value="savings">Savings</option>
                <option value="fixed">Fixed</option>
                <option value="current">Current</option>
                </select>
         <br><br>
        Balance: <input type="number" name="bal" required><br><br>
        IFSC: <input type="text" name="ifsc" required><br><br>
        <div><input type="submit" value="SUBMIT"></div>
     </div><br>
    </form>
    </div>
    </body>
</html>
    
    
<?php 
$con = mysqli_connect('localhost','root','','project') or die("<p style='padding:20px; border-radius:5px; margin:20px; font-size:15px;margin-right:800px; border:1px solid rgba(255,0,0,10); background-color:rgba(255,50,50,0.3); color:red;'><b>Error:</b>Unable to select database: ". mysqli_error($con)."</p>");
 if ($_SERVER["REQUEST_METHOD"] == "POST") 
{ 
     $id=$_POST['cusid']; 
	$accno=$_POST['accno'];
     $bal=$_POST['bal'];
     $atype=$_POST['atype'];
     $ifsc=$_POST['ifsc'];
     
	if($id!="" && $accno!="") 
	{ 
        
        $sql3 = "insert into account values('$accno','$atype','$bal','$ifsc')";    
        $sql4 = "insert into maintains values('$accno','$id')";
        
        mysqli_query($con,$sql3);
        mysqli_query($con,$sql4); 
       echo "<p style='padding:20px; border-radius:5px; margin:20px;margin-right:800px; font-size:15px; border:1px solid green; background-color:rgba(50,255,50,0.3); color:green;'><b>Successfully Inserted</b>..</p>";
	} else 
	{ 
		echo "<p style='padding:20px; border-radius:5px; margin:20px; font-size:15px;margin-right:800px; border:1px solid rgba(255,0,0,10); background-color:rgba(255,50,50,0.3); color:red;'>One of the fields is empty!</p>"; 
	} 
}
 mysqli_close($con); 
?>