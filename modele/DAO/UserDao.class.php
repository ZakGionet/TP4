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

    $sql = "SELECT * 
            FROM User 
            INNER JOIN Role ON User.roleId = Role.roleID
            WHERE UserID = :id";

    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id, PDO::PARAM_INT);
    $statement->execute();

    $data = $statement->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        return new User(
            $data['UserID'],
            $data['firstName'],
            $data['lastName'],
            $data['email'],
            $data['Password'],
            $data['phone'],
            $data['Address'],
            new Role($data['roleID'], $data['roleName']),
        );
    }
    
    return null;

}

static public function findAll(): array {
    $pdo = ConnexionBD::getInstance();

    $sql = "SELECT * FROM User INNER JOIN Role ON User.roleId = Role.roleID";
    $data = $pdo->query($sql);

    $userArr = array();
    if ($data) {
        foreach ($data as $user) {
            $userArr[] = new User(
                $user['UserID'],
                $user['firstName'],
                $user['lastName'],
                $user['email'],
                $user['Password'],
                $user['phone'],
                $user['Address'],
                new Role($user['roleID'], $user['roleName'])
            );
        }
    }
    
    return $userArr;
}

static public function findByDescription(string $filter): array {
    $pdo = ConnexionBD::getInstance();

    $sql = "SELECT * FROM User INNER JOIN Role ON User.roleID = Role.roleID ";

    // this is great I am ok with this
    $sql .= $filter ;


    $query = $pdo->query($sql);

    $data = $query->fetchAll();

    $userArr = array();
    if ($data) {
        foreach ($data as $user) {
            $userArr[] = new User(
                $user['UserID'],
                $user['firstName'],
                $user['lastName'],
                $user['email'],
                $user['Password'],
                $user['phone'],
                $user['Address'],
                new Role($user['roleID'], $user['roleName'])
            );
        }
    }
    
    return array();
}

static public function findByEmail(string $email): ?object {
    $pdo = ConnexionBD::getInstance();

    $sql = "SELECT * FROM User INNER JOIN Role On User.roleID = Role.roleID WHERE email = :email";

    $statement = $pdo->prepare($sql);
    $statement->bindValue(":email", $email, PDO::PARAM_STR);
    $statement->execute();

    $data = $statement->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        return new User(
            $data['UserID'],
            $data['firstName'],
            $data['lastName'],
            $data['email'],
            $data['Password'],
            $data['phone'],
            $data['Address'],
            new Role($data['roleID'], $data['roleName'])
        );
    }
    
    return null;
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
    if (UserDAO::existsByEmail($object->getEmail())) { return false; }

    $pdo = ConnexionBD::getInstance();

    $sql = "INSERT INTO User 
                    (firstName,  lastName,  email,  Password,  phone,  Address,  roleID) 
            VALUES (:firstName, :lastName, :email, :password, :phone, :address, :role)";

    $statement = $pdo->prepare($sql);

    $statement->bindValue(":firstName", $object->getFirstName());
    $statement->bindValue(":lastName", $object->getLastName());
    $hashedPw = $object->getPassword();
    if (strlen($hashedPw) < 60) {
        $hashedPw = password_hash($hashedPw, PASSWORD_BCRYPT);
    }
    if (!$hashedPw) { return false; }
    $statement->bindValue(":password", $object->getPassword());

    $statement->bindValue(":phone", $object->getPhone());
    $statement->bindValue(":address", $object->getAddress());
    $statement->bindValue(":role", ($object->getRole()) ? $object->getRole()->getId() : 3);
    $statement->bindValue(":email", $object->getEmail());

    $execResult = $statement->execute();
    if ($execResult) { 
        if ($object->getRole() == null) { $object->setRole(new Role(3, "Client")); }
        if (strlen($object->getPassword())) { $object->setPassword($hashedPw); }
        $object->setId($pdo->lastInsertId());
    }
    return $execResult;
}

static public function update(object $object): bool {
    $pdo = ConnexionBD::getInstance();

    $sql = "UPDATE User 
            SET firstName = :firstName, 
                lastName  = :lastName, 
                Password  = :password, 
                phone     = :phone, 
                Address   = :address, 
                roleID      = :role
            WHERE email = :email";

    $statement = $pdo->prepare($sql);
    
    // i give up
    $statement->bindValue(":firstName", $object->getFirstName());
    $statement->bindValue(":lastName", $object->getLastName());
    $hashedPw = $object->getPassword();
    if (strlen($hashedPw) < 60) {
        $hashedPw = password_hash($hashedPw, PASSWORD_BCRYPT);
    }
    if (!$hashedPw) { return false; }
    $statement->bindValue(":password", $object->getPassword());

    $statement->bindValue(":phone", $object->getPhone());
    $statement->bindValue(":address", $object->getAddress());
    $statement->bindValue(":role", ($object->getRole()) ? $object->getRole()->getId() : 3);
    $statement->bindValue(":email", $object->getEmail());

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

    $sql = "DELETE FROM User WHERE UserID = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $userId);

    return $statement->execute();
}
  
}


?>




