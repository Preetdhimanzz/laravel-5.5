<div class="modal-dialog">
  <form method="post" action="{{url('update-product')}}" id="update-product">

  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Update Record</h4>
    </div>
    <div class="modal-body">
      <input name="ref" type="hidden" value="{{$id}}">
      <div class="row">
        <div class="form-group col-md-8 col-md-offset-2">
          <label for="name">Name:</label>
          <input type="text" class="form-control" name="name" value="{{$product->name}}">
        </div>
      </div>
      <div class="row">
          <div class="form-group col-md-8 col-md-offset-2">
            <label for="price">Price:</label>
            <input type="text" class="form-control" name="price" value="{{$product->price}}">
          </div>
        </div>
      </div>

    <div class="modal-footer clearfix">
      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
  </div>
  <!-- /.modal-content -->
</form>

</div>
