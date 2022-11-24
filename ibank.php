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
    <form action="ibank.php" method="post">
     <div class="ad"><h4>Bank Details</h4><br>
        Bank Name: <input type="text" name="bname" required><br><br>
        Bank Location: <input type="text" name="bloc" required><br><br>
        Branch Location: <input type="text" name="brloc" required><br><br>
        Branch IFSC: <input type="text" name="ifsc" required><br><br>
        <div><input type="submit" value="SUBMIT"></div>
     </div><br>
    </form> 
    </div>
    </body>
</html>
    
    
<?php $con = mysqli_connect('localhost','root','','project') or die("<p style='padding:20px; border-radius:5px; margin:20px; font-size:15px;margin-right:800px; border:1px solid rgba(255,0,0,10); background-color:rgba(255,50,50,0.3); color:red;'><b>Error:</b>Unable to selectdatabase: ". mysqli_error($con)."</p>");
 if ($_SERVER["REQUEST_METHOD"] == "POST") 
{ 
     $bname=$_POST['bname']; 
	$bloc=$_POST['bloc'];
     $brloc=$_POST['brloc'];
     $ifsc=$_POST['ifsc'];
     
	if($bname!="" && $bloc!="" && $brloc!="" && $ifsc!="") 
	{ 
        
        $sql3 = "insert into bank values('$bname','$bloc')";    
        $sql4 = "insert into branch values('$bname','$brloc','$ifsc')";
        
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