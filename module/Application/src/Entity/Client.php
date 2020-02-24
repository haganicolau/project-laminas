<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use \Doctrine\Common\Collections\ArrayCollection;

/**
 * @package Application\OAuth
 * @ORM\Entity(repositoryClass="\Application\Entity\Repository\ClientRespository")
 * @ORM\Table(name="oauth_clients")
 */
class Client 
{
   
    /**
     * @ORM\Id
     * @ORM\Column(name="client_id", type="string")
     * @var string
     */
    private $clientID;
 
    /**
     * @ORM\OneToMany(targetEntity="OAuthUser", mappedBy="client")
     */
    private $users;
  
    /**
    * One product has many features. This is the inverse side.
    * @ORM\OneToMany(targetEntity="AccessToken", mappedBy="client")
    */
    private $accessTokens;

    /**
     * One product has many features. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Scope", mappedBy="client")
     */
    private $scopes;
    
    public function __construct() 
    {
        $this->users = new ArrayCollection();
        $this->scopes = new ArrayCollection();
        $this->accessTokens = new ArrayCollection();
    }
    
    public function getClientID() 
    {
        return $this->clientID;
    }

    public function setClientID($clientID) 
    {
        $this->clientID = $clientID;
    }
    
    public function getScopes() 
    {
        return $this->scopes;
    }

    public function setScopes($scopes) 
    {
        $this->scopes = $scopes;
    }
    
    public function getAccessTokens() 
    {
        return $this->accessTokens;
    }

    public function setAccessTokens($accessTokens) 
    {
        $this->accessTokens = $accessTokens;
    }    
    
    public function getUsers() 
    {
        return $this->users;
    }

    public function setUsers($users) 
    {
        $this->users = $users;
    }
}
