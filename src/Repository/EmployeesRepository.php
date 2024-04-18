<?php
// src/Repository/EmployeesRepository.php
namespace Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Entity\Employees;

/**
 * Repository class for accessing and managing Employees entities.
 */
class EmployeesRepository extends EntityRepository{

    /**
     * Retrieves employees by store name.
     * 
     * @param string $storeName The name of the store.
     * 
     * @return array An array of matching Employees entities.
     */
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
