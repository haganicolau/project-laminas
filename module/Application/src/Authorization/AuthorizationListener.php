<?php
namespace Application\Authorization;

use Zend\ServiceManager\ServiceManager;
use Application\Entity\OAuthUser;
use Application\Entity\Repository\OauthUserRepository;
use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\ApiProblem\ApiProblemResponse;
use Laminas\ApiTools\MvcAuth\Identity\AuthenticatedIdentity as IdentityAuthenticatedIdentity;
use Laminas\ApiTools\MvcAuth\MvcAuthEvent as MvcAuthMvcAuthEvent;
use Laminas\ServiceManager\ServiceManager as ServiceManagerServiceManager;
use Library\ACL\Role;
use Library\ACL\Resource;
use Library\Util\Util;

class AuthorizationListener 
{
    /** @var ServiceManager $serviceManager*/
    private $serviceManager;
    private $config;
    private $authorization;
    
    /**
     * Construct
     *
     * @param  ServiceManager $serviceManager
     * @param array $config
     * 
     * @return void
     */
    public function __construct(
        ServiceManagerServiceManager $serviceManager, 
        $config = []
    ) {
        $this->serviceManager = $serviceManager;
        $this->config = $config;
    }
    
    /**
     * Adiciona as regras na ACL do Apigility
     * 
     * @return void
     */
    public function setAllRoles()
    {
        foreach(Role::getAllRoles() as $role){
            $this->authorization->addRole($role);
        }
    }
    
    /**
     * Adiciona os recursos na ACL do Apigility 
     * 
     * @return void
     */
    public function setAddResources()
    {
        foreach(Resource::getResources() as $resource){
            $this->authorization->addResource($resource); 
        }
        
        if(Util::isDevelopmentEnable()) {
            foreach(Resource::getRulesResourcesAllow() as $adminResources) {
                $this->authorization->addResource($adminResources);
            }
        }
    }
    
    /**
     * Adiciona as permissões por meio do método allow($scope, $resource, $rule)
     * método que seta os recursos regras e scopo que foram definidas por 
     *
     * @param  ServiceManager $serviceManager
     * @param array $config
     * 
     * @return void
     */
    public function setRulesResource()
    {
        /* Deny from all */
        $this->authorization->deny();
        $allRules = Resource::getRulesResources();
        
        foreach(Resource::getResources() as $resource) {
            $rules = $allRules[$resource];
            foreach($rules as $scope => $rule){
                $this->authorization->allow($scope, $resource, $rule);
            }
        }
        
        if(Util::isDevelopmentEnable()) {
            foreach(Resource::getRulesResourcesAllow() as $adminResources) {
                $this->authorization->allow('guest', $adminResources);
            }
        }
        
    }
    
    /**
     * Método criado a partir do evento MvcAuthEvent::EVENT_AUTHORIZATION na classe
     * Application\Módule.php. Este método chama os demais métodos desta classe para construir
     * os recursos, regras e scopo da ACL. Valida o Access Token passado no cabeçalho da requisição
     * pelo nome Authorization. Obtém os dados do usuário que tenta acesso e valida os escopos do usuário
     * são equivalentes aos setados na configuração. Se um usuário com escopo User tenta acesso
     * a um recurso que foi configurado previamente desta forma.
     *
     * @param  MvcAuthEvent $mvcAuthEvent
     * 
     * @return void|ApiProblemResponse
     */
    public function __invoke(MvcAuthMvcAuthEvent $mvcAuthEvent)
    {
        /** @var Laminas\ApiTools\ContentNegotiation\Request */
        $request = $mvcAuthEvent->getMvcEvent()->getRequest();
        $response = $mvcAuthEvent->getMvcEvent()->getResponse();
        $headers = $request->getHeaders();
        
        /** @var \ZF\MvcAuth\Authorization\AclAuthorization $authorization */
        $this->authorization = $mvcAuthEvent->getAuthorizationService();
        
        $this->setAllRoles();
        $this->setAddResources();
        $this->setRulesResource();
        
        $path = Resource::getFilePath($mvcAuthEvent->getResource());
        $freeResources = Resource::getFreeResources();
        
        foreach($freeResources as $free) {
            if(strcmp($path, $free->resource) === 0 
                    && strcmp($request->getMethod(), $free->method) === 0){
                $mvcAuthEvent->setIsAuthorized(true);
                return;
            }
        }
        
        if(!$headers->has('Authorization')){
            return;
        }
        
        $bearer = $headers->get('Authorization')->getFieldValue();
        $accesssToken = explode(" ", $bearer);
        
        $entityManager = $this->serviceManager->get('doctrine.entitymanager.orm_default');
        
        /** @var OauthUserRepository $oauthRepository*/
        $oauthRepository = $entityManager->getRepository(OAuthUser::class);
        
        /** @var OAuthUser $oauthUser*/
        $oauthUser = $oauthRepository->getOauthUserByAccessToken($accesssToken[1]);
        if(empty($oauthUser)){
            return $this->responseError(201, "Not Authorized", $mvcAuthEvent);
        }
        
        $scopes = $oauthUser->getClient()->getScopes();      

        foreach($scopes as $scope) {
            if(!$this->authorization->isAllowed(
                    $scope->getScope(), 
                    $path, 
                    $request->getMethod()
                )
            ){
                return $this->responseError(201, "Not Authorized", $mvcAuthEvent);
            }
        }
        
        $identity = new IdentityAuthenticatedIdentity($accesssToken[1]);
        $identity->setName($oauthUser->getUsername());
        $mvcAuthEvent->setIdentity($identity);
        $mvcAuthEvent->setIsAuthorized(true);
    }
    
    /**
     * Retorna mensagem de erro conforme os parâmetros 
     *
     * @param int $code http code
     * @param string $message mensagem de erro
     * @param MvcAuthEvent $mvcAuthEvent para criar o evento de disparo da resposta 
     * 
     * @return ApiProblemResponse
     */
    public function responseError($code, $message, $mvcAuthEvent)
    {
        \Library\Loghandler\Log::create(
            \Library\Loghandler\Log::ERORR,
            $mvcAuthEvent->getResource() . " " . $message,
            $code
        );
        
        $response = new ApiProblemResponse(new ApiProblem($code, $message));
        $mvcEvent = $mvcAuthEvent->getMvcEvent();
        $mvcEvent->setResponse($response);
        return $response;
    }
   
}
