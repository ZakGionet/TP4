<?php
/**
 * Description : DAO pour la classe User et les tables User et Role

 */

include_once(__DIR__ . "/DAO.interface.php");
include_once(__DIR__ . "/../user.class.php");
include_once(__DIR__ . "/../role.class.php");

class UserDAO implements DAO {
static public function findById(int $id): ?object;
static public function findAll(): array;
static public function findByDescription(string $filter): array;
static public function findByEmail(string $email): ?object;
static public function existsByEmail(string $email): bool;
static public function save(object $object): bool;
static public function update(object $object): bool;
static public function delete(object $object): bool;
  
}


?>




