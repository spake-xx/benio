<?php
/**
 * Created by PhpStorm.
 * User: r
 * Date: 02.03.16
 * Time: 09:39
 */
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="samorzady")
 */
class Samorzad
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     */
    protected $kod;

    /**
     * @ORM\Column(type="string")
     */
    protected $samorzad;

    /**
     * @ORM\Column(type="string")
     */
    protected $wojewodztwo;

    /**
     * @ORM\Column(type="string")
     */
    protected $powiat;

    /**
     * @ORM\Column(type="string")
     */
    protected $typ;
    /**
     * @ORM\Column(type="string")
     */
    protected $urzad;
    /**
     * @ORM\Column(type="string")
     */
    protected $miejscowosc;
    /**
     * @ORM\Column(type="string")
     */
    protected $kod_pocztowy;
    /**
     * @ORM\Column(type="string")
     */
    protected $poczta;
    /**
     * @ORM\Column(type="string")
     */
    protected $ulica;
    /**
     * @ORM\Column(type="string")
     */
    protected $nr_domu;
    /**
     * @ORM\Column(type="string")
     */
    protected $telefon_kierunkowy;
    /**
     * @ORM\Column(type="string")
     */
    protected $telefon;
    /**
     * @ORM\Column(type="string")
     */
    protected $telefon_wewnetrzny;
    /**
     * @ORM\Column(type="string")
     */
    protected $fax_kierunkowy;
    /**
     * @ORM\Column(type="string")
     */
    protected $fax;
    /**
     * @ORM\Column(type="string")
     */
    protected $stanowisko;
    /**
     * @ORM\Column(type="string")
     */
    protected $imie;
    /**
     * @ORM\Column(type="string")
     */
    protected $nazwisko;
    /**
     * @ORM\Column(type="string")
     */
    protected $email;
    /**
     * @ORM\Column(type="string")
     */
    protected $email_ogolny;
    /**
     * @ORM\Column(type="string")
     */
    protected $www;
    /**
     * @ORM\Column(type="string")
     */

    /**
     * Set kod
     *
     * @param integer $kod
     * @return Samorzad
     */
    public function setKod($kod)
    {
        $this->kod = $kod;

        return $this;
    }

    /**
     * Get kod
     *
     * @return integer 
     */
    public function getKod()
    {
        return $this->kod;
    }

    /**
     * Set samorzad
     *
     * @param integer $samorzad
     * @return Samorzad
     */
    public function setSamorzad($samorzad)
    {
        $this->samorzad = $samorzad;

        return $this;
    }

    /**
     * Get samorzad
     *
     * @return integer 
     */
    public function getSamorzad()
    {
        return $this->samorzad;
    }

    /**
     * Set wojewodztwo
     *
     * @param string $wojewodztwo
     * @return Samorzad
     */
    public function setWojewodztwo($wojewodztwo)
    {
        $this->wojewodztwo = $wojewodztwo;

        return $this;
    }

    /**
     * Get wojewodztwo
     *
     * @return string 
     */
    public function getWojewodztwo()
    {
        return $this->wojewodztwo;
    }

    /**
     * Set powiat
     *
     * @param string $powiat
     * @return Samorzad
     */
    public function setPowiat($powiat)
    {
        $this->powiat = $powiat;

        return $this;
    }

    /**
     * Get powiat
     *
     * @return string 
     */
    public function getPowiat()
    {
        return $this->powiat;
    }

    /**
     * Set typ
     *
     * @param string $typ
     * @return Samorzad
     */
    public function setTyp($typ)
    {
        $this->typ = $typ;

        return $this;
    }

    /**
     * Get typ
     *
     * @return string 
     */
    public function getTyp()
    {
        return $this->typ;
    }

    /**
     * Set urzad
     *
     * @param string $urzad
     * @return Samorzad
     */
    public function setUrzad($urzad)
    {
        $this->urzad = $urzad;

        return $this;
    }

    /**
     * Get urzad
     *
     * @return string 
     */
    public function getUrzad()
    {
        return $this->urzad;
    }

    /**
     * Set miejscowosc
     *
     * @param string $miejscowosc
     * @return Samorzad
     */
    public function setMiejscowosc($miejscowosc)
    {
        $this->miejscowosc = $miejscowosc;

        return $this;
    }

    /**
     * Get miejscowosc
     *
     * @return string 
     */
    public function getMiejscowosc()
    {
        return $this->miejscowosc;
    }

    /**
     * Set kod_pocztowy
     *
     * @param string $kodPocztowy
     * @return Samorzad
     */
    public function setKodPocztowy($kodPocztowy)
    {
        $this->kod_pocztowy = $kodPocztowy;

        return $this;
    }

    /**
     * Get kod_pocztowy
     *
     * @return string 
     */
    public function getKodPocztowy()
    {
        return $this->kod_pocztowy;
    }

    /**
     * Set poczta
     *
     * @param string $poczta
     * @return Samorzad
     */
    public function setPoczta($poczta)
    {
        $this->poczta = $poczta;

        return $this;
    }

    /**
     * Get poczta
     *
     * @return string 
     */
    public function getPoczta()
    {
        return $this->poczta;
    }

    /**
     * Set ulica
     *
     * @param string $ulica
     * @return Samorzad
     */
    public function setUlica($ulica)
    {
        $this->ulica = $ulica;

        return $this;
    }

    /**
     * Get ulica
     *
     * @return string 
     */
    public function getUlica()
    {
        return $this->ulica;
    }

    /**
     * Set nr_domu
     *
     * @param string $nrDomu
     * @return Samorzad
     */
    public function setNrDomu($nrDomu)
    {
        $this->nr_domu = $nrDomu;

        return $this;
    }

    /**
     * Get nr_domu
     *
     * @return string 
     */
    public function getNrDomu()
    {
        return $this->nr_domu;
    }

    /**
     * Set telefon_kierunkowy
     *
     * @param string $telefonKierunkowy
     * @return Samorzad
     */
    public function setTelefonKierunkowy($telefonKierunkowy)
    {
        $this->telefon_kierunkowy = $telefonKierunkowy;

        return $this;
    }

    /**
     * Get telefon_kierunkowy
     *
     * @return string 
     */
    public function getTelefonKierunkowy()
    {
        return $this->telefon_kierunkowy;
    }

    /**
     * Set telefon
     *
     * @param string $telefon
     * @return Samorzad
     */
    public function setTelefon($telefon)
    {
        $this->telefon = $telefon;

        return $this;
    }

    /**
     * Get telefon
     *
     * @return string 
     */
    public function getTelefon()
    {
        return $this->telefon;
    }

    /**
     * Set telefon_wewnetrzny
     *
     * @param string $telefonWewnetrzny
     * @return Samorzad
     */
    public function setTelefonWewnetrzny($telefonWewnetrzny)
    {
        $this->telefon_wewnetrzny = $telefonWewnetrzny;

        return $this;
    }

    /**
     * Get telefon_wewnetrzny
     *
     * @return string 
     */
    public function getTelefonWewnetrzny()
    {
        return $this->telefon_wewnetrzny;
    }

    /**
     * Set fax_kierunkowy
     *
     * @param string $faxKierunkowy
     * @return Samorzad
     */
    public function setFaxKierunkowy($faxKierunkowy)
    {
        $this->fax_kierunkowy = $faxKierunkowy;

        return $this;
    }

    /**
     * Get fax_kierunkowy
     *
     * @return string 
     */
    public function getFaxKierunkowy()
    {
        return $this->fax_kierunkowy;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return Samorzad
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set stanowisko
     *
     * @param string $stanowisko
     * @return Samorzad
     */
    public function setStanowisko($stanowisko)
    {
        $this->stanowisko = $stanowisko;

        return $this;
    }

    /**
     * Get stanowisko
     *
     * @return string 
     */
    public function getStanowisko()
    {
        return $this->stanowisko;
    }

    /**
     * Set imie
     *
     * @param string $imie
     * @return Samorzad
     */
    public function setImie($imie)
    {
        $this->imie = $imie;

        return $this;
    }

    /**
     * Get imie
     *
     * @return string 
     */
    public function getImie()
    {
        return $this->imie;
    }

    /**
     * Set nazwisko
     *
     * @param string $nazwisko
     * @return Samorzad
     */
    public function setNazwisko($nazwisko)
    {
        $this->nazwisko = $nazwisko;

        return $this;
    }

    /**
     * Get nazwisko
     *
     * @return string 
     */
    public function getNazwisko()
    {
        return $this->nazwisko;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Samorzad
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email_ogolny
     *
     * @param string $emailOgolny
     * @return Samorzad
     */
    public function setEmailOgolny($emailOgolny)
    {
        $this->email_ogolny = $emailOgolny;

        return $this;
    }

    /**
     * Get email_ogolny
     *
     * @return string 
     */
    public function getEmailOgolny()
    {
        return $this->email_ogolny;
    }

    /**
     * Set www
     *
     * @param string $www
     * @return Samorzad
     */
    public function setWww($www)
    {
        $this->www = $www;

        return $this;
    }

    /**
     * Get www
     *
     * @return string 
     */
    public function getWww()
    {
        return $this->www;
    }
}
