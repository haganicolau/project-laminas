<?php

namespace Application\DTO;

use \Application\Entity\IEntity;

/**
 * Description of iDTO
 *
 * @author haganicolau
 */
Interface IDTO {
    
    public function toDTO(IEntity $entity);
    
    public function toEntity($dto);
    
    public function toListDTO(array $collection);
    
    public function toListEntity(array $collection);
}
