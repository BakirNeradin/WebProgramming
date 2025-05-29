<?php
use PHPUnit\Framework\TestCase;

class UserRoutesTest extends TestCase {

    public function setUp(): void
    {
        require_once __DIR__ . '/../vendor/autoload.php';
        require_once __DIR__ . '/../backend/index.php';

        Flight::halt(false); 
    }

    public function testGetAllUsers()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/users'; 

        ob_start();
        Flight::start();
        $output = ob_get_clean();

        $this->assertEquals(200, http_response_code());
        $this->assertJson($output);
    }
}
