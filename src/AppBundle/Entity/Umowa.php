<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="umowy")
 */
class Umowa
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $podmiot;

    /**
     * @ORM\Column(type="string")
     */
    protected $zadanie;

    /**
     * @ORM\Column(type="string", length=7)
     */
    protected $pkd;

    /**
     * @ORM\Column(type="string")
     */
    protected $uwagi;

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
     * Set podmiot
     *
     * @param string $podmiot
     * @return Umowa
     */
    public function setPodmiot($podmiot)
    {
        $this->podmiot = $podmiot;

        return $this;
    }

    /**
     * Get podmiot
     *
     * @return string 
     */
    public function getPodmiot()
    {
        return $this->podmiot;
    }

    /**
     * Set zadanie
     *
     * @param string $zadanie
     * @return Umowa
     */
    public function setZadanie($zadanie)
    {
        $this->zadanie = $zadanie;

        return $this;
    }

    /**
     * Get zadanie
     *
     * @return string 
     */
    public function getZadanie()
    {
        return $this->zadanie;
    }

    /**
     * Set pkd
     *
     * @param string $pkd
     * @return Umowa
     */
    public function setPkd($pkd)
    {
        $this->pkd = $pkd;

        return $this;
    }

    /**
     * Get pkd
     *
     * @return string 
     */
    public function getPkd()
    {
        return $this->pkd;
    }

    /**
     * Set uwagi
     *
     * @param string $uwagi
     * @return Umowa
     */
    public function setUwagi($uwagi)
    {
        $this->uwagi = $uwagi;

        return $this;
    }

    /**
     * Get uwagi
     *
     * @return string 
     */
    public function getUwagi()
    {
        return $this->uwagi;
    }
}
