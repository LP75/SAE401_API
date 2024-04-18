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
 * Represents a store entity.
 *
 * @ORM\Entity
 * @ORM\Table{name="stores"}
 */
class Stores implements JsonSerializable{

    /** @var int The unique identifier for the store. */
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private int $store_id;

    /** @var string The name of the store. */
    /**
     * @ORM\Column(type="string")
     */
    private string $store_name;

    /** @var string|null The phone number of the store. */
    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private ?string $phone;

    /** @var string|null The email address of the store. */
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $email;

    /** @var string|null The street address of the store. */
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $street;

    /** @var string|null The city of the store. */
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $city;

    /** @var string|null The state of the store. */
    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private ?string $state;

    /** @var string|null The ZIP code of the store. */
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private ?string $zip_code;

    /** @var \Doctrine\Common\Collections\Collection */
    /**
     * @ORM\OneToMany(targetEntity=Stocks::class, mappedBy="store")
     */
    private Collection $stocksStore;

    /** @var \Doctrine\Common\Collections\Collection */
    /**
     * @ORM\OneToMany(targetEntity=Employees::class, mappedBy="store")
     */
    private Collection $employeesStore;

    /**
     * Get store_id
     * 
     * @return int The store ID.
     */
    public function getStore_id(){
        return $this->store_id;
    }

    /**
     * Set store_id.
     * 
     * @param int $store_id The store ID to set.
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
     * @return string The name of the store.
     */
    public function getStore_name(){
        return $this->store_name;
    }

    /**
     * Set store_name.
     * 
     * @param string $store_name The name of the store to set.
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
     * @return string|null The phone number of the store.
     */
    public function getPhone(){
        return $this->phone;
    }

    /**
     * Set phone.
     * 
     * @param string|null $phone The phone number of the store to set.
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
     * @return string|null The email address of the store.
     */
    public function getEmail(){
        return $this->email;
    }

    /**
     * Set email.
     * 
     * @param string|null $email The email address of the store to set.
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
     * @return string|null The street address of the store.
     */
    public function getStreet(){
        return $this->street;
    }

    /**
     * Set street.
     * 
     * @param string|null $street The street address of the store to set.
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
     * @return string|null The city of the store.
     */
    public function getCity(){
        return $this->city;
    }

    /**
     * Set city.
     * 
     * @param string|null $city The city of the store to set.
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
     * @return string|null The state of the store.
     */
    public function getState(){
        return $this->state;
    }

    /**
     * Set state.
     * 
     * @param string|null $state The state of the store to set.
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
     * @return string|null The ZIP code of the store.
     */
    public function getZip_code(){
        return $this->zip_code;
    }

    /**
     * Set zip_code.
     * 
     * @param string|null $zip_code The ZIP code of the store to set.
     * 
     * @return Stores
     */
    public function setZip_code($zip_code){
        $this->zip_code=$zip_code;
        return $this;
    }

    /**
     * Returns the string representation of the store.
     * 
     * @return string The name of the store.
     */
    public function __toString(){
        return $this->store_name;
    }

    /**
     * Specify data which should be serialized to JSON.
     * 
     * @return array Serialized data.
     */
    public function jsonSerialize() {
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
