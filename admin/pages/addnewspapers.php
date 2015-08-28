<?php include '../../core/init.php' ?>
<h4>Add A New Newspaper</h4>
<form role="form" action="pages/processing/paperadd.php" method="post" id="formbooks" enctype="multipart/form-data">
<div class="row">
  <div class="col-md-6">
      <div class="form-group">
        <label for="Title">Title:</label>
        <input type="title" class="form-control" id="title" name="title">
      </div>
  </div>
  <div class="col-md-6">
       <div class="form-group">
        <label for="Title">Language:</label>
        <select type="text" class="form-control" id="language" name="language">
          <option>Select Language</option>
          <option>Sinhala</option>
          <option>Tamil</option>
          <option>English</option>
        </select>
      </div>
  
  </div>
</div>
<div class ="row">
  <div class="col-md-12">
    <div class="form-group">
        <label for="Title">Logo:</label>
          <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
      </div>    
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <span id="errMessage"></span>
    <input type="submit" value="Add Newspaper" id="submit" class="form-control blue" name="submit">
  </div>
</div>
</form>