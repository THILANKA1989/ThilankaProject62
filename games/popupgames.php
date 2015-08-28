
<div class="modal popupbook" id="my_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
          <embed width="800" height="512" base="http://external.kongregate-games.com/gamez/0022/3733/live/" src="http://external.kongregate-games.com/gamez/0022/3733/live/embeddable_223733.swf" type="application/x-shockwave-flash"></embed><br/>Play free games at <a href="http://www.kongregate.com/">Kongregate</a>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
	$(document).ready(function(){
   $(".popupbook").click(function(){ // Click to only happen on announce links
     $("#cafeId").val($(this).data('id'));
     $('#createFormId').modal('show');
   });
});
</script>