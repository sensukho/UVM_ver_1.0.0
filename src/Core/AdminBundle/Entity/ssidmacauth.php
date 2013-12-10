<?php

namespace Core\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ssidmacauth
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Core\AdminBundle\Entity\ssidmacauthRepository")
 */
class ssidmacauth
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
     * @ORM\Column(name="username", type="string", length=20)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="macaddress", type="string", length=20)
     */
    private $macaddress;

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
     * Set username
     *
     * @param string $username
     * @return ssidmacauth
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
     * Set macaddress
     *
     * @param string $macaddress
     * @return ssidmacauth
     */
    public function setMacaddress($macaddress)
    {
        $this->macaddress = $macaddress;
    
        return $this;
    }

    /**
     * Get macaddress
     *
     * @return string 
     */
    public function getMacaddress()
    {
        return $this->macaddress;
    }

    /**
     * Set ssid
     *
     * @param string $ssid
     * @return ssidmacauth
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
