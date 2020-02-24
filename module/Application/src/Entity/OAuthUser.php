<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Laminas\Crypt\Password\Bcrypt;
use \Doctrine\Common\Collections\ArrayCollection;
use Application\Entity\IEntity;

/**
 * Class OAuthUserEntity
 *
 * @package Application\Entity
 * @ORM\Entity(repositoryClass="\Application\Entity\Repository\OauthUserRepository")
 * @ORM\Table(name="oauth_users")
 */
class OAuthUser implements IEntity
{
    const ROLE_ADMIN = 'admin';
    const ROLE_AGR = 'agr';
    const ROLE_USER  = 'user';
    const ROLE_GUEST = 'guest';

    /**
     * @ORM\Id
     * @ORM\Column(name="username", type="string")
     * @var int
     */
    private $username;
    
    /**
     * @ORM\Column(name="email", type="string")
     */
    private $email;

    /**
     * @ORM\Column(name="password", type="string",length=255)
     * @var string
     */
    private $password;
    
    /**
     * Many features have one product. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="users")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="client_id")
     */
    private $client;
    
    /**
     * One product has many features. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Application\Entity\AccessToken", mappedBy="oauthUser")
     */
    private $accessTokens;
    
    /**
     * Um oauthUser para um usuário.
     * @ORM\OneToOne(targetEntity="User\Entity\User", inversedBy="oauthUser", fetch="EAGER", cascade={"all"})
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */
    private $user;

    public function __construct() 
    {
        $this->accessTokens = new ArrayCollection();
        $this->client = new Client();
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function setPassword($password)
    {
        $this->password = (new Bcrypt())->create($password);
        return $this;
    }

    public function getEmail() 
    {
        return $this->email;
    }

    public function getClient() 
    {
        return $this->client;
    }

    public function setEmail($email) 
    {
        $this->email = $email;
    }

    public function setClient($client) 
    {
        $this->client = $client;
    }
    
    public function getAccessTokens()
    {
        return $this->accessTokens;
    }

    public function setAccessTokens($accessTokens) 
    {
        $this->accessTokens = $accessTokens;
    }
    
    public function getUsername() 
    {
        return $this->username;
    }

    public function getPassword() 
    {
        return $this->password;
    }
    
    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }


}

