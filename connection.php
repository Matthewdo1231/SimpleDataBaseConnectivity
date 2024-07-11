<?php 
  define('DB_HOST','localhost');
  define('DB_USER','mattyhewdo');
  define('DB_PASS','Mats0963179');
  define('DB_NAME', 'php_practice');
  //Define connection
  $conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
  //Check connection status
  if(!$conn){
    die('CONNECTION ERROR'. mysqli_connect_error());
  }
  //fetch userdata
  $sql = 'SELECT * FROM feedback';
  $result = mysqli_query($conn , $sql);
  $dbfeedback = mysqli_fetch_all($result,MYSQLI_ASSOC);
  
?>

  <?php foreach($dbfeedback as $item):?>
     <ul>
      <li><?php echo $item['name']?></li>
      <li><?php echo $item['email']?></li>
      <li><?php echo $item['body']?></li>
      <li><?php echo $item['date']?></li>
     </ul>
   <?php endforeach?>


<?php 
  if(isset($_POST['submit'])){
    $name = filter_input(INPUT_POST, 'name' , FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email' , FILTER_SANITIZE_SPECIAL_CHARS);
    $body = filter_input(INPUT_POST, 'body' , FILTER_SANITIZE_SPECIAL_CHARS);

    if(!empty($name) && !empty($email) && !empty($body)){
       $sql = "INSERT INTO feedback (name,email,body) VALUES ('$name','$email','$body')";

       if(mysqli_query($conn,$sql)){
         header('Location:./connection.php');
       }
       else{
         echo "ERROR: " . mysqli_error($conn);
       }
    }
    else{
      echo '<p>Please complete the form</p>';
    }

  }

?>

<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
  <div>
   <label>Name:</label>
   <input type="text" name="name">
  </div>  
  <div>
   <label>Email Address:</label>
   <input type="text" name="email">
  </div>  
  <div>
   <label>Message:</label>
   <input type="text" name="body">
  </div>  
   <input type="submit" value="submit" name="submit">
</form>   