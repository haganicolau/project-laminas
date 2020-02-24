<?php

namespace Library\ACL;

/**
 * Regras de uso da lista de acesso
 *
 * @author Hagamenon <haganicolau@gmail.com>
 * @date 19/07/2019
 */
class Role {
    
    const GUEST = 'guest';
    const ADMIN = 'ADMIN';
    const AGR = 'AGR';
    const USER = 'USER';
    
    /**
     * Retorna as regras
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public static function getAllRoles()
    {
        return [
            self::ADMIN,
            self::AGR,
            self::USER
        ];
    }
}

