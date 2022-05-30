<?php
include 'connect.php';
session_start();
// login Validation function 



$le = $lp = "none";
$lpErr = "";
$login = mysqli_fetch_all(mysqli_query($conn, 'select * from users'), MYSQLI_ASSOC);

if (isset($_POST['login'])) {

    $lemail = $_POST['email'];
    $lpassword = $_POST['password'];
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $lp = "block";
        $lpErr = "please insert email and Password";
    } else {
        foreach ($login as $admin) {
            if ($admin['admin'] == 1 && $lemail == $admin['email'] && $lpassword == $admin['pass']) {
                $ldate = date("d-m-Y H:i:s");
                $sql = "INSERT INTO logins (updated_at) VALUE ('$ldate') WHERE users.fname='admin'";
                mysqli_query($conn, $sql);
                $_SESSION['admin_name']=$admin['fname'];
                header('location: admin.php');
            } else {
                $lp = "block";
                $lpErr = "You Are Not Admin";
            }
        }
    }
}
?>
<div class="hr-theme-slash-2">
    <div class="hr-line"></div>
    <div class="hr-icon"><i class="fa-solid fa-couch"></i></div>
    <div class="hr-line"></div>
</div>
<br>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>login</title>
</head>

<body>


    <!-- Log In form -->

    <!-- <form  action="login.php" method="POST" id="logForm">

    
        <h2 style="text-align:center; font-family: 'FontAwesome'; color:#363062;
    font-weight: bolder;">Log In form</h2>
    

    <div class="form-row">
        <div class="col-md-4 offset-md-4">
        <label for="email">Your E-mail</label>   
        <input type="email" name="email" id="email" class="form-control is-inavalid" placeholder="test@test.com" value="">
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-4 offset-md-4">
        <label for="password">Password</label>   
        <input type="password" name="password" id="password" class="form-control is-inavalid" placeholder="********" value="">
        <div class="invalid-feedback" style="display:<?php echo $lp ?>">
        <?php echo $lpErr ?>
        </div>
        </div>
    </div>

    <button class="btn col-md-4 offset-md-4" type="submit" name="login" style="background-color:#363062 ; color:#E9D5DA">LOG IN</button>
    <br><br> -->

    <div class="loginBox"> <img class="user" src="https://i.ibb.co/yVGxFPR/2.png" height="100px" width="100px">
        <h3>Sign in here</h3>
        <form action="login.php" method="post">
            <div class="inputBox">
                <input id="uname" type="text" name="email" placeholder="E-mail">
                 <input id="pass" type="password" name="password" placeholder="Password">
            </div>
            <div class="invalid-feedback" style="display:<?php echo $lp ?>;color: #ff000c"><?php echo $lpErr ?></div>
            <input type="submit" name="login" value="Login">
        </form>
    </div>
</body>

</html>
<!-- End Log In form -->

<!-- switch to signup form -->
<!-- </form>
<form  action="login.php" method="POST" id="sForm">
<button class="btn col-md-4 offset-md-4" type="submit" name="switch" style="background-color:#E9D5DA ; color:#363062"><a href="./register.php">Sign Up !!!</a></button>
</form> -->
<!-- end of switch to signup form -->




<br><br>
<?php
// require 'include/footer.php'; 
?>