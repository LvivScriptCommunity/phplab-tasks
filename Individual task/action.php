<?php

session_start();
$config = require_once './config.php';
try {
    $pdo = new PDO(sprintf('mysql:host=%s;dbname=%s', $config['host'], $config['dbname']), $config['user'], $config['pass']);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
if (isset($_POST['logout'])) {
    session_destroy();
}
if (isset($_POST['registration_form'])) {
    $sql = <<<'SQL'
    INSERT INTO users 
        (username,email,pasword) 
        VALUES (:username,:email,:pasword)
    SQL;
    $sth = $pdo->prepare($sql);
    if (
        $sth->execute(['username' => $_POST['username'], 'email' => $_POST['email'],
        'pasword' => $_POST['pasword']])
    ) {
        $_SESSION['user_id'] = $pdo->lastInsertId();
        $_SESSION['user_name'] = $_POST['username'];
        header('location: ./action.php');
        exit();
    } else {
        header("location: ./signup.php?er=1");
        exit();
    }
} else {
    $sql = <<<'SQL'
    select id,username from users 
        where (username=:username and pasword=:pasword)
    SQL;
    $sth = $pdo->prepare($sql);
    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    $sth->execute(['username' => $_POST['username'], 'pasword' => $_POST['pasword']]);
    if ($sth->rowCount() != 0) {
        $current_user = $sth->fetch();
        $_SESSION['user_id'] = $current_user['id'];
        $_SESSION['user_name'] = $current_user['username'];
        header('location: ./action.php');
        exit();
    } else {
        $_SESSION['log_in_fail'] = "Not Correct User Name OR Password Try again";
        header('location: ./login.php');
        exit();
    }
}
