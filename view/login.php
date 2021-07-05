<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="view/css/main.css">
    <title>Sibers</title>
</head>
<body class="toLog">
    <form action="index.php?controller=user&action=signin" method="post">
        <label for="login">Login</label>
        <input type="text" id="login" placeholder="Enter your login" name="login">
        <label for="password">Password</label>
        <input type="password" id="password" placeholder="Enter your password" name="password">
        <button type="submit" class="logIn">Log In</button>
        <?php
        if ($_SESSION['message']) {
            echo '<p style="width: 100%;font-weight: bold;background: red;height: 30px;padding:5px 0 5px 30px;margin-top: 5px">'.$_SESSION['message'].'</p>';
        }
        unset($_SESSION['message']);
        ?>
    </form>
</body>
</html>