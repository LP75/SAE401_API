<?php
// src/Entity/Stocks.php
namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Entity\Products;
use Entity\Stores;
use JsonSerializable;

/**
 * @ORM\Entity
 * @ORM\Table{name="stocks"}
 */
class Stocks implements JsonSerializable{

    /** @var int */
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private int $stock_id;

    /**
     * @ORM\ManyToOne(targetEntity=Stores::class, inversedBy="stocksStore", cascade={"persist"})
     * @ORM\JoinColumn(name="store_id", referencedColumnName="store_id", nullable=true)
     */
    private ?Stores $store;

    /**
     * @ORM\ManyToOne(targetEntity=Products::class, inversedBy="stocksProduct", cascade={"persist"})
     * @ORM\JoinColumn(name="product_id", referencedColumnName="product_id", nullable=true)
     */
    private ?Products $product;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $quantity;

    /**
     * Get stock_id.
     * 
     * @return int
     */
    public function getStock_id(){
        return $this->stock_id;
    }

    /**
     * Set stock_id.
     * 
     * @param int $stock_id
     * 
     * @return Stocks
     */
    public function setStock_id($stock_id){
        $this->stock_id = $stock_id;
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
     * @return Stocks
     */
    public function setStore($store){
        $this->store = $store;
        return $this;
    }

    /**
     * Get product.
     * 
     * @return Products
     */
    public function getProduct(){
        return $this->product;
    }

    /**
     * Set product.
     * 
     * @param Products $product
     * 
     * @return Stocks
     */
    public function setProduct($product){
        $this->product = $product;
        return $this;
    }

    /**
     * Get quantity.
     * 
     * @return int
     */
    public function getQuantity(){
        return $this->quantity;
    }

    /**
     * Set quantity.
     * 
     * @param int $quantity
     * 
     * @return Stocks
     */
    public function setQuantity($quantity){
        $this->quantity = $quantity;
        return $this;
    }

    public function __toString(){
        return "Stock ID: " . $this->stock_id;
    }

    public function jsonSerialize(): mixed {
        return [
            'stock_id' => $this->stock_id,
            'store' => $this->store,
            'product' => $this->product,
            'quantity' => $this->quantity
        ];
    }
}
?>