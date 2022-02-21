<?php


namespace App\Subscribers;

use App\Entity\Reclamation;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\Security\Core\Security;


class ReclamationSubscriber implements EventSubscriberInterface {


      /*
       * @var Security
       */
       private $security;

      public function __construct(Security $security) {
          $this->security = $security;
      }


      public static function getSubscribedEvents() {
        return [
            BeforeEntityPersistedEvent::class => ['setUser']
        ];
      }

      public function setUser(BeforeEntityPersistedEvent $event) {
        $entity = $event->getEntityInstance();
        if ($entity instanceof Reclamation) {
            $entity->setUser($this->security->getUser());
        }
      }
}
