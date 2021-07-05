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

        <form action="index.php?controller=user&action=edit&id=<?=$user['Id']?>" method="post" enctype="multipart/form-data">
            <label for="name">Name</label>
            <input name="name" type="text" id="name" placeholder="Enter your name" value="<?=$user['name']?>">
            <label for="lastName">Last Name</label>
            <input name="surname" type="text" id="lastName" placeholder="Enter your last name" value="<?=$user['surname']?>">
            <div class="radioButton">
                <label for="men">Men</label>
                <input type="radio" id="men" name="sex" value="men" <?=$user['sex']==='men'? 'checked':''?>>
                <label for="women">Women</label>
                <input type="radio" id="women" name="sex" value="women" <?=$user['sex']==='women'? 'checked':''?>>
            </div>
            <label for="birthday">Birthday</label>
            <input type="date" id="birthday" placeholder="Enter your birthday" name="date" value="<?=$user['date']?>">
            <select name="role"  style="padding: 5px 0;margin: 10px 0;">
                <option value="user" <?=$user['role']==='admin'? '':'selected'?>>User</option>
                <option value="admin" <?=$user['role']==='admin'? 'selected':''?>>Admin</option>
            </select>
            <label for="login">Login</label>
            <input name="login" type="text" id="login" placeholder="doolat_" value="<?=$user['login']?>">
            <label for="password">Password</label>
            <input name="password" type="password" id="password" placeholder="********">
            <label for="password1">Password</label>
            <input name="password_confirm" type="password" id="password1" placeholder="Confirm your password" style="display: none">
            <button type="submit">Change</button>
            <?php
            if ($_SESSION['message']) {
                echo '<p style="width: 100%;font-weight: bold;background: red;height: 30px;padding:5px 0 5px 30px">'.$_SESSION['message'].'</p>';
            }
            unset($_SESSION['message']);
            ?>
        </form>
    </div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function (){
        $('#password').on('input',function(){
            console.log('tes')
            $('#password1').css('display', 'block').attr('requried')
        })
        //
        // if ($('#password').val() == ""){
        //     $('#password1').val('').css('display', 'none').removeAttribute('required')
        //
        // }
    });
</script>
</html>