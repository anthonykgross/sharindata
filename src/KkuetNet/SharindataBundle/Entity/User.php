<?php
namespace KkuetNet\SharindataBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="User" ,uniqueConstraints={@ORM\UniqueConstraint(name="idxUnique", columns={"api_key"})})
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
     * @var string
     *
     * @ORM\Column(name="api_key", type="string", length=20, nullable=true)
     */
    private $api_key;
    
    /**
     * @var string
     *
     * @ORM\Column(name="api_secret", type="string", length=20, nullable=true)
     */
    private $api_secret;
    
    /**
     * @var string
     *
     * @ORM\Column(name="hash_key", type="string", length=20, nullable=true)
     */
    private $hash_key;
    
    
    public function __construct()
    {
        parent::__construct();
    }
    
    
    public function setEmail($email) {
        parent::setUsername($email);
        parent::setEmail($email);
    }

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
     * Set api_key
     *
     * @param string $apiKey
     * @return User
     */
    public function setApiKey($apiKey)
    {
        $this->api_key = $apiKey;
    
        return $this;
    }

    /**
     * Get api_key
     *
     * @return string 
     */
    public function getApiKey()
    {
        return $this->api_key;
    }

    /**
     * Set hash_key
     *
     * @param string $hashKey
     * @return User
     */
    public function setHashKey($hashKey)
    {
        $this->hash_key = $hashKey;
    
        return $this;
    }

    /**
     * Get hash_key
     *
     * @return string 
     */
    public function getHashKey()
    {
        return $this->hash_key;
    }

    /**
     * Set api_secret
     *
     * @param string $apiSecret
     * @return User
     */
    public function setApiSecret($apiSecret)
    {
        $this->api_secret = $apiSecret;
    
        return $this;
    }

    /**
     * Get api_secret
     *
     * @return string 
     */
    public function getApiSecret()
    {
        return $this->api_secret;
    }
}