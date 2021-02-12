<?php
require "db.php";

$data = $_POST;
if(isset($data['do_signup']))
{
    //регистрируем
    $errors = array();
    if( trim($data['email'] == '')){
        $errors[] = 'Введите email!';
    }

    if( ($data['password'] == '')){
        $errors[] = 'Введите пароль!';
    }
    
}
if( R::count('users', "email = ?", array($data['email'])) > 0){
    $errors[] = 'Пользователь с таким Email уже существует!';
}
    if( empty($errors))
    {
        // все хорошо, регистрируем
        $user = R::dispense('users');
        $user->email = $data['email'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        R::store($user);
        echo '<div style="color: green;">Вы успешно зарегистрированы</div><hr>';
    }else{
        echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
    }

?>

<button><a href="/">Вернуться на Главную </a></button><br>

<form action="/signup.php" method="POST">
    
    <p><p><strong>Ваш Email</strong></p>
        <input type="email" name="email" value="<?php echo @$data['email'];?>">
    </p>
    <p><p><strong>Ваш пароль</strong></p>
        <input type="password" name="password" value="<?php echo @$data['password'];?>">
    </p>
    <p>
        <button type="submit" name="do_signup">Зарегистрироваться</button>
    </p>
    
</form>