<?php

namespace Core\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * radacct
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Core\AdminBundle\Entity\radacctRepository")
 */
class radacct
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
     * @ORM\Column(name="acctsessionid", type="string", length=64)
     */
    private $acctsessionid;

    /**
     * @var string
     *
     * @ORM\Column(name="acctuniqueid", type="string", length=32)
     */
    private $acctuniqueid;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=64)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="groupname", type="string", length=64)
     */
    private $groupname;

    /**
     * @var string
     *
     * @ORM\Column(name="realm", type="string", length=64)
     */
    private $realm;

    /**
     * @var string
     *
     * @ORM\Column(name="nasipaddress", type="string", length=15)
     */
    private $nasipaddress;

    /**
     * @var string
     *
     * @ORM\Column(name="nasportid", type="string", length=15)
     */
    private $nasportid;

    /**
     * @var string
     *
     * @ORM\Column(name="nasporttype", type="string", length=32)
     */
    private $nasporttype;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="acctstarttime", type="datetime")
     */
    private $acctstarttime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="acctstoptime", type="datetime")
     */
    private $acctstoptime;

    /**
     * @var integer
     *
     * @ORM\Column(name="acctsessiontime", type="integer")
     */
    private $acctsessiontime;

    /**
     * @var string
     *
     * @ORM\Column(name="acctauthentic", type="string", length=32)
     */
    private $acctauthentic;

    /**
     * @var string
     *
     * @ORM\Column(name="connectinfo_start", type="string", length=50)
     */
    private $connectinfoStart;

    /**
     * @var string
     *
     * @ORM\Column(name="connectinfo_stop", type="string", length=50)
     */
    private $connectinfoStop;

    /**
     * @var integer
     *
     * @ORM\Column(name="acctinputoctets", type="bigint")
     */
    private $acctinputoctets;

    /**
     * @var integer
     *
     * @ORM\Column(name="acctoutputoctets", type="bigint")
     */
    private $acctoutputoctets;

    /**
     * @var string
     *
     * @ORM\Column(name="calledstationid", type="string", length=50)
     */
    private $calledstationid;

    /**
     * @var string
     *
     * @ORM\Column(name="callingstationid", type="string", length=50)
     */
    private $callingstationid;

    /**
     * @var string
     *
     * @ORM\Column(name="acctterminatecause", type="string", length=32)
     */
    private $acctterminatecause;

    /**
     * @var string
     *
     * @ORM\Column(name="servicetype", type="string", length=32)
     */
    private $servicetype;

    /**
     * @var string
     *
     * @ORM\Column(name="framedprotocol", type="string", length=32)
     */
    private $framedprotocol;

    /**
     * @var string
     *
     * @ORM\Column(name="framedipaddress", type="string", length=15)
     */
    private $framedipaddress;

    /**
     * @var integer
     *
     * @ORM\Column(name="acctstartdelay", type="integer")
     */
    private $acctstartdelay;

    /**
     * @var integer
     *
     * @ORM\Column(name="acctstopdelay", type="integer")
     */
    private $acctstopdelay;

    /**
     * @var string
     *
     * @ORM\Column(name="xascendsessionsvrkey", type="string", length=10)
     */
    private $xascendsessionsvrkey;


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
     * Set acctsessionid
     *
     * @param string $acctsessionid
     * @return radacct
     */
    public function setAcctsessionid($acctsessionid)
    {
        $this->acctsessionid = $acctsessionid;
    
        return $this;
    }

    /**
     * Get acctsessionid
     *
     * @return string 
     */
    public function getAcctsessionid()
    {
        return $this->acctsessionid;
    }

    /**
     * Set acctuniqueid
     *
     * @param string $acctuniqueid
     * @return radacct
     */
    public function setAcctuniqueid($acctuniqueid)
    {
        $this->acctuniqueid = $acctuniqueid;
    
        return $this;
    }

    /**
     * Get acctuniqueid
     *
     * @return string 
     */
    public function getAcctuniqueid()
    {
        return $this->acctuniqueid;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return radacct
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
     * Set groupname
     *
     * @param string $groupname
     * @return radacct
     */
    public function setGroupname($groupname)
    {
        $this->groupname = $groupname;
    
        return $this;
    }

    /**
     * Get groupname
     *
     * @return string 
     */
    public function getGroupname()
    {
        return $this->groupname;
    }

    /**
     * Set realm
     *
     * @param string $realm
     * @return radacct
     */
    public function setRealm($realm)
    {
        $this->realm = $realm;
    
        return $this;
    }

    /**
     * Get realm
     *
     * @return string 
     */
    public function getRealm()
    {
        return $this->realm;
    }

    /**
     * Set nasipaddress
     *
     * @param string $nasipaddress
     * @return radacct
     */
    public function setNasipaddress($nasipaddress)
    {
        $this->nasipaddress = $nasipaddress;
    
        return $this;
    }

    /**
     * Get nasipaddress
     *
     * @return string 
     */
    public function getNasipaddress()
    {
        return $this->nasipaddress;
    }

    /**
     * Set nasportid
     *
     * @param string $nasportid
     * @return radacct
     */
    public function setNasportid($nasportid)
    {
        $this->nasportid = $nasportid;
    
        return $this;
    }

    /**
     * Get nasportid
     *
     * @return string 
     */
    public function getNasportid()
    {
        return $this->nasportid;
    }

    /**
     * Set nasporttype
     *
     * @param string $nasporttype
     * @return radacct
     */
    public function setNasporttype($nasporttype)
    {
        $this->nasporttype = $nasporttype;
    
        return $this;
    }

    /**
     * Get nasporttype
     *
     * @return string 
     */
    public function getNasporttype()
    {
        return $this->nasporttype;
    }

    /**
     * Set acctstarttime
     *
     * @param \DateTime $acctstarttime
     * @return radacct
     */
    public function setAcctstarttime($acctstarttime)
    {
        $this->acctstarttime = $acctstarttime;
    
        return $this;
    }

    /**
     * Get acctstarttime
     *
     * @return \DateTime 
     */
    public function getAcctstarttime()
    {
        return $this->acctstarttime;
    }

    /**
     * Set acctstoptime
     *
     * @param \DateTime $acctstoptime
     * @return radacct
     */
    public function setAcctstoptime($acctstoptime)
    {
        $this->acctstoptime = $acctstoptime;
    
        return $this;
    }

    /**
     * Get acctstoptime
     *
     * @return \DateTime 
     */
    public function getAcctstoptime()
    {
        return $this->acctstoptime;
    }

    /**
     * Set acctsessiontime
     *
     * @param integer $acctsessiontime
     * @return radacct
     */
    public function setAcctsessiontime($acctsessiontime)
    {
        $this->acctsessiontime = $acctsessiontime;
    
        return $this;
    }

    /**
     * Get acctsessiontime
     *
     * @return integer 
     */
    public function getAcctsessiontime()
    {
        return $this->acctsessiontime;
    }

    /**
     * Set acctauthentic
     *
     * @param string $acctauthentic
     * @return radacct
     */
    public function setAcctauthentic($acctauthentic)
    {
        $this->acctauthentic = $acctauthentic;
    
        return $this;
    }

    /**
     * Get acctauthentic
     *
     * @return string 
     */
    public function getAcctauthentic()
    {
        return $this->acctauthentic;
    }

    /**
     * Set connectinfoStart
     *
     * @param string $connectinfoStart
     * @return radacct
     */
    public function setConnectinfoStart($connectinfoStart)
    {
        $this->connectinfoStart = $connectinfoStart;
    
        return $this;
    }

    /**
     * Get connectinfoStart
     *
     * @return string 
     */
    public function getConnectinfoStart()
    {
        return $this->connectinfoStart;
    }

    /**
     * Set connectinfoStop
     *
     * @param string $connectinfoStop
     * @return radacct
     */
    public function setConnectinfoStop($connectinfoStop)
    {
        $this->connectinfoStop = $connectinfoStop;
    
        return $this;
    }

    /**
     * Get connectinfoStop
     *
     * @return string 
     */
    public function getConnectinfoStop()
    {
        return $this->connectinfoStop;
    }

    /**
     * Set acctinputoctets
     *
     * @param integer $acctinputoctets
     * @return radacct
     */
    public function setAcctinputoctets($acctinputoctets)
    {
        $this->acctinputoctets = $acctinputoctets;
    
        return $this;
    }

    /**
     * Get acctinputoctets
     *
     * @return integer 
     */
    public function getAcctinputoctets()
    {
        return $this->acctinputoctets;
    }

    /**
     * Set acctoutputoctets
     *
     * @param integer $acctoutputoctets
     * @return radacct
     */
    public function setAcctoutputoctets($acctoutputoctets)
    {
        $this->acctoutputoctets = $acctoutputoctets;
    
        return $this;
    }

    /**
     * Get acctoutputoctets
     *
     * @return integer 
     */
    public function getAcctoutputoctets()
    {
        return $this->acctoutputoctets;
    }

    /**
     * Set calledstationid
     *
     * @param string $calledstationid
     * @return radacct
     */
    public function setCalledstationid($calledstationid)
    {
        $this->calledstationid = $calledstationid;
    
        return $this;
    }

    /**
     * Get calledstationid
     *
     * @return string 
     */
    public function getCalledstationid()
    {
        return $this->calledstationid;
    }

    /**
     * Set callingstationid
     *
     * @param string $callingstationid
     * @return radacct
     */
    public function setCallingstationid($callingstationid)
    {
        $this->callingstationid = $callingstationid;
    
        return $this;
    }

    /**
     * Get callingstationid
     *
     * @return string 
     */
    public function getCallingstationid()
    {
        return $this->callingstationid;
    }

    /**
     * Set acctterminatecause
     *
     * @param string $acctterminatecause
     * @return radacct
     */
    public function setAcctterminatecause($acctterminatecause)
    {
        $this->acctterminatecause = $acctterminatecause;
    
        return $this;
    }

    /**
     * Get acctterminatecause
     *
     * @return string 
     */
    public function getAcctterminatecause()
    {
        return $this->acctterminatecause;
    }

    /**
     * Set servicetype
     *
     * @param string $servicetype
     * @return radacct
     */
    public function setServicetype($servicetype)
    {
        $this->servicetype = $servicetype;
    
        return $this;
    }

    /**
     * Get servicetype
     *
     * @return string 
     */
    public function getServicetype()
    {
        return $this->servicetype;
    }

    /**
     * Set framedprotocol
     *
     * @param string $framedprotocol
     * @return radacct
     */
    public function setFramedprotocol($framedprotocol)
    {
        $this->framedprotocol = $framedprotocol;
    
        return $this;
    }

    /**
     * Get framedprotocol
     *
     * @return string 
     */
    public function getFramedprotocol()
    {
        return $this->framedprotocol;
    }

    /**
     * Set framedipaddress
     *
     * @param string $framedipaddress
     * @return radacct
     */
    public function setFramedipaddress($framedipaddress)
    {
        $this->framedipaddress = $framedipaddress;
    
        return $this;
    }

    /**
     * Get framedipaddress
     *
     * @return string 
     */
    public function getFramedipaddress()
    {
        return $this->framedipaddress;
    }

    /**
     * Set acctstartdelay
     *
     * @param integer $acctstartdelay
     * @return radacct
     */
    public function setAcctstartdelay($acctstartdelay)
    {
        $this->acctstartdelay = $acctstartdelay;
    
        return $this;
    }

    /**
     * Get acctstartdelay
     *
     * @return integer 
     */
    public function getAcctstartdelay()
    {
        return $this->acctstartdelay;
    }

    /**
     * Set acctstopdelay
     *
     * @param integer $acctstopdelay
     * @return radacct
     */
    public function setAcctstopdelay($acctstopdelay)
    {
        $this->acctstopdelay = $acctstopdelay;
    
        return $this;
    }

    /**
     * Get acctstopdelay
     *
     * @return integer 
     */
    public function getAcctstopdelay()
    {
        return $this->acctstopdelay;
    }

    /**
     * Set xascendsessionsvrkey
     *
     * @param string $xascendsessionsvrkey
     * @return radacct
     */
    public function setXascendsessionsvrkey($xascendsessionsvrkey)
    {
        $this->xascendsessionsvrkey = $xascendsessionsvrkey;
    
        return $this;
    }

    /**
     * Get xascendsessionsvrkey
     *
     * @return string 
     */
    public function getXascendsessionsvrkey()
    {
        return $this->xascendsessionsvrkey;
    }
}
