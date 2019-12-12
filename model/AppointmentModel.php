<?php
class AppointmentModel
{
  public function __construct()
  { }

  public function __destruct()
  { }

  public function search()
  {
    $html = "";

    $html .= "<form method='post' action='index.php?op=search'>";
    $html .= "<input type='text' name='search' style='width: 25%;' placeholder='Search for product name or description'>";
    $html .= "<button type='submit' value='search'><span class='glyphicon glyphicon-search'></span></button>";
    $html .= "</form>";
    return $html;
  }

  public function createTable($Appointments)
  {
    $tableheader = false;
    $html = "";

    $html .= "<table>";

    while ($row = $Appointments->fetch(PDO::FETCH_ASSOC)) {
     // $row['afspraak_tijd'] = '€ ' . str_replace('.', ',', $row['afspraak_tijd']);

      if ($tableheader == false) {
        $html .= "<tr>";
        foreach ($row as $key => $value) {
          $html .= "<th>{$key}</th>";
        }
        $html .= "<th>actions</th>";
        $html .= "</tr>";
        $tableheader = true;
      }
      foreach ($row as $value) {
        $html .= "<td>{$value}</td>";
      }
      $html .= "<td>" . "<a href='index?op=afspraakDetails&id=" . $row['afspraak_id'] . "'><button><span class='glyphicon glyphicon-book'></span> Read</button></a>" . "</td>";
      $html .= "</tr>";
    }
    // for ($i=1; $i <= $pages; $i++) {
    //   echo "<li><div onClick=/'localhost/index.php?op=read&p=".$i/">".$i."'</div></li>";
    // }
    $html .= "</table>";
    return $html;
  }
}