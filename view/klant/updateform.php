<?php
require_once "../../model/config.php";


$id = $_GET["afspraak_id"];

//Define the query
$query = "SELECT * FROM afspraken WHERE afspraak_id= " . $id;

//sends the query to select the entry
$result = mysqli_query($link, $query);

if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
                echo "<form action='update.php?afspraak_id=$id' method='post'>";
                echo "Afspraak ID : " . $id . "<br />";
                echo "<input type='date' name='datum' value='" . $row["datum"] . "'><br />";

                echo "
                        <select class='form-control' name='blok_id'>
                        <option value='1'>9:00 tot 10:00</option>
                        <option value='2'>10:00 tot 11:00</option>
                        <option value='3'>11:00 tot 12:00</option>
                        <option value='4'>12:00 tot 13:00</option>
                        <option value='5'>13:00 tot 14:00</option>
                        <option value='6'>14:00 tot 15:00</option>
                        <option value='7'>15:00 tot 16:00</option>
                        <option value='8'>16:00 tot 17:00</option>
                        <option value='9'>17:00 tot 18:00</option>
                        <option value='10'>18:00 tot 19:00</option>
                        <option value='11'>19:00 tot 20:00</option>
                        <option value='12'>20:00 tot 21:00</option>
                        </select>
                <br />";
                
                echo "<input type='text' name='comment' value='" . $row["comment"] . "'><br />";
                echo "<input type='submit' value='Wijzigen'>";
                echo "</form>";
        }
} else {
        echo "Deze afspraak bestaat niet."  ;  
}

?>