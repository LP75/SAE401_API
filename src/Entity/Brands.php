<?php
// src/Entity/Brands.php
namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Entity\Products;
use JsonSerializable;

/**
 * @ORM\Entity
 * @ORM\Table{name="brands"}
 */
class Brands implements JsonSerializable{

    /** @var int */
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private int $brand_id;

    /** @var string */
    /**
     * @ORM\Column(type="string")
     */
    private string $brand_name;

    /** @var \Doctrine\Common\Collections\Collection */
    /**
     * @ORM\OneToMany(targetEntity=Products::class, mappedBy="brand")
     */
    private Collection $productsBrand;

    /**
     * Get brand_id.
     * 
     * @return int
     */
    public function getBrand_id(){
        return $this->brand_id;
    }

    /**
     * Set brand_id.
     * 
     * @param int $brand_id
     * 
     * @return Brands
     */
    public function setBrand_id($brand_id){
        $this->brand_id = $brand_id;
        return $this;
    }

    /**
     * Get brand_name.
     * 
     * @return string
     */
    public function getBrand_name(){
        return $this->brand_name;
    }

    /**
     * Set brand_name.
     * 
     * @param string $brand_name
     * 
     * @return Brands
     */
    public function setBrand_name($brand_name){
        $this->brand_name = $brand_name;
        return $this;
    }

    /**
     * Get productsBrand.
     * 
     * @return Collection|Products[]
     */
    public function getProductsBrand(){
        return $this->productsBrand;
    }

    public function __toString(){
        return $this->brand_name;
    }

    public function jsonSerialize(): mixed {
        return [
            'brand_id' => $this->brand_id,
            'brand_name' => $this->brand_name,
        ];
    }
}
?>
