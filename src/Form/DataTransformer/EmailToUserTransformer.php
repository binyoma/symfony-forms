<?php

namespace App\Form\DataTransformer;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;


class EmailToUserTransformer implements DataTransformerInterface
{
    private UserRepository $userRepository;
    private $finderCallback;

    public function __construct(UserRepository $userRepository, callable $finderCallback )
    {
        $this->userRepository = $userRepository;
        $this->finderCallback = $finderCallback;
    }

    public function transform($value)
    {
       if ($value === null) {
           return '';
       };
       if (! $value instanceof User) {
           throw new \LogicException('The value must be an instance of "App\Entity\User".');
       }
       return $value->getEmail();
    }

    public function reverseTransform($value)
    {
        if (!$value) {
            return null;
        }
       $callback = $this->finderCallback;
        $user = $callback($this->userRepository, $value);
       if (! $user) {
           throw new TransformationFailedException(sprintf(
               'The user with email "%s" does not exist.',
               $value
           ));
       }
       return $user;
    }

}