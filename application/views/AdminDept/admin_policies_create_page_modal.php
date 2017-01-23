<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Create page</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="POST" action="<?php echo base_url();?>Admin/create_main_policy_page">
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Page title </label>

                        <div class="col-sm-9">
                            <input type="text" name="title" placeholder="Title" class="col-xs-10 col-sm-5" />
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
