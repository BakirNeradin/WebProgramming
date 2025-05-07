<?php
require_once 'DAO/UserDao.php';

$userDao = new UserDao();
$users = $userDao->getAll();

echo "<pre>";
print_r($users);
echo "</pre>";
