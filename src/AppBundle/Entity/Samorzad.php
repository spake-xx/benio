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
 * @ORM\Table(name="samorzad")
 */
class Samorzad
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\kod
     */
    protected $kod;

    /**
     * @ORM\Column(type="integer", length=7)
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
}
