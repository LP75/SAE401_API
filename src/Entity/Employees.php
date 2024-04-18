<?php
// src/Entity/Employees.php
namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Entity\Stores;
use JsonSerializable;

/**
 * Represents an employee entity.
 *
 * @ORM\Entity(repositoryClass="Repository\EmployeesRepository")
 * @ORM\Table{name="employees"}
 */
class Employees implements JsonSerializable{

    /** @var int The unique identifier for the employee. */
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

    /** @var string The name of the employee. */
    /**
     * @ORM\Column(type="string")
     */
    private string $employee_name;

    /** @var string The email of the employee. */
    /**
     * @ORM\Column(type="string")
     */
    private string $employee_email;

    /** @var string The password of the employee. */
    /**
     * @ORM\Column(type="string")
     */
    private string $employee_password;

    /** @var string The role of the employee. */
    /**
     * @ORM\Column(type="string")
     */
    private string $employee_role;

    /**
     * Get employee_id.
     * 
     * @return int The employee ID.
     */
    public function getEmployee_id(){
        return $this->employee_id;
    }

    /**
     * Set employee_id.
     * 
     * @param int $employee_id The employee ID to set.
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
     * @return Stores The store associated with the employee.
     */
    public function getStore(){
        return $this->store;
    }

    /**
     * Set store.
     * 
     * @param Stores $store The store to set for the employee.
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
     * @return string The employee name.
     */
    public function getEmployee_name(){
        return $this->employee_name;
    }

    /**
     * Set employee_name.
     * 
     * @param string $employee_name The employee name to set.
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
     * @return string The employee email.
     */
    public function getEmployee_email(){
        return $this->employee_email;
    }

    /**
     * Set employee_email.
     * 
     * @param string $employee_email The employee email to set.
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
     * @return string The employee password.
     */
    public function getEmployee_password(){
        return $this->employee_password;
    }

    /**
     * Set employee_password.
     * 
     * @param string $employee_password The employee password to set.
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
     * @return string The employee role.
     */
    public function getEmployee_role(){
        return $this->employee_role;
    }

    /**
     * Set employee_role.
     * 
     * @param string $employee_role The employee role to set.
     * 
     * @return Employees
     */
    public function setEmployee_role($employee_role){
        $this->employee_role = $employee_role;
        return $this;
    }

    /**
     * Returns the string representation of the employee.
     * 
     * @return string The employee name.
     */
    public function __toString(){
        return $this->employee_name;
    }

    /**
     * Specify data which should be serialized to JSON.
     * 
     * @return array Serialized data.
     */
    public function jsonSerialize() {
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
