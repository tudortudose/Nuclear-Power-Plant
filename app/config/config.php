<?php
    //Database params
    define('DB_HOST', 'localhost'); //Add your db host
    define('DB_USER', 'root'); // Add your DB root
    define('DB_PASS', ''); //Add your DB pass
    define('DB_NAME', 'nuclear'); //Add your DB Name

    //APPROOT
    define('APPROOT', dirname(dirname(__FILE__)));

    //URLROOT (Dynamic links)
    define('URLROOT', 'http://localhost/NuclearGitProject/Nuclear-Power-Plant');

    //Sitename
    define('SITENAME', 'Nuclear Power Plant Manager');

    //precompiled db string (+parameters binding) = anti-sql injection
