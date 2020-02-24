<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Scope
 *
 * @package Application\OAuth
 * @ORM\Entity(repositoryClass="\User\Entity\Repository\ScopeRepository")
 * @ORM\Table(name="oauth_scopes")
 */
class Scope
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     * @var int
     */
    private $id;
       
    /**
     * @ORM\Column(name="type", type="string")
     */
    private $type;
    
    /**
     * @ORM\Column(name="scope", type="string")
     */
    private $scope;
    
    /**
     * Many scopes have one client. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="scopes")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="client_id")
     */
    private $client;
    
    /**
     * @ORM\Column(name="is_default", type="boolean")
     */
    private $isDefault;
    
    public function getId()
    {
        return $this->id;
    }

    public function getType() 
    {
        return $this->type;
    }

    public function getScope() 
    {
        return $this->scope;
    }

    public function getClient() 
    {
        return $this->client;
    }

    public function getIsDefault() 
    {
        return $this->isDefault;
    }

    public function setId(string $id)
    {
        $this->id = $id;
    }

    public function setType($type) 
    {
        $this->type = $type;
    }

    public function setScope($scope) 
    {
        $this->scope = $scope;
    }

    public function setClient($client) 
    {
        $this->client = $client;
    }

    public function setIsDefault($isDefault) 
    {
        $this->isDefault = $isDefault;
    }

}
