<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Entity
 *
 * @author haganicolau
 */
class Entity implements IEntity
{

    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(name="id", type="integer")
    * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
    * @var int
    */
    protected $id;

    /**
     * @ORM\Column(name="active", type="boolean")
     */
    protected $active;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }
}
