<?php

namespace Core\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Core\AdminBundle\Entity\UsersRepository")
 */
class Users
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=64)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="secondname", type="string", length=64)
     */
    private $secondname;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="matricula", type="string", length=255)
     */
    private $matricula;

    /**
     * @var string
     *
     * @ORM\Column(name="genpass", type="string", length=255)
     */
    private $genpass;

    /**
     * @var string
     *
     * @ORM\Column(name="newpass", type="string", length=255)
     */
    private $newpass;

    /**
     * @var string
     *
     * @ORM\Column(name="newpasssecond", type="string", length=255)
     */
    private $newpasssecond;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="campus", type="string", length=255)
     */
    private $campus;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="ssid", type="string", length=100)
     */
    private $ssid;


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
     * Set firstname
     *
     * @param string $firstname
     * @return radcheck
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set secondname
     *
     * @param string $secondname
     * @return radcheck
     */
    public function setSecondname($secondname)
    {
        $this->secondname = $secondname;
    
        return $this;
    }

    /**
     * Get secondname
     *
     * @return string 
     */
    public function getSecondname()
    {
        return $this->secondname;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Users
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set matricula
     *
     * @param string $matricula
     * @return Users
     */
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
    
        return $this;
    }

    /**
     * Get matricula
     *
     * @return string 
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * Set genpass
     *
     * @param string $genpass
     * @return Users
     */
    public function setGenpass($genpass)
    {
        $this->genpass = $genpass;
    
        return $this;
    }

    /**
     * Get genpass
     *
     * @return string 
     */
    public function getGenpass()
    {
        return $this->genpass;
    }

    /**
     * Set newpass
     *
     * @param string $newpass
     * @return Users
     */
    public function setNewpass($newpass)
    {
        $this->newpass = $newpass;
    
        return $this;
    }

    /**
     * Get newpass
     *
     * @return string 
     */
    public function getNewpass()
    {
        return $this->newpass;
    }

    /**
     * Set newpasssecondf
     *
     * @param string $newpasssecond
     * @return Users
     */
    public function setNewpasssecond($newpasssecond)
    {
        $this->newpasssecond = $newpasssecond;
    
        return $this;
    }

    /**
     * Get newpasssecond
     *
     * @return string 
     */
    public function getNewpasssecond()
    {
        return $this->newpasssecond;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Users
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Users
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
     * Set campus
     *
     * @param string $campus
     * @return radcheck
     */
    public function setCampus($campus)
    {
        $this->campus = $campus;
    
        return $this;
    }

    /**
     * Get campus
     *
     * @return string 
     */
    public function getCampus()
    {
        return $this->campus;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return radcheck
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set ssid
     *
     * @param string $ssid
     * @return radcheck
     */
    public function setSsid($ssid)
    {
        $this->ssid = $ssid;
    
        return $this;
    }

    /**
     * Get ssid
     *
     * @return string 
     */
    public function getSsid()
    {
        return $this->ssid;
    }
}
