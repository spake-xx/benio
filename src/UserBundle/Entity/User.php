<?php
namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Samorzad")
     * @ORM\JoinColumn(name="samorzad", referencedColumnName="kod", nullable=true)
     */
    protected $samorzad;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set samorzad
     *
     * @param \UserBundle\Entity\AppBundle:Samorzad $samorzad
     * @return User
     */
    public function setSamorzad(\AppBundle\Entity\Samorzad $samorzad = null)
    {
        $this->samorzad = $samorzad;

        return $this;
    }

    /**
     * Get samorzad
     *
     * @return \AppBundle\Entity\Samorzad
     */
    public function getSamorzad()
    {
        return $this->samorzad;
    }
}
