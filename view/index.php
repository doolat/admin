<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="view/css/main.css">
    <title>List</title>
</head>
    <body>
        <div class="main">
            <div class="header">
                <a href="index.php?controller=user&action=logout" class="logout">logout</a>
                <h2 style="text-align: center">Admin Panel</h2>
            </div>
            <div style="width: 85%;margin:0 auto;display: flex;flex-direction: column;justify-content: space-between;height: 75%">
                <div>
                    <form action="index.php" method="get" class="flex">
                        <input type="text" name="search" placeholder="Search...">
                        <select name="sort">
                            <option value="" selected>Sort By</option>
                            <option value="login">Login</option>
                            <option value="name">Name</option>
                        </select>
                        <button type="submit" class="logIn">Sort</button>
                        <a href="index.php?controller=user&action=create" class="logIn">Add User</a>
                    </form>
                </div>
                <?php
                if ($_SESSION['message']) {
                    echo '<p style="width: 100%;font-weight: bold;background: green;height: 30px;padding:5px 0 5px 30px">'.$_SESSION['message'].'</p>';
                }
                unset($_SESSION['message']);
                ?>
                <table style="width:100%">
                    <tr>
                        <th>N%</th>
                        <th>Login</th>
                        <th>Name</th>
                        <th>Look At</th>
                        <th>Change</th>
                        <th>Remove</th>
                    </tr>
                    <?php
                    $count = ($page_no - 1) * $no_of_records_per_page;
                        foreach ($users as $user) {
                            $count++;
                    ?>
                            <tr>
                                <td><?=$count?></td>
                                <td><?=$user['login']?></td>
                                <td><?=$user['name']?></td>
                                <td><a href="index.php?controller=user&action=describe&id=<?=$user['Id']?>" class="button">Look At</a></td>
                                <td><a href="index.php?controller=user&action=show&id=<?=$user['Id']?>" class="button">Edit</a></td>
                                <td><a href="index.php?controller=user&action=delete&id=<?=$user['Id']?>" class="button">Delete</a></td>
                            </tr>
                    <?php
                        }
                    ?>
                </table>
<!--                --><?php //echo '<br>'.'?page_no='.$total_pages; ?>
                <ul style="margin: 20px">
                    <li style="text-decoration: none;display: inline;background-color: rgb(59,55,55);padding: 10px;margin-right: 20px;"><a href="?page_no=1<?php  echo '&sort='.$sort.'&search='.$search;; ?>">1</a></li>
                    <li style="text-decoration: none;display: inline;background-color: rgb(59,55,55); padding: 10px;margin-right: 20px; <?php if($page_no <= 1){ echo 'display:none'; } ?>">
                        <a href="<?php if($page_no <= 1){ echo '#'; } else { echo "?page_no=".($page_no - 1).'&sort='.$sort.'&search='.$search; } ?>">Prev</a>
                    </li>
                    <li style="padding: 10px;text-decoration: none;display: inline;background-color: rgb(59,55,55);margin-right: 20px;<?php if($page_no >= $total_pages){ echo 'display:none'; } ?>">
                        <a href="<?php if($page_no >= $total_pages){ echo '#'; } else { echo "?page_no=".($page_no + 1).'&sort='.$sort.'&search='.$search; } ?>">Next</a>
                    </li>
                    <li style="padding: 10px;text-decoration: none;display: inline;background-color: rgb(59,55,55);"><a href="<?php echo '?page_no='.$total_pages.'&sort='.$sort.'&search='.$search; ?>"><?=$total_pages?></a></li>
                </ul>
            </div>
        </div>
    </body>
</html>
