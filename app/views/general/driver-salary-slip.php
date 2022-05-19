<!DOCTYPE html>
<html>
<head>
	<title>Salry Slip</title>
</head>
<body>
	<style type="text/css">
		*{
			margin:0;
			padding: 0;
			box-sizing: border-box;
		}
		@font-face{
			font-family: mainfont_a;
			src:url('../../assets/fonts/Barlow/Barlow-Regular.ttf');	
		}

		body{
			--theme-color-one:#0956bfff;
			--theme-color-two:#e5390bff;
			background: lightgrey;
		}
		html{
			scroll-behavior: smooth;
			font-family:calibri;
		}
		ul{
			list-style: none;

		}
		a{
			text-decoration: none;
			color: inherit;
		}
		button{
			padding:.5em 1em;
			border-radius:.2em;
			color: white;
			cursor: pointer;
			border: none;
			outline: none;	
		}
		#main{
			background: white;
			margin:40px auto;
			width: 210mm;
			height: 290mm;
			padding: 10mm;
			font-size: 13px;
			position: relative;
		}
		#sec-a{
			display: flex;
			align-items: center;
			justify-content: space-between;
			padding:
		}
		.sec-aa div{
			width: 200px;
		}
		.sec-aa img{
			max-width: 100%;
			max-height: 100%;
		}
		.sec-ab{
			text-align: center;
		}
		.sec-ab h1{
		}
		.sec-ac{
			border:1px solid black;
			text-align: right;
			padding: 1px 8px
		}
		.sec-ac p{
			margin:5px auto;
		}
		.sec-ac span{
			font-weight: bolder;
		}
		#heading{
			margin-top:18px;
			padding:5px;
			text-align:center;
		}
		#content{
			border:1px solid black;
			border-right: 3px solid black;
			border-bottom: 3px solid black;
			position: relative;
			min-height:240mm;
			padding:5px
		}
	</style>


	<style type="text/css">
  .sec-desc{
  	border:2px solid blue;
  }
  .sec-desc{
    border:1px solid lightgrey;
    margin:5px auto;
    border-radius: 4px;
    overflow: hidden;
  }
  .sec-desc>h2{
    padding: 5px;
    font-weight: normal;
    background: #cfcaca;
    color: #595353;
    font-style: italic;
    font-weight: bold;
    text-align: center;
    font-size: 1em;
    text-align: left;
  }
  .sec-desc>div{
  	    padding: 5px;
  }
  .sec-desc>div>div{
    display: flex;
    border-bottom: 1px solid #faf5f5;
    padding:1px 10px;
    align-items: center;
  }
  .sec-desc>div>div>p:nth-child(1){
    flex-grow: 1;
  }
  .sec-desc>div>div>p:nth-child(2){
    width:45%;
    text-align: right;
  }
  .sec-desc-gap{
  	height: 8px
  }
</style>
	<main id="main">

		<section id="sec-a">
			<div class="sec-aa"><div><img src="images/logo-rect.png"></div></div>
			<div class="sec-ab">
				<h1>FREON LOGISTICS</h1>
				<p>#11, Aadjdf, fjfldj fdfdf jfd dflj fljdfjf fl j</p>
			</div>
			<div class="sec-ac">
				<div>
					<p><span>From Date:</span> 15-May-2021</p>
					<p><span>To Date:</span> 21-May-2021</p>			
				</div>
			</div>
		</section>
		<h2 id="heading"> STATEMENT OF EARNINGS & DEDUCTIONS</h2>
		<div id="content">
  <section class="sec-desc">
  	<h2>Personal Details</h2>
    <div>
      <div><p>Driver ID</p><p><?php echo $data['driver_code']; ?></p></div>
      <div><p>Driver Name</p><p><?php echo $data['driver_name']; ?></p></div>
    </div>
  </section>
<div class="sec-desc-gap"></div>

  <section class="sec-desc">
  	<h2>Trip Details</h2>
    <div>
      <div><p>ID</p><p><?php echo $data['trip_id']; ?></p></div>
      <div><p>Truck Code</p><p><?php echo $data['truck_code']; ?></p></div>
      <div><p>Total Miles</p><p><?php echo $data['trip_total_miles']; ?></p></div>
      <div><p>Stops</p><p><?php echo $data['trip_stops']['stops_names']; ?></p></div>
      <div><p>Start Date</p><p><?php echo $data['start_date']; ?></p></div>
      <div><p>End Date</p><p><?php echo $data['end_date']; ?></p></div>
    </div>
  </section>
<div class="sec-desc-gap"></div>
  <section class="sec-desc">
  	<h2>Basic Earning</h2>
    <div>
      <div><p>Basic Earnings <br>( miles x rate ) <?php echo $data['driver_miles'].' x '.$data['pay_per_mile']; ?></p><p><?php echo $data['basic_earnings']; ?></p></div>
    </div>
  </section>
<div class="sec-desc-gap"></div>
      <?php

      foreach ($data['salary_parameters']['list'] as $salary_parameters) {
        ?>
        <section class="sec-desc"><h2><?php echo $salary_parameters['type']; ?></h2>
        	<div>
        	<?php
        	foreach ($salary_parameters['parameters'] as $parameters) {
?>
      <div><p><?php echo $parameters['name']; ?></p><p><?php echo $parameters['amount']; ?></p></div>
<?php
        	}
        	?>
        </div>
        	</section>
        	<div class="sec-desc-gap"></div>
        <?php
      }

      ?>


		</div>
	</main>
	<div style="padding:25px;text-align: center;">
		<button  style="background: red" type="button" onclick="generate_pdf()"> <i style="font-size: 1.5em" class="fa fa-file-pdf"></i> GENERATE PDF</button>
	</div>


	<script src="../assets/html2pdf.bundle.min.js"></script>
	<script>
		function generate_pdf(){


			var element = document.getElementById('main');
			var opt = {
  //margin:       1,
  filename:     'statement.pdf',
  //image:        { type: 'jpeg', quality: 0.98 },
  html2canvas:  { scale: 3 },
  //jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
};

html2pdf(element,opt);
}

</script>
</body>
</html>