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

        $sql = "SELECT * FROM product WHERE id = :id";

        $statement = $pdo->prepare($sql);
        $statement->bindValue(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        $data = $statement->fetch(PDO::FETCH_ASSOC);

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

        $sql = "SELECT * FROM product";

        $query = $pdo->query($sql);

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
    static public function findByDescription(string $filter): array;
    static public function findByEmail(string $email): ?object;
    static public function existsByEmail(string $email): bool;
    static public function save(object $object): bool;
    static public function update(object $object): bool;
    static public function delete(object $object): bool;
}
?>
