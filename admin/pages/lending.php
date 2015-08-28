<div class="dashtitle">
	<h2>Lending</h2>
</div><br/>
<h4>Lend book</h4>
<form role="form" action="pages/processing/lends.php" method="post" id="formbooks">
<div class="row">
  <div class="col-md-6">
      <div class="form-group">
        <label for="Title">Copy ID:</label>
        <input type="id" class="form-control" id="copyid" name="copyid">
      </div>
  </div>
  <div class="col-md-6">
       <div class="form-group">
        <label for="Title">User ID:</label>
        <input type="title" class="form-control" id="language" name="userid">
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <span id="errMessage"></span>
    <input type="submit" value="Lend Book" id="submit" class="form-control blue" name="submit">
  </div>
</div>
</form>
<br/>
