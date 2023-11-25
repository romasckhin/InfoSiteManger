<?php

    if (isset($_POST['register'])) {
        $err = [];
        if (strlen($_POST['login']) < 4 || strlen($_POST['login']) > 30) {
            $err[] = 'Пароль меньше 4 или больше 30';
        }
        if (isLoginExit($_POST['login'])) {
            $err[] = 'Данный логин существует';
        }
        if (count($err) === 0) {
            createUser($_POST['login'], $_POST['password']);
            header('Location: /login ');
            exit();
        }
        else {
            echo "<h1>Ошибка регистарции</h1>";
            foreach ($err as $item) {
                echo $item;
            }
        }
    }

?>

<h2>Register</h2>

<form action="" method='post'>
    <div>
        Login: <input type="text" name="login" required>
    </div>
    <div>
        Password: <input type="text" name='password' required>
    </div>
    <div>
        <input type="submit" name='register' value='submit'>
    </div>
</form>