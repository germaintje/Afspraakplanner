<?php
require_once 'model/DataHandler.php';

class AppointmentLogic
{

  public function __construct()
  {
    $this->DataHandler = new DataHandler("localhost", "mysql", "afspraakplanner", "root", "");
  }
  public function __destruct()
  { }

  public function readAppointments()
  {
    try {
      $sql = "SELECT * FROM afspraken";
      $result = $this->DataHandler->readsData($sql);
      return $result;
    } catch (exception $e) {
      throw $e;
    }
  }

  public function readPages($position, $items_per_page)
  {
		$sql = "SELECT * FROM afspraken LIMIT $position,$items_per_page";
		$pages = $this->DataHandler->countPages('SELECT COUNT(*) FROM afspraken');
    $result = $this->DataHandler->readsData($sql);
    return $result;
  }

  // public function searchAppointment($search)
  // {
  //   $search_value = $search["search"];
  //   $sql = "SELECT * FROM Appointments WHERE Appointment_name LIKE '%$search_value%' OR other_Appointment_details LIKE '%$search_value%'";
  //   $result = $this->DataHandler->searchData($sql);
  //   // $result = $this->DataHandler->readsData($sql);
  //   return $result;
  // }

  public function readAppointment($id)
  {
    try {
      $sql = "SELECT * FROM afspraken WHERE afspraak_id = " . $id;
      $result = $this->DataHandler->readsData($sql);
      return $result;
    } catch (exception $e) {
      throw $e;
    }
  }


//   Change to fit your database and/or view
  public function createAppointment($formData)
  {
    $klant_id = 1;
    $zzper_id = 1;

    $comment = $formData["comment"];
    $blok_id = $formData["blok_id"];
    $datum = $formData["datum"];

    try {
      $sql = "INSERT INTO afspraken (afspraak_id, klant_id, zzper_id, comment, blok_id, datum)
        VALUES ('' ,'$klant_id' ,'$zzper_id' ,'$comment' ,'$blok_id' ,'$datum')";
      $result = $this->DataHandler->createData($sql);
      return $result = 1 ? "Afspraak succesvol aangemaakt" : "Er is wat fout gegaan bij het aanmaken van een afspraak";
    } catch (exception $e) {
      throw $e;
    }
  }
}