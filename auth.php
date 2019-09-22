<?php
    
    include("db.php");

    function generateCode($length=6) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;

        while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
        }

        return $code;
    }


    $response["status"] = false;

    if (isset($_POST['email']) && isset($_POST['pass'])) {

        // Вытаскиваем из БД запись, у которой логин равняеться введенному
        $query = mysqli_query($db,"SELECT user_id, user_password FROM users WHERE user_email='".mysqli_real_escape_string($db,$_POST['email'])."' LIMIT 1");

        $data = mysqli_fetch_assoc($query);

        // Сравниваем пароли
        // if($data['user_password'] === md5(md5($_POST['password'])))

        if($data['user_password'] === $_POST['pass'])
        {
            // Генерируем случайное число и шифруем его
            $hash = md5(generateCode(10));

            // Записываем в БД новый хеш авторизации и IP
            mysqli_query($db, "UPDATE users SET user_hash='".$hash."' WHERE user_id='".$data['user_id']."'");

            // Ставим куки
            setcookie("user_id", $data['user_id'], time()+60*60*24*30);
            setcookie("user_hash", $hash, time()+60*60*24*30,null,null,null,true); // httponly !!!

            // Переадресовываем браузер на страницу проверки нашего скрипта
            // header("Location: https://zufarovainteriors.com/admin/projects.php");

            $response["status"] = true;
        }
        else {
            $response["message"] = "Вы ввели неправильный логин/пароль";
        }


    } 

    echo json_encode($response);
?>
