<?php
// src/Entity/Categories.php
namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Entity\Products;
use JsonSerializable;

/**
 * @ORM\Entity
 * @ORM\Table{name="categories"}
 */
class Categories implements JsonSerializable{

    /** @var int */
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private int $category_id;

    /** @var string */
    /**
     * @ORM\Column(type="string")
     */
    private string $category_name;

    /** @var \Doctrine\Common\Collections\Collection */
    /**
     * @ORM\OneToMany(targetEntity=Products::class, mappedBy="category")
     */
    private Collection $productsCategory;

    /**
     * Get category_id.
     * 
     * @return int
     */
    public function getCategory_id(){
        return $this->category_id;
    }

    /**
     * Set category_id.
     * 
     * @param int $category_id
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
     * @return string
     */
    public function getCategory_name(){
        return $this->category_name;
    }

    /**
     * Set category_name.
     * 
     * @param string $category_name
     * 
     * @return Categories
     */
    public function setCategory_name($category_name){
        $this->category_name = $category_name;
        return $this;
    }

    public function __toString(){
        return $this->category_name;
    }

    /**
     * Get productsCategory.
     * 
     * @return Collection|Products[]
     */
    public function getProductsCategory(){
        return $this->productsCategory;
    }

    /**
     *
     * @return array|mixed
     */
    public function jsonSerialize(): mixed {
        return [
            'category_id' => $this->category_id,
            'category_name' => $this->category_name,
        ];
    }

}
?>
