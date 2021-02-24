<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('location: ./index.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration system PHP and MySQL</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header2">
    <h2>Register</h2>
</div>

<form method="post" action="./action.php" class="form2">
    <div class="input-group">
        <label>Username</label>
        <input type="text" name="username" value="user">
    </div>
    <div class="input-group">
        <label>Password</label>
        <input type="password" name="pasword" value="pwd">
    </div>
    <div class="input-group">
        <button type="submit" class="btn-2" name="reg_user">Log In</button>
    </div>

        <?php if (isset($_SESSION['log_in_fail'])) : ?>
            <p class="error">
                "<?= $_SESSION['log_in_fail']?>"
             </p>

        <?php endif;?>

    <p>
        Not member? <a href="./Signup.php">Sign Up</a>
    </p>
</form>

</body>
</html>
