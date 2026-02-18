<?php
/**
 * Description : DAO pour la classe User et les tables User et Role

 */

include_once(__DIR__ . "/DAO.interface.php");
include_once(__DIR__ . "/../user.class.php");
include_once(__DIR__ . "/../role.class.php");

class UserDAO implements DAO {

static public function findById(int $id): ?object {
    $pdo = ConnexionBD::getInstance();

    $sql = "SELECT * FROM User WHERE id = :id";

    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id, PDO::PARAM_INT);
    $statement->execute();


    return $statement->fetchObject("User");

}

static public function findAll(): array {
    $pdo = ConnexionBD::getInstance();

    $sql = "SELECT * FROM User";
    $statement = $pdo->prepare($sql);
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_OBJ, "User");
}

static public function findByDescription(string $filter): array {
    $pdo = ConnexionBD::getInstance();

    $sql = "SELECT * FROM User ";

    // even a vibe coder wouldn't let this happen
    $sql .= $filter;

    $statement = $pdo->prepare($sql);
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_OBJ, "User");
}

static public function findByEmail(string $email): ?object {
    $pdo = ConnexionBD::getInstance();

    $sql = "SELECT * FROM User WHERE email = :email";

    $statement = $pdo->prepare($sql);
    $statement->bindValue(":email", $email, PDO::PARAM_STR);
    $statement->execute();

    return $statement->fetchObject("User");
}

static public function existsByEmail(string $email): bool {
    $pdo = ConnexionBD::getInstance();

    $sql = "SELECT COUNT(*) FROM User WHERE email = :email";

    $statement = $pdo->prepare($sql);
    $statement->bindValue(":email", $email, PDO::PARAM_STR);
    $statement->execute();

    return $statement->fetchColumn();
}

static public function save(object $object): bool {
    $pdo = ConnexionBD::getInstance();

    $sql = "INSERT INTO User 
                (firstName, lastName, email, password, phone, address, role) 
            VALUES (:firstName, :lastName, :email, :password, :phone, :address, :role)";

    $statement = $pdo->prepare($sql);
    
    try {
        $attributes = $object->getAllAttributes();
    }
    catch (Exception $e) {
        return false;
    }

    for ($i = 0; $i < 7; $i++) {
        // il me semble le User constructor ne prendrait pas null comme param pour Role
        if ($attributes[0][$i] == 'role') {
            $roleValue = ($attributes[1][$i] == null) ? 3 : $attributes[1][$i]->getId;
            $statement->bindValue(":role", $roleValue, PDO::PARAM_INT);
        }
        else if ($attributes[0][$i] == 'password') {
            $passwordValue = UserDAO::checkAndHashPassword($attributes[1][$i]);
            if (!$passwordValue) { return false; }
            $statement->bindValue(":password", $passwordValue, PDO::PARAM_STR);
        }
        else {
            $statement->bindValue(":".$attributes[0][$i], $attributes[1][$i], PDO::PARAM_INT);
        }
    }

    return $statement->execute();
}

static private function checkAndHashPassword(string $pw): string {
    return (strlen($pw) < 60) ? password_hash($pw, PASSWORD_BCRYPT) : $pw;
}

static public function update(object $object): bool {
    $pdo = ConnexionBD::getInstance();

    $sql = "UPDATE User 
            SET firstName = :firstName, 
                lastName = :lastName, 
                email = :email, 
                password = :password, 
                phone = :phone, 
                address = :address, 
                role = :role
            WHERE id = :id";

    $statement = $pdo->prepare($sql);
    
    try {
        $attributes = $object->getAllAttributes();
        $userId = $object->getId();
    }
    catch (Exception $e) {
        return false;
    }

    $statement->bindValue(":id", $userId, PDO::PARAM_INT);

    for ($i = 0; $i < 7; $i++) {
        // il me semble le User constructor ne prendrait pas null comme param pour Role
        if ($attributes[0][$i] == 'role') {
            $statement->bindValue(":role", $attributes[1][$i]->getId(), PDO::PARAM_INT);
        }
        else if ($attributes[0][$i] == 'password') {
            $passwordValue = UserDAO::checkAndHashPassword($attributes[1][$i]);
            if (!$passwordValue) { return false; }
            $statement->bindValue(":password", $passwordValue, PDO::PARAM_STR);
        }
        else {
            $statement->bindValue(":".$attributes[0][$i], $attributes[1][$i], PDO::PARAM_INT);
        }
    }

    return $statement->execute();
}
static public function delete(object $object): bool {
    $pdo = ConnexionBD::getInstance();

    try {
        $userId = $object->getId();
    }
    catch (Exception $e) {
        return false;
    }

    $sql = "DELETE FROM User WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $userId);
    return $statement->execute();
}
  
}


?>




