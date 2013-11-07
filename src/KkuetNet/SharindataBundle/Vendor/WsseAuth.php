<?php

namespace KkuetNet\SharindataBundle\Vendor;

class WsseAuth{
    
    private $username;
    
    private $password;
    
    private $url;
    
    public function __construct($username, $password, $url) {
        $this->username = $username;
        $this->password = $password;
        $this->url      = $url;
    }
}
?>
