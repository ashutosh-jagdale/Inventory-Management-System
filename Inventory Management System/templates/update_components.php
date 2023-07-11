<!-- Modal -->
<div class="modal fade" id="form_components" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Components</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="update_component_form" onsubmit="return false">
          <div class="form-row">
            <div class="form-group col-md-12">
            <label>Component name</label>
            <input type="hidden" name="coid" id="coid" value=""/>
            <input type="text" class="form-control" id="update_component" name="update_component" placeholder="Enter component name">
            </div>
          </div>
          <div class="form-group">
            <label>Select Category</label>
            <select type="number" id="select_category" name="select_category" class="form-control" required>
              
            </select>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
            <label>Quantity</label>
            <input type="number" class="form-control" id="component_quantity" name="component_quantity" placeholder="Enter component quanity">
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Update component</button>
        </form>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>