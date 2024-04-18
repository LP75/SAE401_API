<?php
// src/Entity/Categories.php
namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Entity\Products;
use JsonSerializable;

/**
 * Represents a category entity.
 *
 * @ORM\Entity
 * @ORM\Table{name="categories"}
 */
class Categories implements JsonSerializable{

    /** @var int The unique identifier for the category. */
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private int $category_id;

    /** @var string The name of the category. */
    /**
     * @ORM\Column(type="string")
     */
    private string $category_name;

    /** @var \Doctrine\Common\Collections\Collection Collection of products associated with this category. */
    /**
     * @ORM\OneToMany(targetEntity=Products::class, mappedBy="category")
     */
    private Collection $productsCategory;

    /**
     * Get category_id.
     * 
     * @return int The category ID.
     */
    public function getCategory_id(){
        return $this->category_id;
    }

    /**
     * Set category_id.
     * 
     * @param int $category_id The category ID to set.
     * 
     * @return Categories
     */
    public function setCategory_id($category_id){
        $this->category_id = $category_id;
        return $this;
    }

    /**
     * Get category_name.
     * 
     * @return string The category name.
     */
    public function getCategory_name(){
        return $this->category_name;
    }

    /**
     * Set category_name.
     * 
     * @param string $category_name The category name to set.
     * 
     * @return Categories
     */
    public function setCategory_name($category_name){
        $this->category_name = $category_name;
        return $this;
    }

    /**
     * Returns the string representation of the category.
     * 
     * @return string The category name.
     */
    public function __toString(){
        return $this->category_name;
    }

    /**
     * Get productsCategory.
     * 
     * @return Collection|Products[] Collection of products associated with this category.
     */
    public function getProductsCategory(){
        return $this->productsCategory;
    }

    /**
     * Specify data which should be serialized to JSON.
     * 
     * @return array Serialized data.
     */
    public function jsonSerialize() {
        return [
            'category_id' => $this->category_id,
            'category_name' => $this->category_name,
        ];
    }

}
?>
