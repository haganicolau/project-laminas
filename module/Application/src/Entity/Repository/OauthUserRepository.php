<?php
namespace Application\Entity\Repository;

use \Doctrine\ORM\EntityRepository;
use \Doctrine\ORM\NoResultException;
use \Library\Loghandler\Log;

/**
 * Description of Repository
 *
 * @author Hagamenon <haganicolau@gmail.com>
 * @date 15/07/2019
 */
class OauthUserRepository extends EntityRepository
{
    public function getOauthUserByAccessToken($accesToken)
    {
        try {
            $query = $this->_em->createQueryBuilder();

            return $query->select('oauth')
                ->from($this->_class->name, 'oauth')
                ->innerJoin('oauth.client', 'client', 'WITH')
                ->innerJoin('oauth.accessTokens', 'access_token', 'WITH')
                ->where("access_token.expires > :date")
                ->andWhere("access_token.accessToken = :token")
                ->setParameter('date', new \DateTime())
                ->setParameter('token', $accesToken)
                    ->getQuery()
                    ->getSingleResult();
        } catch (NoResultException $e) {
            Log::create(
                Log::INFO,
                'Autorização usuário, ' . $e->getMessage(),
                401
            );
            return null;
        } catch (\Exception $e) {
            Log::create(
                Log::ERORR,
                'Autorização usuário: ' . $e->getMessage(),
                500
            );
        }
    }
}
