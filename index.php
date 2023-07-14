<?php 

 
// Проверяем нажата ли кнопка отправки формы
if (isset($_REQUEST['doGo'])) {
    
    // if (!$_REQUEST['pass']) {
    //     $error = 'Введите пароль';
    // }
 
    // Проверка есть ли email
    if (!$_REQUEST['email']) {
        $error = 'Введите email';
    }
 
    // Если ошибок нет, то происходит регистрация 
    if (!$error) {

        $email = $_REQUEST['email'];
        
        // хешируем хеш, который состоит из почты и времени
        $hash = md5($email . time());
        
        // Переменная $headers нужна для Email заголовка
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "To: <$email>\r\n";
        $headers .= "From: <mail@example.com>\r\n";
        // Сообщение для Email
        $message = "Нажмите на <a href=\"http://{$_SERVER['SERVER_NAME']}?hash=" . $hash . "\">ссылку</a> для подтверждения email";          
    
        // проверяет отправилась ли почта
        if (mail($email, "Подтвердите Email на сайте", $message, $headers)) {
            // Если да, то выводит сообщение
            echo 'Подтвердите на почте';
        }
    } else {
        // Если ошибка есть, то выводить её 
        echo $error; 
    }
}
?>

<?php
if ($_GET['hash']) {
    echo "email подтвержден";  
} 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>
</head>
<body>
    <form action="<?= $_SERVER['SCRIPT_NAME'] ?>" method="post">
        <p>EMail: <input type="email" name="email"><samp style="color:red">*</samp></p>
        <p><input type="submit" value="Зарегистрироваться" name="doGo"></p>
    </form>
</body>
</html>
