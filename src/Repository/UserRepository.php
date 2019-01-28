<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }
	
	
    public function transform(User $user)
    {
        return [
                'id'    => (int) $user->getId(),
                'imie' => (string) $user->getName(),
                'nazwisko' => (string) $user->getSurname(),
                'telefon' => (int) $user->getTelephone(),
                'address' => (string) $user->getAddress()
        ];
    }
    public function transformAll()
    {
        $users = $this->findAll();
        $userArray = [];
        foreach ($users as $user) {
            $userArray[] = $this->transform($user);
        }
        return $userArray;
    }
	
	 public function transformOne($id)
    {
        $user = $this->find($id);
        $userArray = [];
		if(!empty($user))
        $userArray[] = $this->transform($user);
        return $userArray;
    }

}
