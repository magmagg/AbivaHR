<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		<div class="col-sm-4 dialogs">
			<div class="clearfix">
				<?php foreach($users as $u):?>
					<?php if($u->user_id == $this->session->userdata['id']):?>
					<?php else:?>
				<div class="itemdiv memberdiv">
					<div class="user">
						<img alt="Alexa Doe's avatar" style="max-height:60px;" src="<?=$u->user_picture?>" />
					</div>

					<div class="body">
						<div class="name">
							<?=$u->user_firstname?> <?=$u->user_lastname?>
						</div>


						<div id="appendspan<?=$u->user_id?>">
							<button data-senderid="<?=$this->session->userdata['id']?>" data-receiverid="<?=$u->user_id?>" data-firstname="<?=$u->user_firstname?>" data-lastname="<?=$u->user_lastname?>" class="btn btn-minier btn-success loadchat"><i class="ace-icon fa fa-comments-o"></i>Chat</button>
							<?php foreach($unread as $key => $value): ?>
								<?php if($u->user_id == $value[0]->sender_id): ?>
								<span class="label label-danger label-sm" id="span<?=$u->user_id?>">Unread</span>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			<?php endif;?>
				<?php endforeach; ?>
			</div>
		</div>

		<div class="col-sm-8">

			<audio id="notif_audio">
				<source src="<?php echo base_url('assets/sounds/notify.ogg');?>" type="audio/ogg">
				<source src="<?php echo base_url('assets/sounds/notify.mp3');?>" type="audio/mpeg">
				<source src="<?php echo base_url('assets/sounds/notify.wav');?>" type="audio/wav">
			</audio>

								<div id="spinner" class="col-md-7">
									<center> <img width="150" height="150" src="<?php echo base_url();?>assets/img/myloading.gif"> </center>
								</div>
			<div class="widget-body">
				<div class="widget-main no-padding" id="loadingdiv">

				</div>
				<!-- /.widget-main -->
			</div>
			<!-- /.widget-body -->

		</div>


		<!-- PAGE CONTENT ENDS -->
	</div>
	<!-- /.col -->
</div>
<!-- /.row -->
</div>
<!-- /.page-content -->
</div>
</div>
<!-- /.main-content -->

<div class="footer">
	<div class="footer-inner">
		<div class="footer-content">
			<span class="bigger-120">
  <span class="blue bolder">Ace</span> Application &copy; 2013-2014
			</span>

			&nbsp; &nbsp;
			<span class="action-buttons">
  <a href="#">
    <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
  </a>

  <a href="#">
    <i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
  </a>

  <a href="#">
    <i class="ace-icon fa fa-rss-square orange bigger-150"></i>
  </a>
</span>
		</div>
	</div>
</div>

<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
	<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
</a>
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

<script src="<?php echo base_url(); ?>node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>
<!-- ace scripts -->
<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->
<script>
$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
			var dataString = {
				sender_id: $("#sender_id").val(),
				receiver_id: $("#receiver_id").val(),
				message: $("#message").val()
			};

			console.log(dataString);
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('Chat/send_message');?>",
				data: dataString,
				dataType: "json",
				cache: false,
				success: function(data) {
					$("#message").val('');
					if (data.success == true) {

						$("#notif").html(data.notif);

						var socket = io.connect('http://' + window.location.hostname + ':3000');

						socket.emit('new_count_message', {
							new_count_message: data.new_count_message
						});

						socket.emit('new_message', {
							sender_id: data.sender_id,
							receiver_id: data.receiver_id,
							created_at: data.created_at,
							message: data.message,
							user_picture: data.user_picture
						});

					} else if (data.success == false) {
						$("#message").val(data.message);

					}

				},
				error: function(xhr, status, error) {
					alert(error);
				},

			});
      return false;
    }
  });
});
</script>
<script>
function load_socket()
{
	$(document).ready(function() {
		$("#submit").on("click", function() {
			var dataString = {
				sender_id: $("#sender_id").val(),
				receiver_id: $("#receiver_id").val(),
				message: $("#message").val()
			};

			console.log(dataString);
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('Chat/send_message');?>",
				data: dataString,
				dataType: "json",
				cache: false,
				success: function(data) {
					$("#message").val('');
					if (data.success == true) {

						$("#notif").html(data.notif);

						var socket = io.connect('http://' + window.location.hostname + ':3000');

						socket.emit('new_count_message', {
							new_count_message: data.new_count_message
						});

						socket.emit('new_message', {
							sender_id: data.sender_id,
							receiver_id: data.receiver_id,
							created_at: data.created_at,
							message: data.message,
							user_picture: data.user_picture
						});

					} else if (data.success == false) {
						$("#message").val(data.message);

					}

				},
				error: function(xhr, status, error) {
					alert(error);
				},

			});

		});

	});
}
</script>

<script>
	var socket = io.connect('http://' + window.location.hostname + ':3000');

	socket.on('new_count_message', function(data) {

		//$( "#new_count_message" ).html( data.new_count_message );

	});
	/*
	  socket.on( 'update_count_message', function( data ) {

	      $( "#new_count_message" ).html( data.update_count_message );

	  });
	*/
	socket.on('new_message', function(data) {
		console.log(data);
		if(data.receiver_id == "<?=$this->session->userdata['id']?>" || $("#message-tbody").hasClass("openchat"+data.sender_id))
		{
			$("#appendhere").append('<div class="itemdiv dialogdiv">' +
				'<div class="user">' +
				'<img alt="" style="max-height:55px;" src="'+data.user_picture+'" />' +
				'</div>' +
				'<div class="body">' +
				'<div class="time">' +
				'<i class="ace-icon fa fa-clock-o"></i>' +
				'<span class="green">' + data.created_at + '</span>' +
				'</div>' +
				'<div class="text">' + data.message + '</div>' +
				'</div>' +
				'</div>');
				if(data.receiver_id == "<?=$this->session->userdata['id']?>")
				{
					$('#notif_audio')[0].play();
					if($('#span'+data.sender_id).length)
					{

					}
					else
					{
						$("#appendspan"+data.sender_id).append('<span class="label label-danger label-sm" id="span'+data.sender_id+'">Unread</span>');
					}
				}
		}
		//  $( "#no-message-notif" ).html('');
		//    $( "#new-message-notif" ).html('<div class="alert alert-success" role="alert"> <i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>New message ...</div>');
	});
</script>
<script>
	$(document).ready(function() {
		$('#spinner').hide();
	});
</script>
<!--
<script>
		function load_chat(sender_id, receiver_id) {
			$('#spinner').show(0);
			$("#span"+receiver_id).fadeOut('slow', function(){
				$("#span"+receiver_id).remove();
			});
			$('#loadingdiv').fadeOut('fast', function() {
				$('#loadingdiv').empty();
				$("#loadingdiv").load('<?php echo base_url().'Chat/load_chat/'; ?>' + sender_id + '/' + receiver_id,{fname: firstname, lname: lastname}
					function() {
						$('#spinner').hide();
						$('#loadingdiv').fadeIn('slow');
						$('#message-tbody').addClass('dropdown-content');
						scrollme();
						load_socket();
					});
			});
		}
</script>
-->

<script>
$('.loadchat').click(function() {
var sender_id = $(this).attr('data-senderid');
var receiver_id = $(this).attr('data-receiverid');
var firstname =$(this).attr('data-firstname');
var lastname = $(this).attr('data-lastname');
$('#spinner').show(0);
$("#span"+receiver_id).fadeOut('slow', function(){
	$("#span"+receiver_id).remove();
});
$('#loadingdiv').fadeOut('fast', function() {
	$('#loadingdiv').empty();
	$("#loadingdiv").load('<?php echo base_url().'Chat/load_chat/'; ?>' + sender_id + '/' + receiver_id,{fname: firstname, lname: lastname},
		function() {
			$('#spinner').hide();
			$('#loadingdiv').fadeIn('slow');
			$('#message-tbody').addClass('dropdown-content');
			scrollme();
			load_socket();
		});
});
});
</script>

<script>
function scrollme()
{
$('.dialogs,.comments').ace_scroll({
					size: 500
			    });
}
</script>
</body>

</html>
