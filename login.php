<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="dist/css/mycss.css" rel="stylesheet">
    </head>
   
    <body>
        <form action="action_login.php" class="form-start" method="post">
            <div class="form-group2 theme_ft">
                <center> <h1><span class="glyphicon glyphicon-user"></span> Kimuchi.io </h1> </center>
            </div>
            <div class="form-group2 theme_ft">
                <label for="user_name">username</label>
                <input type="text" id="user_name" class="form-control mt5" name="username" placeholder=" usernamne.."/>
            </div> 
            <div class="form-group2 theme_ft">
                <label for="user_pass">password</label>
                <input type="password" id="user_pass" class="form-control mt5" name="password" placeholder=" password.."/>
            </div> 
             <div class="form-group2 theme_ft">
                <input type="submit" id="submit" class="btn btn-primary w100" name="btnSubmit" value="Login account"  />
            </div> 
        </form>
        <?php if ( isset($_SESSION['user_name']) ) { ?>
        <div class="row theme_ft">
            <div class="form-group2">
                <div class="col-sm-6 alRight theme_ft">
                     Welcome 
                </div>
                <div class="col-sm-6 theme_ft">
                    <span class="userWelcome"> <?= $_SESSION['user_name']; ?> </span>  
                </div>    
                <div class="col-sm-12 center">
                     <a href="logout.php"> <?= $_SESSION['user_display']; ?> ( <?= $_SESSION['role'] ?> )  Logout </a>
                </div>
            </div> 
        </div>
        <?php } ?>
    </body>
    <script src="dist/js/jquery-3.1.1.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
</html>