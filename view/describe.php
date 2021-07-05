<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="view/css/main.css">
    <title>Add or Modify</title>
</head>
<body>
<div class="main">
    <div class="headerM">
        <a href="index.php" class="logout">Main</a>
        <h2 style="text-align: center">Admin Panel</h2>
        <a href="index.php?controller=user&action=logout" class="logout">logout</a>
    </div>
    <div class="content">
        <table style="width:100%">
            <tr>
                <td>Id:</td>
                <td><?=$user['Id']?></td>
            </tr>
            <tr>
                <td>Name:</td>
                <td><?=$user['name']?></td>
            </tr>
            <tr>
                <td>Surname:</td>
                <td><?=$user['surname']?></td>
            </tr>
            <tr>
                <td>Gender:</td>
                <td><?=$user['sex']?></td>
            </tr>
            <tr>
                <td>Login:</td>
                <td><?=$user['login']?></td>
            </tr>
            <tr>
                <td>Date:</td>
                <td><?=$user['date']?></td>
            </tr>

            <tr>
                <td>Role:</td>
                <td><?=$user['role']?></td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>