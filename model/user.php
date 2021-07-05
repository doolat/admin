<?php
require_once 'model/config.php';

class user extends config
{
    public function __construct()   //
    {
        parent::__construct();
    }

    //to get user's for main page
    public function index($search, $sort)
    {
        if (isset($_GET['page_no'])) {
            $page_no = $_GET['page_no'];
        } else {
            $page_no = 1;
        }
        $no_of_records_per_page = 10;
        $offset = ($page_no - 1) * $no_of_records_per_page;

        if (empty($sort)) {
            $total_pages_sql = "SELECT COUNT(*) FROM userInformation WHERE name LIKE '%$search%' OR login LIKE '%$search%';";
            $result = mysqli_query($this->conn, $total_pages_sql);
            $total_rows = mysqli_fetch_array($result)[0];
            $total_pages = ceil($total_rows / $no_of_records_per_page);

            $sql = "SELECT * FROM userInformation WHERE name LIKE '%$search%' OR login LIKE '%$search%' LIMIT $offset, $no_of_records_per_page;";
        } else {
            $total_pages_sql = "SELECT COUNT(*) FROM userInformation WHERE name LIKE '%$search%' OR login LIKE '%$search%' ORDER BY $sort;";
            $result = mysqli_query($this->conn, $total_pages_sql);
            $total_rows = mysqli_fetch_array($result)[0];
            $total_pages = ceil($total_rows / $no_of_records_per_page);

            $sql = "SELECT * FROM userInformation WHERE name LIKE '%$search%' OR login LIKE '%$search%' ORDER BY $sort LIMIT $offset, $no_of_records_per_page;";
        }

        $users = mysqli_query($this->conn, $sql);
        require_once 'view/index.php';
    }

    // authentication
    public function login()
    {
        $login = $_POST['login'];
        $password = md5($_POST['password']);
//        $password = $_POST['password'];

        $sql = "SELECT * FROM userInformation WHERE login='$login' AND password='$password' AND role='admin';";

        $user = mysqli_fetch_assoc(mysqli_query($this->conn, $sql));


        if ($user) {
            $_SESSION['user'] = [
                'id' => $user['Id'],
                'name' => $user['name'],
                'surname' => $user['surname'],
                'sex' => $user['sex'],
                'login' => $user['login'],
                'date' => $user['date']
            ];
            header('Location: index.php');
        } else {
            $_SESSION['message'] = 'Incorrect information';
            header('Location: index.php?controller=user&action=logout');
        }


    }

    //to add user
    public function addUser()
    {
        if (empty($_POST['name']) or empty($_POST['surname']) or empty($_POST['sex']) or empty($_POST['date']) or empty($_POST['login']) or empty($_POST['password']) or empty($_POST['password_confirm'])) {
            $_SESSION['message'] = 'All fields are required!';
            header('Location: index.php?controller=user&action=create');
        } else {
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $date = $_POST['date'];
            $sex = $_POST['sex'];
            $login = $_POST['login'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            $password_confirm = $_POST['password_confirm'];

            if ($password !== $password_confirm) {
                $_SESSION['message'] = 'Passwords are must be same!';
                header('Location: index.php?controller=user&action=create');
            } else {
                $password = md5($password);
                $sql = "INSERT INTO userInformation (name , surname, sex, login, password, date, role)
                                VALUES('$name', '$surname', '$sex', '$login', '$password','$date','$role');";

                mysqli_query($this->conn, $sql);
                $_SESSION['message'] = 'User is added!';
                header('Location: index.php');
            }
        }
    }

    //getting user for editing
    public function getUser($id)
    {
        $sql = "SELECT * FROM userInformation WHERE id='$id';";
        $user = mysqli_fetch_assoc(mysqli_query($this->conn, $sql));

        return $user;
    }

    //to edit user
    public function editUser($id)
    {
        if (empty($_POST['name']) or empty($_POST['surname']) or empty($_POST['sex']) or empty($_POST['date']) or empty($_POST['login'])) {
            $_SESSION['message'] = 'All fields are required except password!';
            header("Location: index.php?controller=user&action=show&id=$id");
        } else {
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $date = $_POST['date'];
            $sex = $_POST['sex'];
            $login = $_POST['login'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            $password_confirm = $_POST['password_confirm'];


            if ($password !== $password_confirm) {
//                var_dump("doolat");die();
                $_SESSION['message'] = 'Passwords are must be same!';
                header("Location: index.php?controller=user&action=show&id=$id");
            } else {
                $password = md5($password);
//          $sql = "UPDATE userInformation SET name='$name',surname='$surname',sex='$sex',login='$login',password='$password',date='$date',role='$role' WHERE id='$id';";
                $sql = "UPDATE userInformation SET name='$name',surname='$surname',sex='$sex',login='$login',date='$date',role='$role'";

                if ($password) {
                    $sql = $sql . ",password='$password'";
                }
                $sql = $sql . " WHERE id='$id';";
                mysqli_query($this->conn, $sql);
                $_SESSION['message'] = 'User is modified!';
                header('Location: index.php');
            }

        }
    }

    //to remove user
    public function removeUser($id){
        $sql = "DELETE FROM userInformation WHERE Id='$id';";

        mysqli_query($this->conn, $sql);
        $_SESSION['message'] = 'User removed!';
        header('Location: index.php');
    }

    //authorization
    public function isAdmin(){
        if (!$_SESSION['user']) {
            header('Location: index.php?controller=user&action=logout');
        }
    }
}
