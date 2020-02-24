<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entidade access token que posssui relacionamento com oauthUsers
 *
 * @author Hagamenon <haganicolau@gmail.com>
 * @date 19/07/2019
 **/
/**
 * @package Application\Entity
 * @ORM\Entity()
 * @ORM\Table(name="oauth_access_tokens")
 */
class AccessToken 
{
    
    /**
     * @ORM\Id
     * @ORM\Column(name="access_token", type="string")
     * @var string
     */
    private $accessToken;
    
    /**
     * Many features have one product. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Application\Entity\OAuthUser", inversedBy="accessTokens")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="username")
     */
    private $oauthUser;
    
    /**
     * Many features have one product. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="accessTokens")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="client_id")
     */
    private $client;
    
    /**
     * @ORM\Column(name="expires", type="datetime")
     * @var string
     */
    private $expires;
    
    public function getAccessToken() 
    {
        return $this->accessToken;
    }

    public function getOauthUser() 
    {
        return $this->oauthUser;
    }

    public function getClient() 
    {
        return $this->client;
    }

    public function getExpires() 
    {
        return $this->expires;
    }

    public function setAccessToken($accessToken) 
    {
        $this->accessToken = $accessToken;
    }

    public function setOauthUser($oauthUser) 
    {
        $this->oauthUser = $oauthUser;
    }

    public function setClient($client) 
    {
        $this->client = $client;
    }

    public function setExpires($expires) 
    {
        $this->expires = $expires;
    }
}
