<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->

		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS -->
				<div class="col-sm-12">
					<div class="widget-box">
						<div class="widget-header">
							<h4 class="widget-title lighter smaller">
											<i class="ace-icon fa fa-comment blue"></i>
											Conversation
										</h4>
						</div>
						<audio id="notif_audio"><source src="<?php echo base_url('assets/sounds/notify.ogg');?>" type="audio/ogg"><source src="<?php echo base_url('assets/sounds/notify.mp3');?>" type="audio/mpeg"><source src="<?php echo base_url('assets/sounds/notify.wav');?>" type="audio/wav"></audio>

						<div class="widget-body">
							<div class="widget-main no-padding">
								<div class="dialogs" id="message-tbody">
									<!-- DIALOGS HERE -->
									<?php foreach($messages as $m): ?>
									<div class="itemdiv dialogdiv">
										<div class="user">
											<img alt="Alexa's Avatar" src="assets/images/avatars/avatar1.png" />
										</div>

										<div class="body">
											<div class="time">
												<i class="ace-icon fa fa-clock-o"></i>
												<span class="green"><?=$m->created_at?></span>
											</div>

											<div class="name">
												<a href="#"><?=$m->name?></a>
											</div>
											<div class="text"><?=$m->message?></div>

										</div>
									</div>
								<?php endforeach;?>
										<!-- DIALOGS HERE -->
								</div>

								<form>
									<div class="form-actions">
										<div class="input-group">
											<input placeholder="Type your message here ..." type="text" class="form-control" name="name" id="name" />
											<input placeholder="Type your message here ..." type="text" class="form-control" name="email" id="email" />
											<input placeholder="Type your message here ..." type="text" class="form-control" name="subject" id="subject" />
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


							</div>
							<!-- /.widget-main -->
						</div>
						<!-- /.widget-body -->
					</div>
					<!-- /.widget-box -->
				</div>
				<!-- /.col -->

			</div>

		</div>
		<!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if ('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
		</script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>



		<!-- page specific plugin scripts -->
		<script src="<?php echo base_url(); ?>assets/js/pnotify.custom.min.js"></script>
		<script src="<?php echo base_url(); ?>node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>
		<!-- ace scripts -->
		<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>
<script>				$('.dialogs,.comments').ace_scroll({
					size: 300
			    });


</script>
		<script>
  $(document).ready(function(){
    $("#submit").click(function(){
			var dataString = {
						 name : $("#name").val(),
						 email : $("#email").val(),
						 subject : $("#subject").val(),
						 message : $("#message").val()
					 };


            console.log(dataString);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Admin/send_message');?>",
            data: dataString,
            dataType: "json",
            cache : false,
            success: function(data){

              $("#name").val('');
              $("#email").val('');
              $("#subject").val('');
              $("#message").val('');
              if(data.success == true){

                $("#notif").html(data.notif);

                var socket = io.connect( 'http://'+window.location.hostname+':3000' );

                socket.emit('new_count_message', {
                  new_count_message: data.new_count_message
                });

                socket.emit('new_message', {
                  name: data.name,
                  email: data.email,
                  subject: data.subject,
                  created_at: data.created_at,
                  id: data.id,
									message: data.message
                });

              } else if(data.success == false){

                $("#name").val(data.name);
                $("#email").val(data.email);
                $("#subject").val(data.subject);
                $("#message").val(data.message);
                $("#notif").html(data.notif);

              }

            } ,error: function(xhr, status, error) {
              alert(error);
            },

        });

    });

  });
	</script>

	<script>
    var socket = io.connect( 'http://'+window.location.hostname+':3000' );

  socket.on( 'new_count_message', function( data ) {

      //$( "#new_count_message" ).html( data.new_count_message );
      $('#notif_audio')[0].play();

  });
/*
  socket.on( 'update_count_message', function( data ) {

      $( "#new_count_message" ).html( data.update_count_message );

  });
*/
  socket.on( 'new_message', function( data ) {
		console.log(data);
      $( "#message-tbody" ).prepend('<div class="itemdiv dialogdiv">'+
					'<div class="user">'+
						'<img alt="" src="assets/images/avatars/avatar1.png" />'+
					'</div>'+
					'<div class="body">'+
						'<div class="time">'+
							'<i class="ace-icon fa fa-clock-o"></i>'+
							'<span class="green">'+data.created_at+'</span>'+
						'</div>'+
						'<div class="name">'+
							'<a href="#">'+data.name+'</a>'+
						'</div>'+
						'<div class="text">'+data.message+'</div>'+
					'</div>'+
				'</div>');
    //  $( "#no-message-notif" ).html('');
  //    $( "#new-message-notif" ).html('<div class="alert alert-success" role="alert"> <i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>New message ...</div>');
  });

</script>

		</body>

		</html>
