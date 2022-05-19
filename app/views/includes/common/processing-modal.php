<style type="text/css">
	#processing-modal{
		width: 100vw;
		height: 100vh;
		background: white;
		opacity:.8;
		position: fixed;
		z-index: 5000;
		display: flex;
		justify-content: center;
		align-items: center;
		display: none; 
	}
</style>

<section id="processing-modal">
	<div style="font-size: 2.5em;color: grey"><i class="fa fa-spinner fa-spin"></i> Processing</div>
</section>
<script type="text/javascript">
	function show_processing_modal(){
		$('#processing-modal').css('display','flex');
	}
	function hide_processing_modal(){
		$('#processing-modal').css('display','none');
	}

</script>
