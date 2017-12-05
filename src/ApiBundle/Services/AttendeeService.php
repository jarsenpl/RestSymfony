<?php

namespace ApiBundle\Services;

use DomainBundle\Entity\Attendee;
use DomainBundle\Repository\AttendeeRepository;

class AttendeeService
{
    /**
     * @var AttendeeRepository
     */
    private $attendeeRepository;

    /**
     * AttendeeService constructor.
     *
     * @param $attendeeRepository
     */
    public function __construct($attendeeRepository)
    {
        $this->attendeeRepository = $attendeeRepository;
    }

    public function save(Attendee $attendee)
    {
        return $this->attendeeRepository->save($attendee);
    }

    public function merge(Attendee $attendee, Attendee $newAttendee)
    {
        $attendee->setEmail($newAttendee->getEmail());
        $attendee->setName($newAttendee->getName());

        return $this->attendeeRepository->merge($attendee);
    }

    public function remove(Attendee $attendee)
    {
        return $this->attendeeRepository->remove($attendee);
    }
}
