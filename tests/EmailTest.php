<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;


require_once("C:\\xampp\htdocs\bedok_85_nus\src\Email.php");

final class EmailTest extends TestCase
{
    public function testCanBeCreatedFromValidEmail(): void
    {
        $string = 'user@example.com';

        $email = Email::fromString($string);

        // $this->assertSame($string, $email->asString());
        $this->assertSame('test', $email->asString());
        // $this->assertIsBool(null);
    }

}