<?php
// src/Entity/Stores.php
namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Entity\Stocks;
use Entity\Employees;
use JsonSerializable;

/**
 * @ORM\Entity
 * @ORM\Table{name="stores"}
 */
class Stores implements JsonSerializable{

    /** @var int */
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private int $store_id;

    /** @var string */
    /**
     * @ORM\Column(type="string")
     */
    private string $store_name;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private ?string $phone;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $email;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $street;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $city;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private ?string $state;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private ?string $zip_code;

    /** @var \Doctrine\Common\Collections\Collection */
    /**
     * @ORM\OneToMany(targetEntity=Stocks::class, mappedBy="store")
     */
    private Collection $stocksStore;

    /**
     * @ORM\OneToMany(targetEntity=Employees::class, mappedBy="store")
     */
    private Collection $employeesStore;

    /**
     * Get store_id
     * 
     * @return int
     */
    public function getStore_id(){
        return $this->store_id;
    }

    /**
     * Set store_id.
     * 
     * @param int $store_id
     * 
     * @return Stores
     */
    public function setStore_id($store_id){
        $this->store_id=$store_id;
        return $this;
    }
    
    /**
     * Get store_name.
     * 
     * @return string
     */
    public function getStore_name(){
        return $this->store_name;
    }

    /**
     * Set store_name.
     * 
     * @param string $store_name
     * 
     * @return Stores
     */
    public function setStore_name($store_name){
        $this->store_name=$store_name;
        return $this;
    }

    /**
     * Get phone.
     * 
     * @return string
     */
    public function getPhone(){
        return $this->phone;
    }

    /**
     * Set phone.
     * 
     * @param string $phone
     * 
     * @return Stores
     */
    public function setPhone($phone){
        $this->phone=$phone;
        return $this;
    }

    /**
     * Get email.
     * 
     * @return string
     */
    public function getEmail(){
        return $this->email;
    }

    /**
     * Set email.
     * 
     * @param string $email
     * 
     * @return Stores
     */
    public function setEmail($email){
        $this->email=$email;
        return $this;
    }

    /**
     * Get street.
     * 
     * @return string
     */
    public function getStreet(){
        return $this->street;
    }

    /**
     * Set street.
     * 
     * @param string $street
     * 
     * @return Stores
     */
    public function setStreet($street){
        $this->street=$street;
        return $this;
    }

    /**
     * Get city.
     * 
     * @return string
     */
    public function getCity(){
        return $this->city;
    }

    /**
     * Set city.
     * 
     * @param string $city
     * 
     * @return Stores
     */
    public function setCity($city){
        $this->city=$city;
        return $this;
    }

    /**
     * Get state.
     * 
     * @return string
     */
    public function getState(){
        return $this->state;
    }

    /**
     * Set state.
     * 
     * @param string $state
     * 
     * @return Stores
     */
    public function setState($state){
        $this->state=$state;
        return $this;
    }

    /**
     * Get zip_code.
     * 
     * @return string
     */
    public function getZip_code(){
        return $this->zip_code;
    }

    /**
     * Set zip_code.
     * 
     * @param string $zip_code
     * 
     * @return Stores
     */
    public function setZip_code($zip_code){
        $this->zip_code=$zip_code;
        return $this;
    }

    public function __toString(){
        return $this->store_name;
    }

    public function jsonSerialize(): mixed {
        return [
            'store_id' => $this->store_id,
            'store_name' => $this->store_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'street' => $this->street,
            'city' => $this->city,
            'state' => $this->state,
            'zip_code' => $this->zip_code,
        ];
    }
}
?>