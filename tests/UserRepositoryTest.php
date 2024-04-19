<?php
use PHPUnit\Framework\TestCase;

final class UserRepositoryTest {
    public function testFindByIdReturnsUserObject() {
        // Arrange
        $mockStatement = $this->createMock(PDOStatement::class);
        $mockResult = [['user_id' => 1, 'username' => 'testuser', 'password' => 'password123', 'contact_no' => '1234567890', 'email' => 'test@example.com', 'address' => '123 Main St', 'user_type' => 'regular', 'c_user_id' => 1, 'credit_card_no' => '1234-5678-9012-3456', 'card_name' => 'John Doe', 'cv2' => '123', 'expiry_date' => '12/24']];
        $mockStatement->method('fetch_assoc')->willReturn($mockResult[0]);
        $mockResult = $this->createMock(mysqli_result::class);
        $mockResult->method('fetch_assoc')->willReturn($mockResult[0]);
        $mockStatement->method('get_result')->willReturn($mockResult);
        $mockDb = $this->createMock(PDO::class);
        $mockDb->method('prepare')->willReturn($mockStatement);
        $mockDb->method('bind_param')->willReturn(true);
        $mockDb->method('execute')->willReturn(true);

        $userRepository = new User($mockDb); // Create an instance of the class, passing the mock DB
        
        // Act
        $user = $userRepository->findById(1); // Call the findById() function
        
        // Assert
        $this->assertInstanceOf(User::class, $user); // Check if the result is an instance of the User class
        // You may want to further assert the properties of the returned user object
        $this->assertEquals(1, $user->getId());
        $this->assertEquals('testuser', $user->getUsername());
        // Add more assertions for other properties
    }
}