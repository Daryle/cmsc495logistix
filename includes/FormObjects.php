<?php

// Class to construct Students with getters/setter
class userClass
{
    // property declaration
    private $firstname="";
    private $lastname="";
    private $email="";
    private $username="";
    private $password="";
   
    // Constructor
    public function __construct($firstname,$lastname,$username,$email,$password)
    {
      $this->firstname = $firstname;
      $this->lastname = $lastname;
      $this->username = $username;
      $this->email = $email;
      $this->password = $password;      
    }
    
    // Get methods 
	  public function getFirstname ()
    {
    	return $this->firstname;
    } 
	  public function getLastname ()
    {
    	return $this->lastname;
    } 
        public function getUsername ()
        {
            return $this->username;
        }
	  public function getEmail ()
    {
    	return $this->email;
    } 
	  public function getPassword ()
    {
    	return $this->password;
    } 
	  

    // Set methods 
    public function setFirstname ($value)
    {
    	$this->firstname = $value;    	
    }
    public function setLastname ($value)
    {
    	$this->lastname = $value;    	
    }
    public function setUsername ($value)
    {
        $this->username = $value;
    }
    public function setEmail ($value)
    {
    	$this->email = $value;    	
    }
    public function setPassword ($value)
    {
    	$this->password = $value;    	
    }     
    
} // End userClass
