<?php


namespace App\Security;


use App\Entity\Comments;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class CommentVoter extends Voter
{

    const EDIT = 'EDIT_COMMENT';

    protected function supports($attribute, $subject)
    {
        return
        $attribute === self::EDIT &&
        $subject instanceof Comments;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        // récupération de l'utilisateur
        $user = $token->getUser();
        // vérification que user est bien une instance de User et que $subject est bien une instance de Comments
        if(!$user instanceof User || !$subject instanceof Comments) {
            return false;
        }

        // comparaison des id, si match => permission accordée
        return $subject->getUser()->getId() === $user->getId();
    }
}