<?php
require_once 'model/DataHandler.php';

class BeheerderLogic
{

  public function __construct()
  {
    $this->DataHandler = new DataHandler("localhost", "mysql", "afspraakplanner", "root", "");
  }
  public function __destruct()
  { }

  public function readZzpers()
  {
    try {
      $sql = "SELECT * FROM zzper";
      $result = $this->DataHandler->readsData($sql);
      return $result;
    } catch (exception $e) {
      throw $e;
    }
  }

  public function readZzper($id)
  {
    try {
      $sql = "SELECT * FROM zzper WHERE zzper_id = $id";
      $result = $this->DataHandler->readData($sql);
      return $result;
    } catch (exception $e) {
      throw $e;
    }
  }

  public function createZzper($formData)
  {
    $username = $formData['username'];
    $password = $formData['password'];

    try {
      $sql = "INSERT INTO zzper (zzper_id, username, password) VALUES ('', '$username', '$password')";
      $result = $this->DataHandler->createData($sql);
      return $result ? "De zzp-er is succesvol toegevoegd!" : "Het toevoegen van de zzp-er is niet gelukt";
    } catch (exception $e) {
      throw $e;
    }
  }

  public function updateZzper($formData)
  {
    $id = $formData['id'];
    $username = $formData['username'];
    $password = $formData['password'];

    try {
      $sql = "UPDATE zzper SET 
      username = '$username', password = '$password' 
      WHERE zzper_id = '$id'";
      $result = $this->DataHandler->updateData($sql);
      return $result ? "De zzp-er is succesvol bewerkt!" : "Het bewerken van de zzp-er is niet gelukt";
    } catch (exception $e) {
      throw $e;
    }
  }

  public function deleteZzper($id)
  {
    try {
      $sql = "DELETE FROM zzper WHERE zzper_id = " . $id;
      $result = $this->DataHandler->deleteData($sql);
      return $result ? "Zzper is succesvol verwijderd" : "Het verwijderen van de zzper is helaas niet gelukt";
    } catch (exception $e) {
      throw $e;
    }
  }
}
