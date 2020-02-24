<?php
namespace User\Entity;

use \Application\Entity\Entity;
use Application\Entity\OAuthUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class OAuthUserEntity
 *
 * @package Application\Entity
 * @ORM\Entity(repositoryClass="\User\Entity\Repository\UserRepository")
 * @ORM\Table(name="users")
 */
class User extends Entity
{
    /**
     * Um oauthUser para um usuário.
     * @ORM\OneToOne(targetEntity="Application\Entity\OAuthUser", mappedBy="user", fetch="EAGER", cascade={"all"})
     */
    private $oauthUser;
    
    /**
     * @ORM\Column(name="first_name", type="string")
     */
    private $firstName;
    
    /**
     * @ORM\Column(name="last_name", type="string")
     */
    private $lastName;
    
    public function __construct() {
        $this->oauthUser = new OAuthUser();
    }
    
    public function getOauthUser()
    {
        return $this->oauthUser;
    }

    public function setOauthUser($oauthUser)
    {
        $this->oauthUser = $oauthUser;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName) 
    {
        $this->lastName = $lastName;
    }


    
}

