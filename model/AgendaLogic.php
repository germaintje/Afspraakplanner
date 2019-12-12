<?php
require_once 'model/DataHandler.php';

class AgendaLogic
{

  public function __construct()
  {
    $this->DataHandler = new DataHandler("localhost", "mysql", "afspraakplanner", "root", "");
  }
  public function __destruct()
  { }

  public function agenda()
  {
    require_once "model/config.php";

    //$afspraak_id = filter_input(INPUT_POST, 'afspraak_id');
    //$zzper_id = filter_input(INPUT_POST, 'zzper_id');
    //$klant_id = filter_input(INPUT_POST, 'klant_id');
    //$datum = filter_input(INPUT_POST, 'datum');
    $beschrijving = filter_input(INPUT_POST, 'comment');

        // Attempt insert query execution
        $sql = "INSERT INTO afspraken (zzper_id, klant_id, datum, comment) VALUES ('$afspraak_id', '$zzper_id', '$klant_id', '$datum', '$beschrijving')";
        if(mysqli_query($link, $sql)){
            echo "Records inserted successfully.";
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }

  }
  public function readData()
  {
    require_once "config.php";

    $sql = "SELECT username FROM users where role=1";
                $result = $link->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "naam: " . $row["username"]. "<br>";
                    }
                } else {
                    echo "0 results";
                }
  }


}
