<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/styles.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;700&display=swap" rel="stylesheet">


    <script src="https://use.fontawesome.com/b19e15daf2.js"></script>
    
    <title>Register</title>
</head>
<body>
    <div class="container">
        <h1 class="title">Site Login</h1>

        <hr class="border">

        <form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] )?>" method="POST" class="form" name="login">
            <div class="form-group">
                <i class="icon left fa fa-user"></i><input type="text" name="user" class="user" placeholder="User">
            </div>
            <div class="form-group">
                <i class="icon left fa fa-lock"></i><input type="password" name="password" class="password_btn" placeholder="Password">
                <i class="submit-btn fa fa-arrow-right" onclick="login.submit()"></i>
            </div>

            <?php if( !empty($errors) ): ?>
                <div class="error">
                    <ul>
                        <?php echo $errors?>
                    </ul>
                </div>
            <?php endif?>
        </form>

        <p class="text-register">
            You don't have an account?
            <a href="register.php">Sign In</a> 
        </p>
    </div>


</body>
</html>