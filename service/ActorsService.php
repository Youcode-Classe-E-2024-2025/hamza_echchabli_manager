<?php
include_once '../dao/ActorsDao.php';
include_once '../dao/RolesDao.php';

include_once '../dao/ArchiveDao.php';

include_once '../dto/ActorsDto.php';
include_once '../dto/RolesDto.php';


include_once '../dto/ArchiveDto.php';




class ActorsService {

    private $actorsDao;
    private $roleDao;

    private $archive;

    public function __construct() {
        $this->actorsDao = new ActorsDao();
       
        $this->roleDao=new RolesDAO();
        $this->archive=new ArchiveDao();
    }

    public function registerActor($name, $email, $password) {

    
        if ($this->actorsDao->emailExists($email)) {
           
            return "email";
        }
    
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        $actorDto = new ActorsDto(0, $name, $email, $hashedPassword, $this->generateSlug($name), false);
    
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

public function setRole($email ,$role){

    $this->roleDao->updateRole($email,$role);
}


   public function archivedOne(){
    $res=$this->actorsDao->getArchiveActors();
    return $res;
   }
   


    
    public function loginActor($email, $password) {
        
    
        $actorDto = $this->actorsDao->getActorByEmail($email);
        $ifArchive= $this->archive->getone($email);

    
        if ($actorDto) {
            
            if (!$actorDto->getState()  || $ifArchive!=null) {
                
                return "not comfirmed";
            }
    
            if (password_verify($password, $actorDto->getPassword())) {
                $role=$this->roleDao->getActorRole($actorDto->getEmail());
                return [$role ,$actorDto->getId()];
            } else {
                return "wrong password";
            }
        } else {
            return "this account doesn't exist";
        }
    }
    
    public function setState(string $email) {
        $this->actorsDao->toggleActorState($email);
    }
    


    

    private function generateSlug($name) {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
    }
}
?>
