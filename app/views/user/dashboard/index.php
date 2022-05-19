<?php
require_once APPROOT.'/views/includes/user/header.php';
?>

<style type="text/css">
	#home-section{
		display: flex;
		flex-wrap: wrap;
		width: 90%;
		max-width: 700px;
		justify-content: center;
		margin:100px auto;
	}
	#home-section>a{
		width:200px;
		height:150px;
		margin:5px;
		border-radius: 5px;
		background:var(--theme-color-one);
		box-shadow: 0 0 5px 3px #f2f2f2;
		transition: .11s
		
	}
	#home-section>a>div{
		height: 70%;
		padding:10px
	}
	#home-section>a>div>i{
		font-size:6em;
		opacity: .4
	}
	#home-section>a>h1{
		text-align: right;
		color: white;
		padding:8px;
	}
	#home-section>a:hover{
		transform: scale(1.01);
		cursor: pointer;
	}

</style>
<section id="home-section">
<?php
if(in_array('P1',USER_PRIV)){
?>
	<a href="../user/masters/dashboard">
		
		<div><i class="fa fa-user"></i></div>
		<h1>Masters</h1>
	</a>
<?php	
}
?>	

</section>



<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>