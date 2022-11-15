<?php
require_once ('config.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</head>
<body>
    <div>
        <?php
        if(isset($_POST['submit'])){
            $name      = $_POST['name'];
            $email     = $_POST['email'];
            $password  = $_POST['password'];


            $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
            $stmtinsert = $db->prepare($sql);
            $result = $stmtinsert->execute([$name, $email, $password]);
            
        }
        ?>

    </div>
    
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3>User Registration</h3>
                    </div>
                    <div class="card-body">
                        <form action="registration.php" method="POST">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter your name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter your email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter your password">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary" id="register">Submit</button>

                        </form>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    

 
    
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#register').click(function(e){
                
                var valid = this.form.checkValidity();
                if(valid){
                    
                    var name     = $('#name').val();
                    var email    = $('#email').val();
                    var password = $('#password').val();

                    e.preventDefault();

                    $.ajax({
                        type: 'POST',
                        url: 'process.php',
                        data: {name: name, email: email, password: password},
                        success: function(data){
                            Swal.fire({
                                'title': 'Successful',
                                'text': data,
                                'type': 'success'
                            })
                        },
                        error: function(data){
                            Swal.fire({
                                'title': 'Errors',
                                'text': 'There were errors while saving the data.',
                                'type': 'error'
                            })
                        }
                    });
                    	
                        
                }
                
                
            });
            
        });
    </script>
</body>
</html>