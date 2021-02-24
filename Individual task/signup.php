<?php
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
        <input type="text" name="username">
    </div>
    <div class="input-group">
        <label>Email</label>
        <input type="email" name="email">
    </div>
    <div class="input-group">
        <label>Password</label>
        <input type="password" name="pasword">
    </div>
    <div class="input-group">
        <input type="hidden" name="registration_form" value="reg">
        <button type="submit" class="btn-2" name="reg_user">Register</button>
    </div>
    <?php if (isset($_GET['er'])) : ?>
      <p class="error">
        "User Name Already Used Choose Another one"
    </p>

    <?php endif;?>
    <p>
        Already a member? <a href="./login.php">Sign in</a>
    </p>
</form>

</body>
</html>
