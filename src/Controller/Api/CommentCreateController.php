<?php


namespace App\Controller\Api;


use App\Entity\Comments;
use Symfony\Component\Security\Core\Security;

class CommentCreateController
{
    private $security;

    public function __construct(Security $security)
    {
        // récupération de la connection
        $this->security = $security;
    }

    public function __invoke(Comments $data) // $data => donnée envoyé à l'API
    {
        // Définissions de l'utilisateur qui a émis le commentaire comme étant celui qui est connecté
       $data->setUser($this->security->getUser());
       return $data;
    }


}