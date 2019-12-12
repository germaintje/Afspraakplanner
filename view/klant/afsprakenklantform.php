<section class="col-md-4 thumbnail">
  <h2>Maak hier een afspraak aan </h2>
  <form action="../../index.php?op=createAppointment" method="post">
    <input class="form-control" type="date" name="datum" placeholder="Datum"><br>
    <select class="form-control" name="blok_id" placeholder="Tijd">
        <option value="1">9:00 tot 10:00</option>
        <option value="2">10:00 tot 11:00</option>
        <option value="3">11:00 tot 12:00</option>
        <option value="4">12:00 tot 13:00</option>
        <option value="5">13:00 tot 14:00</option>
        <option value="6">14:00 tot 15:00</option>
        <option value="7">15:00 tot 16:00</option>
        <option value="8">16:00 tot 17:00</option>
        <option value="9">17:00 tot 18:00</option>
        <option value="10">18:00 tot 19:00</option>
        <option value="11">19:00 tot 20:00</option>
        <option value="12">20:00 tot 21:00</option>
    </select>    
    <br>
    <input class="form-control" type="text" name="comment" placeholder="Beschrijving"><br>
    <br>
    <input type="submit" class="btn" value="Afspraak maken">
  </form>
</section>