<?php
// src/Repository/ProductsRepository.php
namespace Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Entity\Products;

class ProductsRepository extends EntityRepository{

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