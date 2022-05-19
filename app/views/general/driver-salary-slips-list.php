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
			height:240mm;
			padding:5px
		}
		.mytable{
			border-collapse: collapse;
			width: 100%
		}

		.mytable th,.mytable td{
			text-align: right;
			text-align: center;
		}
		.mytable th{
			background: lightgrey;
			padding: 4px;
		}
		.mytable td{
			padding:1px;
		}
		.mytable tfoot{
			font-weight:bold;
			font-size: 1.1em;
		}
		#bottom{
			position: absolute;
			bottom: 0;
			left: 0;
			right: 0;
			padding:2mm;
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
			<table id="table" class="mytable">
				<thead>
					<tr>
						<th>TRIP ID</th>
						<th>DATE</th>
						<th>TRUCK ID</th>
						<th>MILES</th>
						<th>PAY/MILE</th>
						<th>EARNINGS</th>
					</tr>
				</thead>
				<tbody>

					<tr>
						<td>10001</td>
						<td>06/05/2021</td>
						<td>33545</td>
						<td>450</td>
						<td>0.50</td>
						<td>250</td>
					</tr>
					<tr>
						<td>10015</td>
						<td>06/05/2021</td>
						<td>33545</td>
						<td>50</td>
						<td>0.50</td>
						<td>250</td>
					</tr>
					<tr>
						<td>10025</td>
						<td>06/05/2021</td>
						<td>33545</td>
						<td>95</td>
						<td>0.50</td>
						<td>119</td>
					</tr>
					<tr>
						<td>10030</td>
						<td>06/05/2021</td>
						<td>33545</td>
						<td>100</td>
						<td>0.55</td>
						<td>135</td>
					</tr>
										<tr>
						<td>10032</td>
						<td>06/05/2021</td>
						<td>33545</td>
						<td>1005</td>
						<td>0.50</td>
						<td>340</td>
					</tr>



				</tbody>
				<tfoot>

					<tr>
						<td>TOTAL EARNINGS</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>873</td>
					</tr>
								
				</tfoot>
			</table>
			<style type="text/css">
				#sec-c{
				}
				#sec-c ul{
					display: flex;
					flex-wrap: wrap;
					justify-content: space-between;
					align-items: flex-end;
				}
				#sec-c li{
					width: 40%;
					display: flex;
					align-items: center;
				}
				#sec-c li:nth-child(1),#sec-c li:nth-child(2){
					font-weight: bold
				}
				#sec-c li p{
					padding:0px 1px;
					width: 33%;
					text-align: right;
				}
				#sec-c li p:nth-child(1){
					text-align: left;
					width: 55%;
					padding-left: 8px
				}
			</style>

			<br>

			<section id="sec-c">
				<ul>
					<li>
						<p style="padding-left: 1px">DEDUCTIONS</p>
						<p>CURRENT AMOUNT</p>
						<p>YTD <br>AMOUNT</p>
					</li>
					<li>
						<p>DEDUCTIONS</p>
						<p>CURRENT AMOUNT</p>
						<p>YTD <br>AMOUNT</p>
					</li>

					<li>
						<p>gfgfgfdg</p>
						<p>fg gdf gfdg dfg dfsgfd</p>
						<p>df adf df sdf </p>
					</li>


					<li>
						<p style="padding-left: 1px">TOTAL DEDUCTIONS</p>
						<p></p>
						<p></p>
					</li>
					<li>
						<p></p>
						<p> fs fsdf sadf</p>
						<p>df asdf f dsf adsf</p>
					</li>													
				</ul>
			</section>
			<br>
			<div style="display: flex;width: 100%;font-weight: bolder;">
				<p style="width: 33%">NET PAY</p>
				<p style="width: 33%;text-align: center;">df adf asdfds</p>
				<p style="width: 33%"></p>
			</div>








			<section id="bottom">
				<div style="display: flex;justify-content: flex-end;">
					<p style="width: 70mm;">ASSOCIATE ID : <span> fsadf wdf dsf sdf</span>
					</p>
				</div>

				<h3 style="text-align: center;">NON NEGOTIABLE</h3>


				<style type="text/css">
					#sec-d{
						display: flex;
						flex-wrap: wrap;
						width: 185mm;
					}
					#sec-d>div:nth-child(1){
						display: flex;
						justify-content: center;
						align-items: center;
						flex-direction: column;
						flex-grow: 1;
						min-width: 100mm;
					}
					#sec-d>div:nth-child(2){
						display: flex;
						align-items: flex-start;
						width: 70mm;
					}
					#sec-d>div:nth-child(3){
						min-width: 100mm;
						flex-grow: 1;
					}	
					#sec-d>h3{
						padding-right: 20px;
						padding-bottom: 10px;
						width: 70mm;
					}
					#sec-d>p{
						width: 100%;
						text-align: right;
						padding-right: 20px;		
					}
					.bottom-table{
						width: 100%;
						display: flex;
						flex-wrap: wrap;
						width: 1113px;
						align-items: flex-start;
					}
					.bottom-table li{
						width: 50%;
						height: 18px;
					}
					.bottom-table li:nth-child(odd)::after{
						content: ' : '
					}	
				</style>

				<section id="sec-d">
					<div>
						<div style="border:2px solid blue;margin-left: -110px;">
							<p> gh ghfsgadfg ff d</p>
							<p style="font-weight: bold">ad fadf adf sdf</p>
							<p style="font-weight: bold;white-space: pre;">d fasdf sdfdf</p>
						</div>
					</div>
					<div style="display: flex;">
						<ul class="bottom-table">

							<li>fd f d fadfasdf ds f</li>
							<li>80</li>

						</ul>
					</div>
					<div></div>
					<h3>NET PAY: &nbsp $ <span>dh fkhf kdfk dsf</span></h3>

					<p>NOTIFICATION OF DEPOSIT TO ACCT: 1515616</p>



				</section>
			</section>
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