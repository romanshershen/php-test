<?php

require "libs/rb.php";
R::setup( 'mysql:host=localhost;dbname=test2.shershen',
        'mysql', 'mysql' ); //for both mysql or mariaDB

session_start();