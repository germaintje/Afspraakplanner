<section class="column">
  <div class="col-md-4">
    <a href="index?op=beheerder"><button>
        <span class="glyphicon glyphicon-arrow-left"></span> Terug
      </button></a>
  </div>

  <div class="col-md-4 thumbnail">
    <h2><strong>Voeg hier een zzp-er toe</strong></h2>
    <form action="index.php?op=createzzp-er" method="post">
      <label>naam zzp-er: </label>
      <input class="form-control" type="text" name="username" required>
      <br />
      <label>wachtwoord: </label>
      <input class="form-control" type="password" name="password" required>
      <br />
      <input type="submit" class="btn" value="Toevoegen">
    </form>
  </div>
</section>