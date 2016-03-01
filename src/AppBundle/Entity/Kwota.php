<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="kwoty")
 */
class Kwota
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Umowa")
     * @ORM\JoinColumn(name="umowa", referencedColumnName="id")
     */
    protected $umowa;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $cel;

    /**
     * @ORM\Column(type="float")
     */
    protected $kwota;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set cel
     *
     * @param string $cel
     * @return Kwota
     */
    public function setCel($cel)
    {
        $this->cel = $cel;

        return $this;
    }

    /**
     * Get cel
     *
     * @return string 
     */
    public function getCel()
    {
        return $this->cel;
    }

    /**
     * Set kwota
     *
     * @param float $kwota
     * @return Kwota
     */
    public function setKwota($kwota)
    {
        $this->kwota = $kwota;

        return $this;
    }

    /**
     * Get kwota
     *
     * @return float 
     */
    public function getKwota()
    {
        return $this->kwota;
    }

    /**
     * Set umowa
     *
     * @param \AppBundle\Entity\Umowa $umowa
     * @return Kwota
     */
    public function setUmowa(\AppBundle\Entity\Umowa $umowa = null)
    {
        $this->umowa = $umowa;

        return $this;
    }

    /**
     * Get umowa
     *
     * @return \AppBundle\Entity\Umowa 
     */
    public function getUmowa()
    {
        return $this->umowa;
    }
}
