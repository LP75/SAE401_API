<?php
// src/Repository/EmployeesRepository.php
namespace Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Entity\Employees;

class EmployeesRepository extends EntityRepository{

    public function getEmployeesByStoreName($storeName){
        $queryBuilder = $this->getEntityManager()->createQueryBuilder()
            ->select('e')
            ->from(Employees::class, 'e')
            ->leftJoin('e.store', 's')
            ->where('s.store_name = :store_name')
            ->setParameter('store_name', $storeName);
        
        $query = $queryBuilder->getQuery();
    
        return $query->getResult();
    }

}
?>