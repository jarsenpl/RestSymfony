<?php

namespace DomainBundle\Repository;

use Doctrine\ORM\EntityRepository;
use DomainBundle\Entity\Attendee;

/**
 * AttendeeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AttendeeRepository extends EntityRepository
{
    public function save(Attendee $attendee)
    {
        $this->_em->persist($attendee);
        $this->_em->flush();

        return $attendee;
    }

    public function merge(Attendee $attendee)
    {
        $this->_em->merge($attendee);
        $this->_em->flush();

        return $attendee;
    }

    public function remove($attendee)
    {
        $this->_em->remove($attendee);
        $this->_em->flush();
    }
}
