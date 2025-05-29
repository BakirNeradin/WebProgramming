<?php
require_once 'UserDao.php';

/*
$userDao = new UserDao();
$userDao->insert([
    'name' => 'adna',
    'email' => 'adnacicko@example.com',
    'password' => password_hash('adna', PASSWORD_DEFAULT)
    
]);
*/
/*
$userDao = new UserDao();
$userDao->insert([
    'name' => 'amir',
    'email' => 'amir@example.com',
    'password' => password_hash('amir123', PASSWORD_DEFAULT)
]);
*/
$userDao = new UserDao();
$userDao->insert([
    'name' => 'sejla',
    'email' => 'sejlaibu@example.com',
    'password' => password_hash('sejla', PASSWORD_DEFAULT)
]);

?>
