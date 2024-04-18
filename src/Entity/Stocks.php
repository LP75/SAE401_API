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
 * Represents a stock entity.
 *
 * @ORM\Entity
 * @ORM\Table{name="stocks"}
 */
class Stocks implements JsonSerializable{

    /** @var int The unique identifier for the stock. */
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

    /** @var int|null The quantity of the product in stock. */
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $quantity;

    /**
     * Get stock_id.
     * 
     * @return int The stock ID.
     */
    public function getStock_id(){
        return $this->stock_id;
    }

    /**
     * Set stock_id.
     * 
     * @param int $stock_id The stock ID to set.
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
     * @return Stores The store associated with the stock.
     */
    public function getStore(){
        return $this->store;
    }

    /**
     * Set store.
     * 
     * @param Stores $store The store to set for the stock.
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
     * @return Products The product associated with the stock.
     */
    public function getProduct(){
        return $this->product;
    }

    /**
     * Set product.
     * 
     * @param Products $product The product to set for the stock.
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
     * @return int|null The quantity of the product in stock.
     */
    public function getQuantity(){
        return $this->quantity;
    }

    /**
     * Set quantity.
     * 
     * @param int|null $quantity The quantity to set for the product in stock.
     * 
     * @return Stocks
     */
    public function setQuantity($quantity){
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * Returns the string representation of the stock.
     * 
     * @return string A string representation of the stock.
     */
    public function __toString(){
        return "Stock ID: " . $this->stock_id;
    }

    /**
     * Specify data which should be serialized to JSON.
     * 
     * @return array Serialized data.
     */
    public function jsonSerialize() {
        return [
            'stock_id' => $this->stock_id,
            'store' => $this->store,
            'product' => $this->product,
            'quantity' => $this->quantity
        ];
    }
}
?>
