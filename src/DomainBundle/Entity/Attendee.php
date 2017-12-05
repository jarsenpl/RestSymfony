<?php

namespace DomainBundle\Entity;

use DateTime;
use JMS\Serializer\Annotation\{
    AccessorOrder, ExclusionPolicy, Expose, SerializedName, Type
};

/**
 * Attendee
 *
 * @ExclusionPolicy("all")
 * @AccessorOrder("custom", custom = {"id", "email"})
 */
class Attendee
{
    /**
     * @var int
     *
     * @Expose
     * @Type("int")
     * @SerializedName("id")
     */
    private $id;

    /**
     * @var string
     *
     * @Expose
     */
    private $name;

    /**
     * @var string
     *
     * @Expose
     */
    private $email;

    /**
     * @var DateTime
     *
     * @Expose
     * @Type("DateTime<'Y-m-d H:i:s'>")
     */
    private $createdAt;

    /**
     * @var DateTime
     */
    private $modifiedAt;


    /**
     * Get id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Attendee
     */
    public function setName($name): Attendee
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Attendee
     */
    public function setEmail($email): Attendee
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Get createdAt
     *
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * Get modifiedAt
     *
     * @return DateTime
     */
    public function getModifiedAt(): DateTime
    {
        return $this->modifiedAt;
    }

    public function setCreatedAtValue(): void
    {
        $this->createdAt = new DateTime();
    }

    public function setModifiedAtValue(): void
    {
        $this->modifiedAt = new DateTime();
    }
}

