<?php

if (isset($_POST['submit'])) {
    $user = login($_POST['login'], $_POST['password']);

    if ($user) {
        
        $user = $user[0];
        $hash = md5(generateCode(10));
        $ip = null;

        if (!empty($_POST['ip'])) {
            $ip = $_SERVER['REMOTE_ADDR']; // получение ip пользователя
        }
        
        updateUser($user['id'], $hash, $ip);
        setcookie('hash',$hash, time() +60*60*24*30, '/');
        
        header('Location: /admin');
        exit();
    }
    else {
        echo 'Не правильно ввели логин или пароль';
    }
    
}
?>

<h2>Login</h2>

<form action="" method='post'>
    <div>
        Login: <input type="text" name="login" required>
    </div>
    <div>
        Password: <input type="text" name='password' required>
    </div>
    <div>
        Прикрепить в IP <input type="checkbox" name='ip'>
    </div>
    <div>
        <input type="submit" name='submit' value='submit'>
    </div>
</form>