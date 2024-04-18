<?php
// src/Entity/Brands.php
namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Entity\Products;
use JsonSerializable;

/**
 * Represents a brand entity.
 *
 * @ORM\Entity
 * @ORM\Table{name="brands"}
 */
class Brands implements JsonSerializable{

    /** @var int The unique identifier for the brand. */
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private int $brand_id;

    /** @var string The name of the brand. */
    /**
     * @ORM\Column(type="string")
     */
    private string $brand_name;

    /** @var \Doctrine\Common\Collections\Collection Collection of products associated with this brand. */
    /**
     * @ORM\OneToMany(targetEntity=Products::class, mappedBy="brand")
     */
    private Collection $productsBrand;

    /**
     * Get brand_id.
     * 
     * @return int The brand ID.
     */
    public function getBrand_id(){
        return $this->brand_id;
    }

    /**
     * Set brand_id.
     * 
     * @param int $brand_id The brand ID to set.
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
     * @return string The brand name.
     */
    public function getBrand_name(){
        return $this->brand_name;
    }

    /**
     * Set brand_name.
     * 
     * @param string $brand_name The brand name to set.
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
     * @return Collection|Products[] Collection of products associated with this brand.
     */
    public function getProductsBrand(){
        return $this->productsBrand;
    }

    /**
     * Returns the string representation of the brand.
     * 
     * @return string The brand name.
     */
    public function __toString(){
        return $this->brand_name;
    }

    /**
     * Specify data which should be serialized to JSON.
     * 
     * @return array Serialized data.
     */
    public function jsonSerialize() {
        return [
            'brand_id' => $this->brand_id,
            'brand_name' => $this->brand_name,
        ];
    }
}
?>
