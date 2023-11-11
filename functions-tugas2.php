<?php
require_once('config/conn.php');
class ItemShow
{
    static function select()
    {
        global $conn;
        $sql = "SELECT item_id,nama_item,deskripsi,harga FROM item";
        $result = $conn->query($sql);
        $arr = array();

        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                foreach ($row as $key => $value) {
                    $arr[$key][] = $value;
                }
            }
        }
        return $arr;
    }
    static function selectById($id)
    {
        global $conn;
        $sql = "SELECT `nama_item`,`deskripsi`,`harga` FROM `item`";
        $result = $conn->query($sql);
        $arr = array();

        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                foreach ($row as $key => $value) {
                    $arr[$key][] = $value;
                }
            }
        }
        return $arr;
    }
}
class OrderShow
{
    static function select()
    {
        global $conn;
        $sql = "SELECT `order`.`order_id`, `item`.`nama_item`,`order`.`total`
        FROM `order`
        INNER JOIN `item` ON `order`.`item_id` = `item`.`item_id`";
        $result = $conn->query($sql);
        $arr = array();

        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                foreach ($row as $key => $value) {
                    $arr[$key][] = $value;
                }
            }
        }
        return $arr;
    }
    static function selectById($id)
    {
        global $conn;
        $sql = "SELECT `order`.`order_id`, `item`.`nama_item`,`order`.`total`
        FROM `order`
        INNER JOIN `item` ON `order`.`item_id` = `item`.`item_id`";
        $result = $conn->query($sql);
        $arr = array();

        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                foreach ($row as $key => $value) {
                    $arr[$key][] = $value;
                }
            }
        }
        return $arr;
    }
}
class CartShow
{

    static function select()
    {
        global $conn;
        $sql = "SELECT `cart`.`cart_id`,`item`.`nama_item`,`item`.`deskripsi`,`item`.`harga` 
        FROM `cart`
        INNER JOIN `item` ON `cart`.`item_id` = `item`.`item_id`";
        $result = $conn->query($sql);
        $arr = array();

        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                foreach ($row as $key => $value) {
                    $arr[$key][] = $value;
                }
            }
        }
        return $arr;
    }
    static function selectById($id = "")
    {
        global $conn;
        $sql = "SELECT `cart`.`cart_id`,`item`.`nama_item`,`item`.`deskripsi`,`item`.`harga` FROM `cart` INNER JOIN `item` ON `cart`.`item_id` = `item`.`item_id`";
        $result = $conn->query($sql);
        $arr = array();

        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                foreach ($row as $key => $value) {
                    $arr[$key][] = $value;
                }
            }
        }
        return $arr;
    }

    // Function to update the profile in the database



}
class Admin
{
    static function login_form()
    {
        view('login');
    }


    static function login_save()
    {
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $pass = $_POST['pass'];

            $user = Auth::authenticateUser($email, $pass);

            if ($user) {
                session_start();
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['id_role_detail'] = $user['id_role_detail'];
                $_SESSION['nama'] = $user['nama'];
                $_SESSION['no_telpon'] = $user['no_telpon'];
                $_SESSION['email'] = $user['email'];
                // Periksa nilai id_role_detail
                if ($user['id_role_detail'] == 1) {
                    header("Location: " . BASEURL . "dashboard");
                } else {
                    header("Location: " . BASEURL . "item");
                }
                exit();
            } else {
                $error_message = "Email atau password Anda salah. Silakan coba lagi!";
                header("Location: " . BASEURL . "gagal.php");
                exit();
            }
        }
    }


    static function dashboard()
    {
        view('forms/dashboard');
        // Di sini Anda dapat menampilkan halaman login
        // Misalnya, jika menggunakan PHP, Anda dapat memuat file tampilan login.php di sini.
    }
}
