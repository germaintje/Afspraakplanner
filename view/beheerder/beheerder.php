<section>
  <a href="index?op=createzzp-erForm">
    <button>
      <span class="glyphicon glyphicon-plus"></span>
      zzp-er toevoegen
    </button>
  </a>

  <?php
  $html = "";
  $html .= "<table>";
  $html .= "<tr><th>zzp-ers</th></tr>";

  while ($row = $zzpers->fetch(PDO::FETCH_ASSOC)) {
    $html .= "<tr>";
    $html .= "<td>$row[username]</td>";
    $html .= "<td><a href='index?op=editzzp-erForm&id=$row[zzper_id]'><button><span class='glyphicon glyphicon-pencil'></span> Bewerken</button></a></td>";
    $html .= "<td><a href='index?op=deletezzp-erAsk&id=$row[zzper_id]'><button><span class='glyphicon glyphicon-remove'></span> Verwijderen</button></a></td>";
    $html .= "</tr>";
  }

  $html .= "</table>";
  echo $html;
  ?>

</section>