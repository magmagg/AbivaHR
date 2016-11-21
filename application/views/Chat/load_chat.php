<div class="widget-header">
  <h4 class="widget-title lighter smaller">
    <i class="ace-icon fa fa-comment blue"></i>
<?=$chatname?>
<!--
      <a onclick="foo()"><button class="btn btn-minier btn-danger pull-right">Delete conversation</button></a>
    -->
  </h4>
</div>


<div class="dialogs openchat<?=$sender_id?>" id="message-tbody">
  <!-- DIALOGS HERE -->
  <?php foreach($message as $m): ?>
    <?php foreach($users as $u):?>
      <?php if($u->user_id == $m->sender_id){$picture = $u->user_picture;} ?>
    <?php endforeach; ?>
  <div class="itemdiv dialogdiv">
    <div class="user">
      <img alt="Alexa's Avatar" style="max-height:55px;" src="<?=$picture?>" />
    </div>

    <div class="body">
      <div class="time">
        <i class="ace-icon fa fa-clock-o"></i>
        <span class="green"><?=$m->created_at?></span>
      </div>

      <div class="text"><?=$m->message?></div>

    </div>
  </div>
<?php endforeach;?>
<div id="appendhere">
</div>
    <!-- DIALOGS HERE -->
</div>

<form>
  <div class="form-actions">
    <div class="input-group">
      <input  type="hidden" class="form-control" name="sender_id" id="sender_id" value="<?=$this->session->userdata['id'];?>" />
      <input type="hidden" class="form-control" name="receiver_id" id="receiver_id" value="<?=$receiver_id?>"/>
      <input placeholder="Type your message here ..." type="text" class="form-control" name="message" id="message" />
      <span class="input-group-btn">
                          <button class="btn btn-sm btn-info no-radius" type="button" id="submit">
                            <i class="ace-icon fa fa-share"></i>
                            Send
                          </button>
                        </span>
    </div>
  </div>
</form>
