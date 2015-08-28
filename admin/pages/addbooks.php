<?php include '../../core/init.php' ?>
<h4>Add book Form here</h4>
<form role="form" action="pages/processing/bkadd.php" method="post" id="formbooks" enctype="multipart/form-data">
<div class="row">
  <div class="col-md-6">
      <div class="form-group">
        <label for="Title">Title:</label>
        <input type="title" class="form-control" id="title" name="title">
      </div>
      <div class="form-group">
        <label for="Title">ISBN:</label>
        <input type="title" class="form-control" id="isbn" name="isbn">
      </div>
      <div class="form-group">
        <label for="Title">Publisher:</label>
         <?php $result = mysqli_query($connection,"SELECT name FROM `publishers`"); ?>
              <select class="form-control" name="publisher">
                <option vlaue="nil"><i>select publisher</i></option>
                <?php while ($row=mysqli_fetch_array($result)){
                $value = $row['name']; ?>
                <?php echo "<option value='$value'>" ?><i><?php echo $row['name'] ?></i><?php echo "</option>" ?>
                <?php
                 }  ?> 
            </select>
             <span class="pull-right">Or <a href="#addpublisher">Add  Publisher</a></span>
      </div>
      <div class="date-group">
        <label for="Title">Published Date:</label>
        <input type="date" class="form-control" id="datepub" name="datepub">
      </div>
      <div class="form-group">
      <label for="Title">Location:</label>
      <?php $result = mysqli_query($connection,"SELECT name FROM `locations`"); ?>
              <select class="form-control" name="location">
                <option vlaue="nil"><i>select location</i></option>
                <?php while ($row=mysqli_fetch_array($result)){
                $value = $row['name']; ?>
                <?php echo "<option value='$value'>" ?><i><?php echo $row['name'] ?></i><?php echo "</option>" ?>
                <?php
                 }  ?> 
            </select>
            <span class="pull-right">Or <a href="#/addlocations">Add Location</a></span>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
       <label for="Title">Author:</label>
        <input type="text" class="form-control" id="author" name="author">
    </div>
    <span class="pull-right">Or <a href="#/addauthors">Add Authors</a></span>
    <div class="form-group">
      <label for="Title">Category:</label>
      <?php $result = mysqli_query($connection,"SELECT name FROM `category`"); ?>
              <select class="form-control" name="category">
                <option vlaue="nil"><i>select category</i></option>
                <?php while ($row=mysqli_fetch_array($result)){
                $value = $row['name']; ?>
                <?php echo "<option value='$value'>" ?><i><?php echo $row['name'] ?></i><?php echo "</option>" ?>
                <?php
                 }  ?> 
            </select>
             <span class="pull-right">Or <a href="#/addcategory">Add Category</a></span>
    </div>
     <div class="desciprtion-group">
        <label for="Title">Description:</label>
        <textarea type="title" class="form-control" id="isbn" name="description"></textarea>
     </div>
     <div class="form-group">
        <label for="Title">Price:</label>
        <input type="title" class="form-control" id="price" name="price">
      </div>
      <div class="language-group">
      <label for="Title">Language:</label>
      <?php $result = mysqli_query($connection,"SELECT name FROM `languages`"); ?>
              <select class="form-control" name="language">
                <option vlaue="nil"><i>select language</i></option>
                <?php while ($row=mysqli_fetch_array($result)){
                $value = $row['name']; ?>
                <?php echo "<option value='$value'>" ?><i><?php echo $row['name'] ?></i><?php echo "</option>" ?>
                <?php
                 }  ?> 
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
    <input type="submit" value="Add book" id="submit" class="form-control blue" name="submit">
  </div>
</div>
</form>

<br/>
<h4>Add Copies</h4>

<form role="form" action="pages/processing/cpadd.php" method="post" id="formcopies">
<div class="row">
  <div class="col-md-6">
      <div class="form-group">
        <label for="Title">ISBN:</label>
        <input type="isbn" class="form-control" id="datepub" name="isbn">
      </div>
  </div>
  <div class="col-md-6">
      <div class="form-group">
        <label for="Title">Number of Copies:</label>
        <input type="text" class="form-control" id="datepub" name="cpnum">
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <span id="errMessage"></span>
    <input type="submit" value="Add Copy" id="submit" class="form-control blue" name="submit">
  </div>
</div>
</form>
