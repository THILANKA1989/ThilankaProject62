<?php include '../../core/init.php' ?>
<h4>Add A New Magazine</h4>
<form role="form" action="pages/processing/magadd.php" method="post" id="formbooks" enctype="multipart/form-data">
<div class="row">
  <div class="col-md-6">
      <div class="form-group">
        <label for="Title">Title:</label>
        <input type="text" class="form-control" id="title" name="title">
      </div>
     
  </div>
  <div class="col-md-6">
     
       <div class="form-group">
      <label for="Title">Language:</label>
            <select class="form-control" name="language" type="text">
             	<option>Sinhala</option>
             	<option>English</option>
             	<option>Tamil</option>
            </select>
       </div>
  </div>
</div>
<div class ="row">
  <div class="col-md-12">
    <div class="form-group">
        <label for="Title">Cover:</label>
          <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
      </div>    
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <span id="errMessage"></span>
    <input type="submit" value="Add Magazine" id="submit" class="form-control blue" name="submit">
  </div>
</div>
</form>