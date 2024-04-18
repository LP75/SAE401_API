<?php
// src/Entity/Employees.php
namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Entity\Stores;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass="Repository\EmployeesRepository")
 * @ORM\Table{name="employees"}
 */
class Employees implements JsonSerializable{

    /** @var int */
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private int $employee_id;

    /**
     * @ORM\ManyToOne(targetEntity=Stores::class, inversedBy="employeesStore", cascade={"persist"})
     * @ORM\JoinColumn(name="store_id", referencedColumnName="store_id", nullable=true)
     */
    private ?Stores $store;

    /** @var string */
    /**
     * @ORM\Column(type="string")
     */
    private string $employee_name;

    /**
     * @ORM\Column(type="string")
     */
    private string $employee_email;

    /**
     * @ORM\Column(type="string")
     */
    private string $employee_password;

    /**
     * @ORM\Column(type="string")
     */
    private string $employee_role;

    /**
     * Get employee_id.
     * 
     * @return int
     */
    public function getEmployee_id(){
        return $this->employee_id;
    }

    /**
     * Set employee_id.
     * 
     * @param int $employee_id
     * 
     * @return Employees
     */
    public function setEmployee_id($employee_id){
        $this->employee_id = $employee_id;
        return $this;
    }

    /**
     * Get store.
     * 
     * @return Stores
     */
    public function getStore(){
        return $this->store;
    }

    /**
     * Set store.
     * 
     * @param Stores $store
     * 
     * @return Employees
     */
    public function setStore($store){
        $this->store = $store;
        return $this;
    }

    /**
     * Get employee_name.
     * 
     * @return string
     */
    public function getEmployee_name(){
        return $this->employee_name;
    }

    /**
     * Set employee_name.
     * 
     * @param string $employee_name
     * 
     * @return Employees
     */
    public function setEmployee_name($employee_name){
        $this->employee_name = $employee_name;
        return $this;
    }

    /**
     * Get employee_email.
     * 
     * @return string
     */
    public function getEmployee_email(){
        return $this->employee_email;
    }

    /**
     * Set employee_email.
     * 
     * @param string $employee_email
     * 
     * @return Employees
     */
    public function setEmployee_email($employee_email){
        $this->employee_email = $employee_email;
        return $this;
    }

    /**
     * Get employee_password.
     * 
     * @return string
     */
    public function getEmployee_password(){
        return $this->employee_password;
    }

    /**
     * Set employee_password.
     * 
     * @param string $employee_password
     * 
     * @return Employees
     */
    public function setEmployee_password($employee_password){
        $this->employee_password = $employee_password;
        return $this;
    }

    /**
     * Get employee_role.
     * 
     * @return string
     */
    public function getEmployee_role(){
        return $this->employee_role;
    }

    /**
     * Set employee_role.
     * 
     * @param string $employee_role
     * 
     * @return Employees
     */
    public function setEmployee_role($employee_role){
        $this->employee_role = $employee_role;
        return $this;
    }

    public function __toString(){
        return $this->employee_name;
    }

    public function jsonSerialize(): mixed {
        return [
            'employee_id' => $this->employee_id,
            'store' => $this->store,
            'employee_name' => $this->employee_name,
            'employee_email' => $this->employee_email,
            'employee_password' => $this->employee_password,
            'employee_role' => $this->employee_role,
        ];
    }
}
?>
