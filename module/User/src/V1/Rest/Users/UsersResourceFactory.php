<?php
namespace User\V1\Rest\Users;

use User\Entity\User;
use Application\Entity\Client;
use Application\Entity\OAuthUser;
use User\DTO\UserDTO;

class UsersResourceFactory
{
    /** @var \Doctrine\ORM\EntityManager */
    private $entityManager; 

    public function __invoke($services)
    {
        $this->entityManager = $services->get('doctrine.entitymanager.orm_default');  

        return new UsersResource(
            $this->entityManager,
            $this->entityManager->getRepository(OAuthUser::class),
            $this->entityManager->getRepository(Client::class),
            new UserDTO()
        );
    }
}
