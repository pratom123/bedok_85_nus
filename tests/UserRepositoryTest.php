<?php
use PHPUnit\Framework\TestCase;

final class UserRepositoryTest extends TestCase {
    public function testFindByIdReturnsUserObject() {
        // Mock the database connection
        $mockDb = $this->getMockBuilder(PDO::class)
                       ->disableOriginalConstructor()
                       ->getMock();

        // Prepare a sample user data
        $userData = [
            'user_id' => 1,
            'username' => 'testuser',
            'password' => 'password123',
            'contact_no' => '1234567890',
            'email' => 'test@example.com',
            'address' => '123 Main St',
            'user_type' => 'regular',
            'c_user_id' => 1,
            'credit_card_no' => '1234-5678-9012-3456',
            'card_name' => 'John Doe',
            'cv2' => '123',
            'expiry_date' => '12/24'
        ];

        // Mock the result set with the sample user data
        $mockStatement = $this->getMockBuilder(PDOStatement::class)
                              ->disableOriginalConstructor()
                              ->getMock();
        $mockStatement->expects($this->once())
                      ->method('fetch_assoc')
                      ->willReturn($userData);

        // Mock the prepare and execute methods
        $mockDb->expects($this->once())
               ->method('prepare')
               ->willReturn($mockStatement);
        $mockDb->expects($this->once())
               ->method('bind_param')
               ->with('i', 1);
        $mockDb->expects($this->once())
               ->method('execute');

        // Inject the mocked database connection into the UserRepository
        $userRepository = new UserRepository($mockDb);

        // Call the method under test
        $user = $userRepository->findById(1);

        // Assert that the returned user object is correct
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($userData['user_id'], $user->getId());
        $this->assertEquals($userData['username'], $user->getUsername());
        // Add more assertions for other properties as needed
    }
}