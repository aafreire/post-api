<?php

namespace just\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function validateUser($data)
    {
        $builder= $this->_em->createQueryBuilder();

        $builder->select('a')
                ->from($this->getEntityName(), 'a')
                ->where('a.username = :username')
                ->setParameter('username', $data->username);

        $user = $builder->getQuery()->getSingleResult();

        if (crypt($data->password, $user->getPassword()) != $user->getPassword()) {
            return false;
        }

        return true;
    }
}