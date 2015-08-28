<h4>Add A New Author</h4>
<form role="form" action="pages/processing/authoradd.php" method="post" id="formbooks" enctype="multipart/form-data">
<div class="row">
  <div class="col-md-6">
      <div class="form-group">
        <label for="Title">Name:</label>
        <input type="text" class="form-control" id="name" name="name">
      </div>
     
  </div>
  <div class="col-md-6">
       <div class="form-group">
        <label for="Title">Description:</label>
          <textarea class="form-control" type="text" name="description" id="description"></textarea>
      </div>    
  </div>
</div>
<div class ="row">
  <div class="col-md-12">
    <div class="form-group">
        <label for="Title">Picture:</label>
          <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
      </div>    
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <span id="errMessage"></span>
    <input type="submit" value="Add Author" id="submit" class="form-control blue" name="submit">
  </div>
</div>
</form>