<?php
include_once '../dao/ActorsDao.php';
include_once '../dto/ActorsDto.php';

class ActorsService {

    private $actorsDao;

    public function __construct() {
        $this->actorsDao = new ActorsDao();
    }

    // Register actor logic
    public function registerActor($name, $email, $password) {

    
        // Check if the email already exists in the database
        if ($this->actorsDao->emailExists($email)) {
            echo'email';
            return "email";
        }
    
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        // Create Actor DTO
        $actorDto = new ActorsDto(0, $name, $email, $hashedPassword, $this->generateSlug($name), false);
    
        // Add actor to the database via DAO
        $result = $this->actorsDao->createActor($actorDto);
    
        if ($result) {
            return "success";
        } else {
            return "Error";
        }
    }
    
    // Login actor logic
    public function loginActor($email, $password) {
        // Validate input
        if (empty($email) || empty($password)) {
            return ['status' => 'error', 'message' => 'Email and password are required.'];
        }
    
        // Fetch actor by email
        $actorDto = $this->actorsDao->getActorByEmail($email);
    
        if ($actorDto) {
            echo $actorDto->getState().'<br>';
            // Check if the account is active
            if (!$actorDto->getState()) {
                
                return ['status' => 'error', 'message' => 'Account is not active.'];
            }
    
            // Verify the password
            if (password_verify($password, $actorDto->getPassword())) {
                return ['status' => 'success', 'message' => 'Login successful!', 'actor' => $actorDto];
            } else {
                return ['status' => 'error', 'message' => 'Invalid password.'];
            }
        } else {
            return ['status' => 'error', 'message' => 'Email not found.'];
        }
    }
    
    

    // Generate a slug from name
    private function generateSlug($name) {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
    }
}
?>
