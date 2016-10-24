<!-- Modal -->
<div class="modal fade" id="myModal_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Edit Announcement</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="POST" id="edit_form" action="<?php echo base_url();?>Admin/edit_one_announce">
                  <div class="form-group">

                          <input type="hidden" name="id" id="ann_id" class="col-xs-10 col-sm-5" />
                      </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right"  for="form-field-1"> Title </label>

                        <div class="col-sm-9">
                            <input type="text" name="title" placeholder="Title"  id="title" class="col-xs-10 col-sm-5" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Content </label>

                        <div class="col-sm-9">
                            <textarea type="text" placeholder="Content" name="content" class="form-control" id="form-field-8" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Departments </label>
                        <div class="col-sm-9">
                            <select class="js-example-placeholder-single" style="width:100%;" id="select2" name="departments[]" multiple="multiple" required>

                                <option value=""></option>
                            </select>
                            <input type="button" name="Button" class="btn-success" value="All" id="selectall2"/>
                            <input type="button" name="Button" class="btn-danger" value="Clear" id="selectnone2"/>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="edit_button" class="btn btn-primary">Save</button>
            </div>
        </form>
        </div>
    </div>
</div>
