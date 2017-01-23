<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Create Announcement</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="POST" id="announcement_form" action="<?php echo base_url();?>AdminDept/submit_announcement">
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Title </label>

                        <div class="col-sm-9">
                            <input type="text" name="title" placeholder="Title" class="col-xs-10 col-sm-5" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Content </label>

                        <div class="col-sm-9">
                            <textarea type="text" placeholder="Content" name="content" class="form-control" id="form-field-textarea" required></textarea>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="post_button" class="btn btn-primary">Post</button>
            </div>
        </form>
        </div>
    </div>
</div>
