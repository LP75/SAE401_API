<?php
// src/Entity/Products.php
namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Entity\Brands;
use Entity\Categories;
use JsonSerializable;

/**
 * Represents a product entity.
 *
 * @ORM\Entity(repositoryClass="Repository\ProductsRepository")
 * @ORM\Table{name="products"}
 */
class Products implements JsonSerializable{

    /** @var int The unique identifier for the product. */
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private int $product_id;

    /**
     * @ORM\ManyToOne(targetEntity=Brands::class, inversedBy="productsBrand", cascade={"persist"})
     * @ORM\JoinColumn(name="brand_id", referencedColumnName="brand_id", nullable=false)
     */
    private Brands $brand;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="productsCategory", cascade={"persist"})
     * @ORM\JoinColumn(name="category_id", referencedColumnName="category_id", nullable=false)
     */
    private Categories $category;

    /**
     * @ORM\Column(type="smallint", columnDefinition="SMALLINT(6)", nullable=false)
     */
    private int $model_year;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, columnDefinition="DECIMAL(10,2)", nullable=false)
     */
    private string $list_price;

    /** @var string The name of the product. */
    /**
     * @ORM\Column(type="string")
     */
    private string $product_name;

    /** @var \Doctrine\Common\Collections\Collection */
    /**
     * @ORM\OneToMany(targetEntity=Stocks::class, mappedBy="product")
     */
    private Collection $stocksProduct;

    /**
     * Get product_id.
     * 
     * @return int The product ID.
     */
    public function getProduct_id(){
        return $this->product_id;
    }

    /**
     * Set product_id.
     * 
     * @param int $product_id The product ID to set.
     * 
     * @return Products
     */
    public function setProduct_id($product_id){
        $this->product_id = $product_id;
        return $this;
    }

    /**
     * Get brand.
     * 
     * @return Brands The brand associated with the product.
     */
    public function getBrand(){
        return $this->brand;
    }

    /**
     * Set brand.
     * 
     * @param Brands $brand The brand to set for the product.
     * 
     * @return Products
     */
    public function setBrand($brand){
        $this->brand = $brand;
        return $this;
    }

    /**
     * Get category.
     * 
     * @return Categories The category associated with the product.
     */
    public function getCategory(){
        return $this->category;
    }

    /**
     * Set category.
     * 
     * @param Categories $category The category to set for the product.
     * 
     * @return Products
     */
    public function setCategory($category){
        $this->category = $category;
        return $this;
    }

    /**
     * Get model_year.
     * 
     * @return int The model year of the product.
     */
    public function getModel_year(){
        return $this->model_year;
    }

    /**
     * Set model_year.
     * 
     * @param int $model_year The model year to set for the product.
     * 
     * @return Products
     */
    public function setModel_year($model_year){
        $this->model_year = $model_year;
        return $this;
    }

    /**
     * Get list_price.
     * 
     * @return string The list price of the product.
     */
    public function getList_price(){
        return $this->list_price;
    }

    /**
     * Set list_price.
     * 
     * @param int $list_price The list price to set for the product.
     * 
     * @return Products
     */
    public function setList_price($list_price){
        $this->list_price = $list_price;
        return $this;
    }

    /**
     * Get product_name.
     * 
     * @return string The product name.
     */
    public function getProduct_name(){
        return $this->product_name;
    }

    /**
     * Set product_name.
     * 
     * @param string $product_name The product name to set.
     * 
     * @return Products
     */
    public function setProduct_name($product_name){
        $this->product_name = $product_name;
        return $this;
    }

    /**
     * Constructor.
     */
    public function __construct() {
        $this->brand = new Brands();
        $this->category = new Categories();
    }

    /**
     * Returns the string representation of the product.
     * 
     * @return string The product name.
     */
    public function __toString(){
        return $this->product_name;
    }

    /**
     * Specify data which should be serialized to JSON.
     * 
     * @return array Serialized data.
     */
    public function jsonSerialize() {
        return [
            'product_id' => $this->product_id,
            'brand' => $this->brand,
            'category' => $this->category,
            'model_year' => $this->model_year,
            'list_price' => $this->list_price,
            'product_name' => $this->product_name,
        ];
    }

}
?>
