<?php
/**
 * Description : DAO pour la classe produit de la BD onlineShop
 */

include_once(__DIR__ . "/DAO.interface.php");
include_once(__DIR__ . "/../product.class.php");
include_once(__DIR__ . "/connexionBD.class.php");

class ProductDAO implements DAO {


    static public function findById(int $id): ?object {
        $pdo = ConnexionBD::getInstance();

        $sql = "SELECT * FROM Products WHERE id = :id";

        $statement = $pdo->prepare($sql);
        $statement->bindValue(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        $data = $statement->fetch(PDO::FETCH_ASSOC);

        // if ($data) {
        //     return $data;
        // }
        // return null;

        if ($data) {
            return new Product(
                $data['id'],
                $data['name'],
                $data['price'],
                $data['image'],
                $data['category'],
                $data['description'],
                $data['quantity']
            );
        }
        
        return null;
    }

    static public function findAll(): array {
        $pdo = ConnexionBD::getInstance();

        $sql = "SELECT * FROM Products";

        $query = $pdo->query($sql);

        // return $query->fetchAll(PDO::FETCH_CLASS, 'Products');

        $data = $query->fetchAll();

        $productArr = array();
        if ($data) {
            foreach ($data as $product) {
                $productArr[] = new Product(
                    $product['id'],
                    $product['name'],
                    $product['price'],
                    $product['image'],
                    $product['category'],
                    $product['description'],
                    $product['quantity']
                );
            }
            
            return $productArr;
        }
        
        return $productArr;
    }
    static public function findByDescription(string $filter): array {
        $pdo = ConnexionBD::getInstance();

        $sql = "SELECT * FROM Products ";
        // sql injection machine right here
        $sql .= $filter;

        $query = $pdo->query($sql);

        // return $query->fetchAll(PDO::FETCH_CLASS, 'Product');

         $data = $query->fetchAll();
        $productArr = array();
        if ($data) {
            foreach ($data as $product) {
                $productArr[] = new Product(
                    $product['id'],
                    $product['name'],
                    $product['price'],
                    $product['image'],
                    $product['category'],
                    $product['description'],
                    $product['quantity']
                );
            }
            
            return $productArr;
        }
        
        return array();
    }

    static public function save(object $object): bool {
        $pdo = ConnexionBD::getInstance();

        $sql = "INSERT INTO Products 
                        (name,  price,  image,  category,  description,  quantity) 
                VALUES (:name, :price, :image, :category, :description, :quantity)";
        
        $statement = $pdo->prepare($sql);

        try {
            $attributes = $object->getAllAttributes();
        }
        catch (Exception $e) {
            return false;
        }

        for ($i = 0; $i < count($attributes[0]); $i++) {
            $statement->bindValue(
                ":" . $attributes[0][$i], 
                $attributes[1][$i], 
                PDO::PARAM_STR);
        }
        
        $execResult = $statement->execute();
        if ($execResult) { $object->setId($pdo->lastInsertId()); }
        return $execResult;
    }

    static public function update(object $object): bool {
        $pdo = ConnexionBD::getInstance();

        $sql = "UPDATE Products 
                SET name        = :name, 
                    price       = :price, 
                    image       = :image, 
                    category    = :category, 
                    description = :description, 
                    quantity    = :quantity
                WHERE id = :id";

        $statement = $pdo->prepare($sql);

        try {
            $attributes = $object->getAllAttributes();
            $objectId = $object->getId();
        }
        catch (Exception $e) {
            return false;
        }
        
        $statement->bindValue(":id", $objectId, PDO::PARAM_INT);
        for ($i = 0; $i < 6; $i++) {
            $statement->bindValue(":".$attributes[0][$i], $attributes[1][$i], PDO::PARAM_STR);
        }
        return $statement->execute();
    }

    static public function delete(object $object): bool {
        $pdo = ConnexionBD::getInstance();

        $sql = "DELETE FROM Products WHERE id = :id";
        $statement = $pdo->prepare($sql);

        try {    
            $statement->bindValue(":id", $object->getId(), PDO::PARAM_INT);
        }
        catch (Exception $e) {
            return false;
        }
        return $statement->execute();
    }

    static public function findByEmail(string $email): ?object {
        return null;
    }

    static public function existsByEmail(string $email): bool {
        return false;
    }
}
?>
