<section class="column">
<div class="col-md-4">
  <a href="index?op=beheerder"><button>
  <span class="glyphicon glyphicon-arrow-left"></span> Terug
</button></a>
</div>
<?php
  $html = "";
  while ($row = $zzper->fetch(PDO::FETCH_ASSOC)) {

    $html .= "<div class='col-md-4 thumbnail'>";
    $html .= "<h2>Bewerk hier <strong>" . $row['username'] . "</strong></h2>";
    $html .= "<p>ID: <strong>" . $row['zzper_id'] . "</strong></p>";
    $html .= "<br />";
    $html .= "<form action='index.php?op=editzzp-er&id=" . $row['zzper_id'] . "'method='post'>";
    $html .= "<label>zzp-er: </label>";
    $html .= "<input class='form-control' type='text' value='" . $row['username'] . "' name='username' required>";
    $html .= "<br />";
    $html .= "<label>wachtwoord: </label>";
    $html .= "<input class='form-control' type='password' value='" . $row['password'] . "' name='password' required>";
    $html .= "<br />";
    $html .= "<input type='submit' class='btn' value='Bewerken'>";
    $html .= "</form>";
    $html .= "</div>";
  }
  echo $html;
?>
</section>