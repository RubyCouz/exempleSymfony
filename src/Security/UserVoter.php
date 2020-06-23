<?php

namespace App\Security;


use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class UserVoter extends Voter
{

    const EDIT = 'edit';

    protected function supports($attribute, $subject)
    {
// l'attribut n'est pas dans la liste
        if (!in_array($attribute, [self::EDIT])) {
            return false;
        }
        // si $user n'est pas une instance de User => pas connecté
        if (!$subject instanceof User) {
            return false;
        }
        // si retourne true, appel de voteOnAttribute()
        return true;
    }


    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        // you know $subject is a User object, thanks to `supports()`

        $utilisateur = $subject;

        switch ($attribute) {
            case self::EDIT:
                return $user->getId() == $utilisateur->getId();
        }

        throw new \LogicException('This code should not be reached!');
    }

}

