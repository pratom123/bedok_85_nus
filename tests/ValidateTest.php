<?php
use PHPUnit\Framework\TestCase;

class ValidateTest extends TestCase {
    public function testValidCardNumber() {
        // Arrange
        $cardNum = '1234-5678-9012-3456';

        // Act
        $isValid = Validate::validateCardNum($cardNum);

        // Assert
        $this->assertTrue($isValid);
    }

    public function testInvalidCardNumber() {
        // Arrange
        $cardNum = 'invalid_card_number';

        // Act
        $isValid = Validate::validateCardNum($cardNum);

        // Assert
        $this->assertTrue(!$isValid);
    }

    public function testValidCardName() {
        // Arrange
        $cardName = 'John Doe';

        // Act
        $isValid = Validate::validateCardName($cardName);

        // Assert
        $this->assertTrue($isValid);
    }

    public function testInvalidCardName() {
        // Arrange
        $cardName = '12345'; // Not only alphabets

        // Act
        $isValid = Validate::validateCardName($cardName);

        // Assert
        $this->assertTrue(!$isValid);
    }
}
?>
