<?php?>
<h4>Add new Publishers</h4>

<form ng-app="dash" name="addpubsform" ng-controller="addPublishersController" role="form" action="pages/processing/pubadd.php" method="post" id="formbooks" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="Title">Publisher</label>
                    <input type="text" class="form-control" id="publisher" name="publisher">
                  </div>
 </div>

 <div class="col-md-6">
              <label for="Title">&nbsp</label>
                <span id="errMessage"></span>
                <input type="submit" value="submit" id="submit" class="form-control blue" name="submit">
             
            </div>

            </div>
 
</form>

