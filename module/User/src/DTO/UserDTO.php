<?php

namespace User\DTO;

use Application\Entity\OAuthUser;
use \Application\DTO\IDTO;
use \Application\Entity\IEntity;
use \User\Entity\User;

/**
 * Cria objetos para transição de informações entra o banco e a view
 *
 * @author Hagamenon <haganicolau@gmail.com>
 * @date 19/07/2019
 **/
class UserDTO
{
    
     /**
     * Convert objeto database em array para view
     *
     * @param  User $user
     * 
     * @return array $dto
     */
    public function toDTO(User $entity)
    {
        return [
            "username" => $entity->getOauthUser()->getUsername(),
            "firstName" => $entity->getFirstName(),
            "lastName" => $entity->getLastName(),
            "email" => $entity->getOauthUser()->getEmail(),
        ];
    }

    /**
     * Convert objeto data do view para Entity\User
     *
     * @param  data
     * 
     * @return Entity\User $user
     */
    public function toEntity($data) 
    {
        $user = new User();
        $oauth = new OAuthUser();
        
        $oauth->setClient($data->client);
        $oauth->setEmail($data->email);
        $oauth->setPassword($data->password);
        $user->setFirstName($data->first_name);
        $user->setLastName($data->last_name);
        $oauth->setUsername($data->username);
        $user->setActive(true);
        $oauth->setUser($user);
        $user->setOauthUser($oauth);
        return $user;
    }

    public function toListDTO(array $collection) 
    {
        
    }

    public function toListEntity(array $collection) 
    {
        
    }

}

