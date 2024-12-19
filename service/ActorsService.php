<?php
include_once '../dao/ActorsDao.php';
include_once '../dao/RolesDao.php';

include_once '../dto/ActorsDto.php';
include_once '../dto/RolesDto.php';




class ActorsService {

    private $actorsDao;
    private $roleDao;

    public function __construct() {
        $this->actorsDao = new ActorsDao();
       
        $this->roleDao=new RolesDAO();
    }

    // Register actor logic
    public function registerActor($name, $email, $password) {

    
        // Check if the email already exists in the database
        if ($this->actorsDao->emailExists($email)) {
           
            return "email";
        }
    
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        // Create Actor DTO
        $actorDto = new ActorsDto(0, $name, $email, $hashedPassword, $this->generateSlug($name), false);
    
        // Add actor to the database via DAO
        $result = $this->actorsDao->createActor($actorDto);
    
        if ($result) {
            $this->roleDao->createRole(new RolesDTO(1 , $result));
            
            
            
            return "success";

        } else {
            return "Error";
        }
    }
    public function getconfirmedA(){
        $res = $this->actorsDao->getConfirmedActors();
        return $res;
  }

  public function getNewA(){
    $res = $this->actorsDao->getNewActors();
    return $res;
}

    
    // Login actor logic
    public function loginActor($email, $password) {
        
    
        // Fetch actor by email
        $actorDto = $this->actorsDao->getActorByEmail($email);

    
        if ($actorDto) {
            
            // Check if the account is active
            if (!$actorDto->getState()) {
                
                return "not comfirmed";
            }
    
            // Verify the password
            if (password_verify($password, $actorDto->getPassword())) {
                $role=$this->roleDao->getActorRole($actorDto->getEmail());
                return $role;
            } else {
                return "wrong password";
            }
        } else {
            return "this account doesn't exist";
        }
    }
    
    

    // Generate a slug from name
    private function generateSlug($name) {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
    }
}
?>
