<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    
</head>
<body>
    <div class="container my-5">
        <h2 style = "text-align:center;"> Students List</h2><br>
        <a class="btn btn-success" href="/studentcrud/create.php" role="button">New Student</a>
        <br><br>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Course</th>
                    <th>PhoneNo</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "studentcrud";

                // create connection
                $connection = new mysqli($servername, $username, $password, $database);

                // check connection
                if ($connection->connect_error)
                {
                    die("Connection failed: " . $connection->connect_error);
                }

                //read all row from database table
                $sql = "SELECT * FROM students";
                $result = $connection->query($sql);

                if (!$result)
                {
                    die("Invalid query: " . $connection->error); 
                }
                // read data of each row
                while($row = $result->fetch_assoc())
                {
                 echo " 
                 <tr>
                    <td>$row[Id]</td>
                    <td>$row[Name]</td>
                    <td>$row[Gender]</td>
                    <td>$row[Course]</td>
                    <td>$row[PhoneNo]</td>
                    <td>$row[Address]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='/studentcrud/edit.php?id=$row[Id]'>Update</a>
                        <a class='btn btn-danger btn-sm' href='/studentcrud/delete.php?id=$row[Id]'>Delete</a>

                    </td>
                </tr>
                 ";
                }
                ?>
                
        </tbody>

       </table>

    </div>
       
</body>
</html>