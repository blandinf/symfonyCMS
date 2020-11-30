<?php

namespace App\Security\Voter;

use App\Entity\Offer;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class OfferVoter extends Voter
{
    const CREATE = 'create';
    const UPDATE = 'update';
    const DELETE = 'delete';

    private $security = null;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @param $attribute
     * @param $subject
     * @return bool
     */
    protected function supports(string $attribute, $subject)
    {
        return in_array($attribute, [self::CREATE, self::UPDATE, self::DELETE]) && $subject instanceof Offer;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        $offer = $subject;

        switch ($attribute) {
            case self::CREATE:
                return $this->canCreate();
            case self::UPDATE:
                return $this->canUpdate($offer, $user);
            case self::DELETE:
                return $this->canDelete($offer, $user);
        }

        return false;
    }

    private function canCreate()
    {
        return true;
    }

    private function canUpdate(Offer $offer, $user)
    {
        return $user === $offer->getAuthor();
    }

    private function canDelete(Offer $offer, $user)
    {
        if ($this->canUpdate($offer, $user)) {
            return true;
        }
        return false;
    }
}
