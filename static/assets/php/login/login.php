<?php
    // A generic simple login system in PHP. WAMPServer is used for the MySQL backend.
	// Modified from: https://www.tutorialspoint.com/php/php_mysql_login.htm 
   session_start();
   include("connection.php");
   // Initialize the error variable
   $error = "";

   // Check if the user is logged in, if not then redirect him to login page
   //if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
   //    header("location: login.php");
   //    exit;
   //}
   
   
   // If the form has been posted
   if($_SERVER["REQUEST_METHOD"] == "POST") {
           
      // Get rid of speacial characters in the input values
      $myusername = mysqli_real_escape_string($conn,$_POST['username']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
      
      $sql = "SELECT username FROM userpass WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC); //The mysqli_fetch_array() function fetches a result row as an associative array (A["index"] = Value)

      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         $_SESSION['login_user'] = $myusername;  // Save the username
         $_SESSION['loggedin'] = true;  // Someone is logged in!
         
         header("location: ../../index.php");
      } else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html>
   
   <head>
      <title>Login Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>UserName: </label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password: </label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px;"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>