<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL ^ (E_NOTICE | E_DEPRECATED));


class Config
{
    public static function DB_NAME()
    {
        return 'webprogramming'; //restaurant_db
    }
    public static function DB_PORT()
    {
        return  3306;
    }
    public static function DB_USER()
    {
        return 'root';
    }
    public static function DB_PASSWORD()
    {
        return '1234';
    }
    public static function DB_HOST()
    {
        return '127.0.0.1';
    }

    public static function JWT_SECRET() {
        return '1ca66e47387c8b363994bdae3a08ebd955649fe9ab1d26ad63b5b38a42796c00cbb7007a2a80233cbca66e2c959543413c58c66b1135269c8006f6467803784ac415e2e36cedcdce1bafeee2b980853971e424c14ce60f858b72360e3584cb74f8a435b6a4e80b7618a76618d410a73435c1498a7ebc18d25a6984bbcbe9b9424af060460a9a0981daef94c732a4bb3b73cc76746efeaad36b794efa4ec3ef68a072d5490b78947d8a5970d04018e2301dde162ecea66d98a978ef35cf33f12a4917cf25c623fb594601c92c13241d7008dadd06a0c8022b5a797c14e7f883eaeb60d04df1a105ebe2eb9816c21122c9c8e2490b10b0c3f24f00c1f71f436700';
    }
}
?>
