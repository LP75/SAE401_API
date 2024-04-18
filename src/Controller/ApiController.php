<?php

class ApiController {

    private $entityManager;

    private $entityId = ["Brands"=>"brand_id","Categories"=>"category_id","Employees"=>"employee_id","Products"=>"product_id","Stocks"=>"stock_id","Stores"=>"store_id"];

    public function __construct($entityManager){
        $this->entityManager=$entityManager;
    }

    public function handleRequest(){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $request_method=$_SERVER["REQUEST_METHOD"];
        $apiKey = isset(array_change_key_case(apache_request_headers(), CASE_LOWER)['authorization']) ? array_change_key_case(apache_request_headers(), CASE_LOWER)['authorization'] : '';

        switch($request_method){
            case "GET":
                $this->getAction($this->entityManager);
                break;
            case "POST":
                if (!$this->validateApiKey($apiKey)) {
                    $response = array("status" => 0, "status_message" => 'Access denied. Invalid API key.');
                    echo json_encode($response);
                    return;
                } else {
                    $this->postAction($this->entityManager);
                }
                break;
            case "PUT":
                if (!$this->validateApiKey($apiKey)) {
                    $response = array("status" => 0, "status_message" => 'Access denied. Invalid API key.');
                    echo json_encode($response);
                    return;
                } else {
                    $this->putAction($this->entityManager);
                }
                break;
            case "DELETE":
                if (!$this->validateApiKey($apiKey)) {
                    $response = array("status" => 0, "status_message" => 'Access denied. Invalid API key.');
                    echo json_encode($response);
                    return;
                } else {
                    $this->deleteAction($this->entityManager);
                }
                break;
            default:
                header("HTTP/1.1 405 Method Not Allowed");
                header("Allow: GET, POST, PUT, DELETE");
                break;
        }
    }

    private function getAction($entityManager){
        if (isset($_GET["table"])){
            $table=ucfirst($_GET["table"]);
            $className = "Entity\\" . $table;
            if (class_exists($className)){
                if (!empty($_GET["id"])){
                    $id=$_GET["id"];
                    $repository = $entityManager->getRepository($className);
                    $rep_id=$this->entityId[$table];
                    $e = $repository->findOneBy([$rep_id => $id]);
                    if($e!=NULL) echo json_encode($e);
                    else {
                        $response=array("status" => 0,"status_message" =>'ID : '.$id.' not found for table : '.$table);
                        echo json_encode($response);
                    }
                } else if (!empty($_GET["catName"])){
                    $catName=urldecode($_GET["catName"]);
                    $repository = $entityManager->getRepository($className);
                    $e = $repository->getProductsByCategoryName($catName);
                    if($e!=NULL) echo json_encode($e);
                    else {
                        $response=array("status" => 0,"status_message" =>'No products found for category : '.$catName);
                        echo json_encode($response);
                    }
                } else if (!empty($_GET["brandName"])){
                    $brandName=$_GET["brandName"];
                    $repository = $entityManager->getRepository($className);
                    $e = $repository->getProductsByBrandName($brandName);
                    if($e!=NULL) echo json_encode($e);
                    else {
                        $response=array("status" => 0,"status_message" =>'No products found for brand : '.$brandName);
                        echo json_encode($response);
                    }
                } else if (!empty($_GET["storeName"])){
                    if ($_GET["table"]=="Products") {
                        $storeName=$_GET["storeName"];
                        $repository = $entityManager->getRepository($className);
                        $e = $repository->getProductsByStoreName($storeName);
                        if($e!=NULL) echo json_encode($e);
                        else {
                            $response=array("status" => 0,"status_message" =>'No products found for store : '.$storeName);
                            echo json_encode($response);
                        }
                    } else if ($_GET["table"]=="Employees") {
                        $storeName=$_GET["storeName"];
                        $repository = $entityManager->getRepository($className);
                        $e = $repository->getEmployeesByStoreName($storeName);
                        if($e!=NULL) echo json_encode($e);
                        else {
                            $response=array("status" => 0,"status_message" =>'No employees found for store : '.$storeName);
                            echo json_encode($response);
                        }
                    }
                } else if (!empty($_GET["model_year"])){
                    $model_year=$_GET["model_year"];
                    $repository = $entityManager->getRepository($className);
                    $e = $repository->findBy(["model_year" => $model_year]);
                    if($e!=NULL) echo json_encode($e);
                    else {
                        $response=array("status" => 0,"status_message" =>'No products found for year : '.$model_year);
                        echo json_encode($response);
                    }
                } else {
                    $repository = $entityManager->getRepository("Entity\\".$table);
                    $e = $repository->findAll();
                    if($e!=NULL) echo json_encode($e);
                    else {
                        $response=array("status" => 0,"status_message" =>'No values inside table : '.$table);
                        echo json_encode($response);
                    }
                }
            } else {
                $response=array("status" => 0,"status_message" =>'Table : '.$table.' not found.');
                echo json_encode($response);
            }    
        } else {
            $response=array("status" => 0,"status_message" =>'No table specified');
            echo json_encode($response);
        }
    }

    private function postAction($entityManager){
        if (isset($_GET["table"])){
            $table=ucfirst($_GET["table"]);
            switch($table){
                case "Brands":
                    $data = json_decode(file_get_contents("php://input"), true);
                    if ($data === null) {
                        $response = array("status" => 0, "status_message" => 'Invalid JSON data');
                        echo json_encode($response);
                        return;
                    }
                    $brand = new \Entity\Brands();

                    $brand_name = $data['brand_name'];
    
                    $brand->setBrand_name($brand_name);

                    $entityManager->persist($brand);
                    $entityManager->flush();

                    $response = array("status_message" => 'Addition successful');
                    echo json_encode($response);
                    echo json_encode($brand);
                    break;
                case "Categories":
                    $data = json_decode(file_get_contents("php://input"), true);
                    if ($data === null) {
                        $response = array("status" => 0, "status_message" => 'Invalid JSON data');
                        echo json_encode($response);
                        return;
                    }
                    $category = new \Entity\Categories();

                    $category_name = $data['category_name'];
    
                    $category->setCategory_name($category_name);

                    $entityManager->persist($category);
                    $entityManager->flush();

                    $response = array("status_message" => 'Addition successful');
                    echo json_encode($response);
                    echo json_encode($category);
                    break;
                case "Employees":
                    $data = json_decode(file_get_contents("php://input"), true);
                    if ($data === null) {
                        $response = array("status" => 0, "status_message" => 'Invalid JSON data');
                        echo json_encode($response);
                        return;
                    }
                    $employee = new \Entity\Employees();

                    $store_id = $data['store_id'];
                    $employee_name = $data['employee_name'];
                    $employee_email = $data['employee_email'];
                    $employee_password = $data['employee_password'];
                    $employee_role = $data['employee_role'];

                    $store = $entityManager->getReference('Entity\Stores', $store_id);
    
                    $employee->setStore($store);
                    $employee->setEmployee_name($employee_name);
                    $employee->setEmployee_email($employee_email);
                    $employee->setEmployee_password($employee_password);
                    $employee->setEmployee_role($employee_role); 

                    $entityManager->persist($employee);
                    $entityManager->flush();

                    $response = array("status_message" => 'Addition successful');
                    echo json_encode($response);
                    echo json_encode($employee);
                    break;
                case "Products":
                    $data = json_decode(file_get_contents("php://input"), true);
                    if ($data === null) {
                        $response = array("status" => 0, "status_message" => 'Invalid JSON data');
                        echo json_encode($response);
                        return;
                    }
                    $product = new \Entity\Products();

                    $product_name = $data['product_name'];
                    $model_year = $data["model_year"];
                    $list_price = $data['list_price'];
                    $brand_id = $data['brand_id'];
                    $category_id = $data['category_id'];

                    $brand = $entityManager->getReference('Entity\Brands', $brand_id);
                    $category = $entityManager->getReference('Entity\Categories', $category_id);
    
                    $product->setProduct_name($product_name);
                    $product->setModel_year($model_year);
                    $product->setList_price($list_price);
                    $product->setBrand($brand);
                    $product->setCategory($category); 

                    $entityManager->persist($product);
                    $entityManager->flush();

                    $response = array("status_message" => 'Addition successful');
                    echo json_encode($response);
                    echo json_encode($product);
                    break;
                case "Stocks":
                    $data = json_decode(file_get_contents("php://input"), true);
                    if ($data === null) {
                        $response = array("status" => 0, "status_message" => 'Invalid JSON data');
                        echo json_encode($response);
                        return;
                    }
                    $stock = new \Entity\Stocks();

                    $store_id = $data['store_id'];
                    $product_id = $data['product_id'];
                    $quantity = $data['quantity'];

                    $store = $entityManager->getReference('Entity\Stores', $store_id);
                    $product = $entityManager->getReference('Entity\Products', $product_id);
    
                    $stock->setStore($store);
                    $stock->setProduct($product);
                    $stock->setQuantity($quantity);

                    $entityManager->persist($stock);
                    $entityManager->flush();

                    $response = array("status_message" => 'Addition successful');
                    echo json_encode($response);
                    echo json_encode($stock);
                    break;
                case "Stores":
                    $data = json_decode(file_get_contents("php://input"), true);
                    if ($data === null) {
                        $response = array("status" => 0, "status_message" => 'Invalid JSON data');
                        echo json_encode($response);
                        return;
                    }
                    $store = new \Entity\Stores();

                    $store_name = $data['store_name'];
                    $phone = $data['phone'];
                    $email = $data['email'];
                    $street = $data['street'];
                    $city = $data['city'];
                    $state = $data['state'];
                    $zip_code = $data['zip_code'];

                    $store->setStore_name($store_name);
                    $store->setPhone($phone);
                    $store->setEmail($email);
                    $store->setStreet($street);
                    $store->setCity($city); 
                    $store->setState($state); 
                    $store->setZip_code($zip_code);

                    $entityManager->persist($store);
                    $entityManager->flush();

                    $response = array("status_message" => 'Addition successful');
                    echo json_encode($response);
                    echo json_encode($store);
                    break;
            }
        } else {
            $response=array("status" => 0,"status_message" =>'No table specified');
            echo json_encode($response);
        }
    }

    private function putAction($entityManager){
        if (isset($_GET["table"])){
            $table=ucfirst($_GET["table"]);
            $className = "Entity\\" . $table;
            switch($table){
                case "Brands":
                    $data = json_decode(file_get_contents("php://input"), true);
                    if ($data === null) {
                        $response = array("status" => 0, "status_message" => 'Invalid JSON data');
                        echo json_encode($response);
                        return;
                    }
                    $id = $_GET["id"];
                    $repository = $entityManager->getRepository($className);
                    $entity = $repository->find($id);
                    if (!$entity) {
                        $response = array("status" => 0, "status_message" => 'Entity not found');
                        echo json_encode($response);
                        return;
                    }
    
                    $entity->setBrand_name($data['brand_name']);
    
                    $entityManager->flush();
    
                    $response = array("status_message" => 'Update successful');
                    echo json_encode($response);
                    echo json_encode($entity);
                    break;
    
                case "Categories":
                    $data = json_decode(file_get_contents("php://input"), true);
                    if ($data === null) {
                        $response = array("status" => 0, "status_message" => 'Invalid JSON data');
                        echo json_encode($response);
                        return;
                    }
                    $id = $_GET["id"];
                    $repository = $entityManager->getRepository($className);
                    $entity = $repository->find($id);
                    if (!$entity) {
                        $response = array("status" => 0, "status_message" => 'Entity not found');
                        echo json_encode($response);
                        return;
                    }
    
                    $entity->setCategory_name($data['category_name']);
    
                    $entityManager->flush();
    
                    $response = array("status_message" => 'Update successful');
                    echo json_encode($response);
                    echo json_encode($entity);
                    break;
    
                case "Employees":

                    $data = json_decode(file_get_contents("php://input"), true);
                    if ($data === null) {
                        $response = array("status" => 0, "status_message" => 'Invalid JSON data');
                        echo json_encode($response);
                        break;
                    }
                    $id = $_GET["id"];
                    $repository = $entityManager->getRepository($className);
                    $entity = $repository->find($id);
                    if (!$entity) {
                        $response = array("status" => 0, "status_message" => 'Entity not found');
                        echo json_encode($response);
                        return;
                    }

                    $store_id = $data['store_id'];
                    $store = $entityManager->getReference('Entity\Stores', $store_id);
                    
                    $entity->setEmployee_name($data['employee_name']);
                    $entity->setEmployee_email($data['employee_email']);
                    $entity->setEmployee_password($data['employee_password']);
                    $entity->setEmployee_role($data['employee_role']);

                    $entity->setStore($store);
    
                    $entityManager->flush();
    
                    $response = array("status_message" => 'Update successful');
                    echo json_encode($response);
                    echo json_encode($entity);
                    break;

                case "Products":
                    $data = json_decode(file_get_contents("php://input"), true);
                    if ($data === null) {
                        $response = array("status" => 0, "status_message" => 'Invalid JSON data');
                        echo json_encode($response);
                        return;
                    }
                    $id = $_GET["id"];
                    $repository = $entityManager->getRepository($className);
                    $entity = $repository->find($id);
                    if (!$entity) {
                        $response = array("status" => 0, "status_message" => 'Entity not found');
                        echo json_encode($response);
                        return;
                    }
                    
                    $brandId = $data['brand_id'];
                    $categoryId = $data['category_id'];
                    $brand = $entityManager->getReference('Entity\Brands', $brandId);
                    $category = $entityManager->getReference('Entity\Categories', $categoryId);

                    $entity->setProduct_name($data['product_name']);
                    $entity->setModel_year($data['model_year']);
                    $entity->setList_price($data['list_price']);
    
                    $entity->setBrand($brand);
                    $entity->setCategory($category);
    
                    $entityManager->flush();
    
                    $response = array("status_message" => 'Update successful');
                    echo json_encode($response);
                    echo json_encode($entity);
                    break;
    
                case "Stocks":
                    $data = json_decode(file_get_contents("php://input"), true);
                    if ($data === null) {
                        $response = array("status" => 0, "status_message" => 'Invalid JSON data');
                        echo json_encode($response);
                        return;
                    }
                    $id = $_GET["id"];
                    $repository = $entityManager->getRepository($className);
                    $entity = $repository->find($id);
                    if (!$entity) {
                        $response = array("status" => 0, "status_message" => 'Entity not found');
                        echo json_encode($response);
                        return;
                    }

                    $store_id = $data['store_id'];
                    $product_id = $data['product_id'];
                    $store = $entityManager->getReference('Entity\Stores', $store_id);
                    $product = $entityManager->getReference('Entity\Products', $product_id);
    
                    $entity->setQuantity($data['quantity']);

                    $entity->setStore($store);
                    $entity->setProduct($product);
    
                    $entityManager->flush();
    
                    $response = array("status_message" => 'Update successful');
                    echo json_encode($response);
                    echo json_encode($entity);
                    break;
    
                case "Stores":
                    $data = json_decode(file_get_contents("php://input"), true);
                    if ($data === null) {
                        $response = array("status" => 0, "status_message" => 'Invalid JSON data');
                        echo json_encode($response);
                        return;
                    }
                    $id = $_GET["id"];
                    $repository = $entityManager->getRepository($className);
                    $entity = $repository->find($id);
                    if (!$entity) {
                        $response = array("status" => 0, "status_message" => 'Entity not found');
                        echo json_encode($response);
                        return;
                    }
    
                    $entity->setStore_name($data['store_name']);
                    $entity->setPhone($data['phone']);
                    $entity->setEmail($data['email']);
                    $entity->setStreet($data['street']);
                    $entity->setCity($data['city']);
                    $entity->setState($data['state']);
                    $entity->setZip_code($data['zip_code']);
    
                    $entityManager->flush();
    
                    $response = array("status_message" => 'Update successful');
                    echo json_encode($response);
                    echo json_encode($entity);
                    break;
            }
        } else {
            $response=array("status" => 0,"status_message" =>'No table specified');
            echo json_encode($response);
        }
    }
    

    private function deleteAction($entityManager){
        if (isset($_GET["table"])){
            $table=ucfirst($_GET["table"]);
            $className = "Entity\\" . $table;
            if (class_exists($className)){
                if (!empty($_GET["id"])){
                    $id=$_GET["id"];
                    $repository = $entityManager->getRepository($className);
                    $entity = $repository->find($id);
                    if (!$entity) {
                        $response = array("status" => 0, "status_message" => 'Entity not found');
                        echo json_encode($response);
                        return;
                    }
                    try {
                        
                        $entityManager->remove($entity);
                        $entityManager->flush();

                        $response = array("status_message" => 'Deletion successful');
                        echo json_encode($response);
                    } catch (\Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException $e) {

                        $response = array("status" => 0, "status_message" => 'Cannot delete '.$table.': It is referenced in other tables');
                        echo json_encode($response);
                    }
                } else {
                    $response = array("status" => 0, "status_message" => 'No ID specified');
                    echo json_encode($response);
                }
            } else {
                $response=array("status" => 0, "status_message" =>'Table : '.$table.' not found.');
                echo json_encode($response);
            }    
        } else {
            $response=array("status" => 0, "status_message" =>'No table specified');
            echo json_encode($response);
        }
    }

    private function validateApiKey($apiKey) {
        $validKey = "e8f1997c763";
        $apiKey = explode(' ', $apiKey);
        if (count($apiKey) === 2 && $apiKey[0] === 'Bearer') {
            $apiKey = $apiKey[1];
        }    
        if ($apiKey==$validKey) {
            return true;
        } else {
            return false;
        }
    }
    
    
}

?>