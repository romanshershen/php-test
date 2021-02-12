<?php
require "db.php";

$data = $_POST;
if(isset($data['do_login'])){
    $errors = array();
    $user = R::findOne('users', 'email = ?', array($data['email']));
    if( $user ){
        //EMAIL ЗАРЕГИСТРИРОВАН
        if( password_verify($data['password'], $user->password)){
        // все хорошо, логиним пользователя
        $_SESSION['logged_user'] = $user;
        echo '<div style="color: green;">Вы авторизованы! Можете перейти на <a href="/">Главную </a> страницу</div><hr>';
        }else{
            $errors[] = 'Неверно введен пароль!';
        }
    }else{
        $errors[] = 'Пользователь с таким Email не найден!';
    }


    if( ! empty($errors))
    {
        echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
    }
}
?>
<button><a href="/">Вернуться на Главную </a></button><br>
<form action="login.php" method="POST">
<p><p><strong>Ваш Email</strong></p>
        <input type="email" name="email" value="<?php echo @$data['email'];?>">
    </p>
    <p><p><strong>Ваш пароль</strong></p>
        <input type="password" name="password" value="<?php echo @$data['password'];?>">
    </p>
    <p>
        <button type="submit" name="do_login">Войти</button>
    </p>
</form>