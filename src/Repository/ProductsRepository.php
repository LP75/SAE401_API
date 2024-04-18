<?php
// src/Repository/ProductsRepository.php
namespace Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Entity\Products;

/**
 * Repository class for accessing and managing Products entities.
 */
class ProductsRepository extends EntityRepository{

    /**
     * Retrieves products by brand name.
     * 
     * @param string $brandName The name of the brand.
     * 
     * @return array An array of matching Products entities.
     */
    public function getProductsByBrandName($brandName){
        $queryBuilder = $this->getEntityManager()->createQueryBuilder()
            ->select('p')
            ->from(Products::class, 'p')
            ->leftJoin('p.brand', 'b')
            ->where('b.brand_name = :brand_name')
            ->setParameter('brand_name', $brandName);
        
        $query = $queryBuilder->getQuery();
    
        return $query->getResult();
    }
    
    /**
     * Retrieves products by category name.
     * 
     * @param string $catName The name of the category.
     * 
     * @return array An array of matching Products entities.
     */
    public function getProductsByCategoryName($catName){
        $queryBuilder = $this->getEntityManager()->createQueryBuilder()
            ->select('p')
            ->from(Products::class, 'p')
            ->leftJoin('p.category', 'b')
            ->where('b.category_name = :category_name')
            ->setParameter('category_name', $catName);
        
        $query = $queryBuilder->getQuery();
    
        return $query->getResult();
    }

    /**
     * Retrieves products by store name.
     * 
     * @param string $storeName The name of the store.
     * 
     * @return array An array of matching Products entities.
     */
    public function getProductsByStoreName($storeName){
        $queryBuilder = $this->getEntityManager()->createQueryBuilder()
        ->select('p')
        ->from(Products::class, 'p')
        ->innerJoin('p.stocksProduct', 'sk')
        ->innerJoin('sk.store', 'sr')
        ->where('sr.store_name = :store_name')
        ->setParameter('store_name', $storeName);
        
        $query = $queryBuilder->getQuery();
    
        return $query->getResult();
    }

}
?>
