<?php
// Test de la classe DAO
require_once(__DIR__.'/../model/dao.class.php');

try {
  print("Création d'un objet DAO : ");
  $dao = DAO::get();
  print("OK\n");

} catch (Exception $e) {
  exit("\nErreur sur DAO : ".$e->getMessage()."\n");
}

?>
