<?php

namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class OAuthUserEntity
 *
 * @package User\Entity
 * @ORM\Entity(repositoryClass="\User\Entity\Repository\TesteRepository")
 * @ORM\Table(name="teste")
 */
class Teste  
{
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     * @var int
     */
    protected $id;
    
    /**
     * @ORM\Column(name="texto", type="string")
     */
    protected $texto;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function getTexto() {
        return $this->texto;
    }

    public function setTexto($texto) {
        $this->texto = $texto;
    }
}
