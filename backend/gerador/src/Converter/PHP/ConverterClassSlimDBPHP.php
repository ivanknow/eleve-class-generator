<?php
namespace App\Converter\PHP;
use App\Converter\AbstractConverter;

class ConverterClassSlimDBPHP extends AbstractConverter{

	 public function defineInputs(){

	 }
     public function setup($payload){

	 }
     public function process($classRep){
		
		$result=$this->addTo("declare(strict_types=1);");
	
		$result.=$this->addTo("namespace App\Infrastructure\Persistence\\".$classRep->name.";");

		$result.=$this->addTo("use App\Domain\\".$classRep->name."\\".$classRep->name.";");
		$result.=$this->addTo("use App\Domain\\".$classRep->name."\\".$classRep->name."NotFoundException;");
		$result.=$this->addTo("use App\Domain\\".$classRep->name."\\".$classRep->name."Repository;");
		$result.=$this->addTo("use App\Infrastructure\Persistence\AbstractRepository;");

		
		$result.=$this->addTo("class DB".$classRep->name."Repository extends AbstractRepository implements ".$classRep->name."Repository");
		$result.=$this->addTo("{");
	

		$result.=$this->addTo("}");

		return $result;
	}

}


/*


declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;

use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use App\Domain\User\UserRepository;
use App\Infrastructure\Persistence\AbstractRepository;

class DBUserRepository extends AbstractRepository implements UserRepository
{
    /**
     * @var User[]
     *
    private $users;

    /**
     * DBUserRepository constructor.
     *
     * @param array|null $users
     *
    public function __construct(array $users = null)
    {
        parent::__construct('App\Domain\User\User');
    }

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     *
    public function findUserById(int $id): User{
        $user = parent::findById($id);
        return $user;
    }

    public function findUserByUsername(string $username): User
    {
        $em = parent::getEntityManager();
        $query = $em->createQuery('SELECT u FROM App\Domain\User\User u WHERE u.username =  ?1');
        $query->setParameter(1,$username);
        $users = $query->getResult();
        if(count($users)!=1){
            throw new UserNotFoundException();
        }
        return $users[0];
    }

    public function updateUserToken(User $user): User
    {
        $em = parent::getEntityManager();
        $persistedUser = $em ->find (parent::getEntityPath() ,$user->getId()) ;
        $persistedUser->setToken($user->getToken());
        $em->persist($persistedUser);
        $em->flush();
        
        return $persistedUser;
    }

    public function createUser(User $user): User{
        $user = parent::insert($user);
        return $user;
    }
}

*/
?>