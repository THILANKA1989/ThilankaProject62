<?php?>
<h4>Add new Categories</h4>

<form ng-app="dash" name="addcatform" ng-controller="addCategoriesController" role="form" action="pages/processing/catadd.php" method="post" id="formbooks" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="Title">Category</label>
                    <input type="text" class="form-control" id="category" name="category">
                  </div>
 </div>

 <div class="col-md-6">
              <label for="Title">&nbsp</label>
                <span id="errMessage"></span>
                <input type="submit" value="submit" id="submit" class="form-control blue" name="submit">
             
            </div>

            </div>
 
</form>
