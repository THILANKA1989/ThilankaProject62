<h4>Add new Locations</h4>

<form ng-app="dash" name="addlocform" ng-controller="addLocationsController" role="form" action="pages/processing/locadd.php" method="post" id="formbooks" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="Title">Location 1</label>
                    <input type="text" class="form-control" id="loc2" name="loc2">
                    <input type="hidden" class="form-control" id="id" name="id">
                  </div>
 </div>
 <div class="col-md-6">

                 <div class="form-group">
                    <label for="Title">Location 2</label>
                    <input type="text" class="form-control" id="loc1" name="loc1">
                  </div>
</div>
</div>
<div class="row">
              <div class="col-md-12">
                <span id="errMessage"></span>
                <input type="submit" value="Edit" id="submit" class="form-control blue" name="submit">
              </div>
            </div>
</form>