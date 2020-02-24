<?php
namespace User\V1\Rest\Users;

use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\Rest\AbstractResourceListener;
use \Application\Entity\Repository\ClientRespository;
use Application\Entity\Repository\OauthUserRepository;
use User\DTO\UserDTO;
use Doctrine\ORM\EntityManager;
use Library\Exception\ExceptionApigility;
use Library\Util\Util;
use User\Entity\Repository\UserRepository;

class UsersResource extends AbstractResourceListener
{
    private $entityManager;
    private $clientOauthRepository;
    private $oauthUserDto;
    private $oathUserRepository;

    public function __construct(
        EntityManager $entityManager,
        OauthUserRepository $oathUserRepository,
        ClientRespository $clientOauthRepository,
        UserDTO $oauthUserDto
    ) {
        $this->entityManager = $entityManager;
        $this->oathUserRepository = $oathUserRepository;
        $this->clientOauthRepository = $clientOauthRepository;
        $this->oauthUserDto = $oauthUserDto;
    }

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        try {
            $client = $this->clientOauthRepository->findOneBy(
                ['clientID' => $data->client_id]
            );

            $user = $this->oathUserRepository->findOneBy(
                ['username' => $data->username]
            );
            if (! empty($user)) {
                throw new ExceptionApigility(
                    "Usename alredy registred",
                    400
                );
            }

            if (! Util::validateEmail($data->email)) {
                throw new ExceptionApigility(
                    "Invalid email",
                    400
                );
            }

            $user = $this->oathUserRepository->findOneBy(
                ['email' => $data->email]
            );
            if (! empty($user)) {
                throw new ExceptionApigility(
                    "Email alredy registred",
                    400
                );
            }

            Util::validateStrengthPass($data->password);

            $data->client = $client;

            /** @var \User\Entity\User */
            $user = $this->oauthUserDto->toEntity($data);

            $this->entityManager->persist($user->getOauthUser());
            $this->entityManager->flush();
        } catch (ExceptionApigility $ex) {
            return new ApiProblem(
                $ex->getcode(),
                $ex->getMessage()
            );
        }
        return $this->oauthUserDto->toDTO($user);
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        return new ApiProblem(405, 'The GET method has not been defined for individual resources');
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        return new ApiProblem(405, 'The GET method has not been defined for collections');
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Patch (partial in-place update) a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patchList($data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for collections');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }
}
