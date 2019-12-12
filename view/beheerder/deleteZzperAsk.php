<section class="column">
  <div class="col-md-4">
    <a href="index?op=beheerder"><button>
        <span class="glyphicon glyphicon-arrow-left"></span> Terug
      </button></a>
  </div>

  <div class="col-md-4 thumbnail">
    <h2><strong>Weet u zeker dat u deze zzper wilt verwijderen?</strong></h2>
    <?php

    $html = "";

    foreach ($zzper as $row) {
      echo "<h2>" . $row['username'] . "</h2>";
      $html .= "<a href='index.php?op=deletezzp-er&id=$row[zzper_id]'>Verwijderen</a>";
      $html .= "<a href='index.php?op=beheerder'>Annuleren</a>";
    }

    echo $html;
    ?>
  </div>
</section>