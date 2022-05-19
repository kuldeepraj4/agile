<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<base href="<?php echo URLROOT; ?>">
	<link rel="icon" href="images/favicon.png" type="img/png" sizes="16x16">
	<link rel="stylesheet" type="text/css" href="css/basic.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<script type="text/javascript" src="assets/jquery/jquery.js"></script>
	<link href="assets/fontawesome/css/all.css" rel="stylesheet">
</head>
<body>
	<?php require_once APPROOT.'/views/includes/common/url-func.php'; ?>

	<div id="login-page">
		<div class="loginBoxOut">

			<div class="loginBox">
				<div id="login-back">
					<div class="login-back-image-cover">
						<img src="images/logo-square.png">
					</div>
					
				</div>
				<div style="min-height: 350px;">
					
					

					<div style="" id="login-form">
						<form id='MyForm' onsubmit="return get_password()" style="padding: 15px;">
							<h1>Forgot Password</h1>
							<p id="formErro"></p>
							<br>	
							<label></label>
							<input type="text" pattern="[0-9A-Za-z]{3,}" name="username" placeholder="Please enter username" autofocus required>
							<br>
							<div><button type="submit"  id='main-btn' class="btn-full-width" style="color: white">Get Password</button></div>
							<div style="display: none;"><button type="submit"  id='loading-btn'><i class="fa fa-spinner fa-spin"></i> Wait....</button></div>
							<div id="login-options">
								<div><span><a href="../login">Login</a></span></div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function message(message,status){
			if(status){
				$('#formErro').html(`<span style="color:green">`+message+`</span>`)
			}else{
				$('#formErro').html(`<span style="color:red">`+message+`</span>`)
			}
			setTimeout(function(){
				$('#formErro').fadeOut()
			},3000)
		}
		function get_password(){
			$('#formErro').show()
			var form = document.getElementById('MyForm');
			var isValidForm = form.checkValidity();
			var currentForm = $('#MyForm')[0];
			var formData=new FormData(currentForm);
			if(isValidForm){
				var arr=$('#MyForm').serializeArray();
				var obj={}
				for(var a=0;a<arr.length;a++ ){
					obj[arr[a].name]=arr[a].value
				}
				$.ajax({

					url:window.location.href+'-action',
					type:'POST',
					data:obj,
					beforeSend:function(){
						$('#main-btn').hide()
						$('#formErro').html('<span style="color:green"><i class="fa fa-spinner fa-spin"></i> Loading</span>')
					},
					success:function(data){
						if(typeof(data)=='string'){
							data=JSON.parse(data);
						}
						message(data.message,data.status)
						if(data.status){
							$('#MyForm').html(`<span style="color:green;font-weight:bolder">${data.message}</span>`)
						}else{
							$('#main-btn').show()
							$('#formErro').html('<span style="color:red">'+data.message+'</span>')
						}
					},
				})
			}
			return false
		}
	</script>

</body>
</html>