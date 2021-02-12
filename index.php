<?php
require "db.php";

?>
<?php if( isset($_SESSION['logged_user'])) : ?>
    Авторизован! <br> 
    Привет, <?php echo $_SESSION['logged_user']->email; ?>
    <hr>
    <a href="/logout.php">Выйти</a>
<?php else : ?>
Вы не авторизованы <br>
<a href="login.php">Авторизироваться</a><br>
<a href="signup.php">Регистрация</a><br>
<button  type="submit" onClick="document.location.href='/excel.php'">Экспорт в Excel
</button>
<?php endif; ?>