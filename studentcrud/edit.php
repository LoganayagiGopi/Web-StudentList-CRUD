<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "studentcrud";

//Create connection
$connection = new mysqli($servername, $username, $password, $database);


$id = "";
$name = "";
$gender = "";
$course = "";
$phoneno = "";
$address = "";

$errorMessage = "";
$sucessMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET' )
{
    //GET method: show the data of the student
    if ( !isset($_GET["id"]) )
    {
        header("location: /studentcrud/index.php");
       exit;
    }
    $id = $_GET["id"];

    //read all row from database table
    $sql = "SELECT * FROM students WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row)
    {
        header("location: /studentcrud/index.php");
        exit;
    }
    $id = $row["Id"];
    $name = $row["Name"];
    $gender = $row["Gender"];
    $course = $row["Course"];
    $phoneno = $row["PhoneNo"];
    $address = $row["Address"];
}
else
{
    //POST method: update the data of the student

    $id = $_POST["id"];
    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $course = $_POST["course"];
    $phoneno = $_POST["phoneno"];
    $address = $_POST["address"];

    do
    {
      
        if ( empty($id) || empty($name) || empty($gender) || empty($course) || empty($phoneno) || empty($address) )
        {
         $errorMessage = "All the field are required";
         break;
        }

        $sql = "UPDATE students " . "SET name = '$name', gender = '$gender', course = '$course', phoneno = '$phoneno', address = '$address' " . "WHERE id = $id";
        
        $result = $connection->query($sql);

        if (!$result)
       {
        $errorMessage = "Invalid query: " . $connection->error;
        break;
       }

       $sucessMessage = "Client update correctly";

       header("location: /studentcrud/index.php");
       exit;
    
    }while (true);
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
     <div class="container my-5">
         <h2>New Student</h2>

         <?php
         if ( !empty($errorMessage) )
         {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
         }
         
         ?>

         <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
         <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Id</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="id" value="<?php echo $id; ?>">
            </div>
         </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
            </div>
         </div>
         <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Gender</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="gender" value="<?php echo $gender; ?>">
            </div>
         </div>
         <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Course</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="course" value="<?php echo $course; ?>">
            </div>
         </div>
         <div class="row mb-3">
            <label class="col-sm-3 col-form-label">PhoneNo</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="phoneno" value="<?php echo $phoneno; ?>">
            </div>
         </div>
         <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Address</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
            </div>
         </div>
          
         <?php 
          
          if ( !empty($sucessMessage) )
          {
              echo "
              <div class='row mb-3'>
              <div class='offset-sm-3 col-sm-6'>
              <div class='alert alert-sucess alert-dismissible fade show' role='alert'>
              <strong>$sucessMessage</strong>
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>
              ";
          }
        ?>


         <div class="row mb-3">
         <div class="offset-sm-3 col-sm-3 d-grid">
            <button type="submit" class="btn btn-primary">Submit</button>
         </div>
         <div class="col-sm-3 d-grid">
            <a class="btn btn-outline-primary" href="/studentcrud/index.php" role="button">Cancel</a>
        </div>
        </div>
        
        </form>
     </div>

</body>
</html>