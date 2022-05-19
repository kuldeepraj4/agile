<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<script type="text/javascript" src="js/Chart.min.js"></script>
<br>
<style type="text/css">
  [data-my-box] {
    width: 100px;
    height: 100px;
  }
  .header-font-size-text {
    font-size: inherit!important;
    background: #486e94!important;
    color: white!important;
    padding: 5px!important;
    width: 100%!important;
    text-align:center!important;
    margin-bottom: 10px!important;
  }
  .header-font-size-text-second {
    font-size: inherit!important;
  }
  #graphCanvas-ClassWise {
    margin: auto;
  }
</style>
<h1></h1>
<br>
<section class="shadow-1" style="width: 100%!important;">
  <section class="i-boxes-cover">
    <div style="width: 50%;margin-left: 7px;margin-top: 10px;">

      <section class="i-boxes shadow" style="margin-bottom: 16px;height: 706px;">
        <h1 class="header-font-size-text">Class Wise Repair Order Count</h1>
        <div id="chart-container-ClassWise" style="width: 100% height: 100%;">
          <canvas id="graphCanvas-ClassWise"></canvas>
        </div>
      </section>

      <section class="i-boxes shadow" style="margin-bottom: 16px;height: 600px;padding-bottom: 173px;">
        <h1 class="header-font-size-text">Stage Wise Repair Order Count</h1>
        <div class="field-p" style="text-align: center;">
          <label>Unit Type</label>
          <select name="unit_type_id" onchange="showGraph_StageWise()"></select>
        </div>
        <div id="chart-container-stagewise" style="width: 100% height: 100%;">
          <canvas id="graphCanvas-stagewise"></canvas>
        </div>
      </section>

      <section class="i-boxes shadow-1" style="margin-bottom: 16px;height: 600px;">
        <h1 class="header-font-size-text">Trucks Located At Vendor</h1>
        <div id="chart-container" style="width: 100% height: 100%;">
          <canvas id="graphCanvas"></canvas>
        </div>
      </section>

      <section class="i-boxes shadow-1" style="margin-bottom: 16px;;height: 600px;">
        <h1 class="header-font-size-text">Trucks Under Repair</h1>
        <div id="chart-container-1" style="width: 100% height: 100%;">
          <canvas id="graphCanvas1"></canvas>
        </div>
      </section>

      <section class="i-boxes shadow-2" style="margin-bottom: 16px;height: 600px;">
        <h1 class="header-font-size-text">Trucks Under Break Down</h1>
        <div id="chart-container-2" style="width: 100% height: 100%;">
          <canvas id="graphCanvas2"></canvas>
        </div>
      </section>


    </div>
    <div style="width: 49%;margin-left: 4px;margin-top: 10px;">
      <section class="i-boxes shadow-1" style="margin-bottom: 3px;">
        <h1 class="header-font-size-text">Filter</h1>
        <section class="i-boxes-cover" style="width: 214px;background-color: white;">
          <div class="filter-item">
            <label>Time Period </label>
            <select id="time_period" onchange="set_params('time_period', this.value); getRecordsAsPerSelected(this);">
              <option value="ALL" >All</option>
              <option value="TODAY">Today</option>
              <option value="YESTERDAY">Yesterday</option>
              <option value="WEEKLY" >Weekly</option>
            </select>
          </div>
        </section>
      </section>
      <section class="i-boxes shadow-1" style="margin-bottom: 3px;">
        <h1 class="header-font-size-text">Schedule - Truck</h1>
        <section class="i-boxes-cover">
          <div class="i-box" data-my-box style="height: 76px!important;">
            <?php if(in_array('P0228',USER_PRIV)){ ?>
              <a href="../user/maintenance/repair-orders?class_id=SCHEDULE&vehicle_type=TRUCK&status_id=">
            <?php }else{ ?>
             <a href="JavaScript:void(0)">
            <?php } ?>
              <h2>ALL</h3>
                <h1 data-repair-order-truck-schedule-all><i class="fa fa-spinner fa-spin"></i></h1>
              </a>
            </div>
            <div class="i-box" data-my-box style="height: 76px!important;">
              <?php if(in_array('P0228',USER_PRIV)){ ?>
                  <a href="../user/maintenance/repair-orders?class_id=SCHEDULE&vehicle_type=TRUCK&status_id=OPEN">
                <?php }else{ ?>
                   <a href="JavaScript:void(0)">
                <?php } ?>
                <h2>OPEN</h3>
                  <h1 data-repair-order-truck-schedule-open><i class="fa fa-spinner fa-spin"></i></h1>
                </a>
              </div>
              <div class="i-box" data-my-box style="height: 76px!important;">
                <?php if(in_array('P0228',USER_PRIV)){ ?>
                  <a href="../user/maintenance/repair-orders?class_id=SCHEDULE&vehicle_type=TRUCK&status_id=CLOSED">
                <?php }else{ ?>
                   <a href="JavaScript:void(0)">
                <?php } ?>
                  <h2>CLOSED</h3>
                    <h1 data-repair-order-truck-schedule-closed><i class="fa fa-spinner fa-spin"></i></h1>
                  </a>
                </div>
                <div class="i-box" data-my-box style="height: 76px!important;">
                  <?php if(in_array('P0228',USER_PRIV)){ ?>
                    <a href="../user/maintenance/repair-orders?class_id=SCHEDULE&vehicle_type=TRUCK&status_id=RESOLVED">
                  <?php }else{ ?>
                   <a href="JavaScript:void(0)">
                  <?php } ?>
                    <h2>RESOLVED</h3>
                      <h1 data-repair-order-truck-schedule-resolved><i class="fa fa-spinner fa-spin"></i></h1>
                    </a>
                  </div>
                  <div class="i-box" data-my-box style="height: 76px!important;">
                    <?php if(in_array('P0228',USER_PRIV)){ ?>
                      <a href="../user/maintenance/repair-orders?class_id=SCHEDULE&vehicle_type=TRUCK&status_id=RFC">
                    <?php }else{ ?>
                      <a href="JavaScript:void(0)">
                    <?php } ?>
                      <h2>RFC</h3>
                        <h1 data-repair-order-truck-schedule-rfc><i class="fa fa-spinner fa-spin"></i></h1>
                      </a>
                    </div>
                  </section>
                </section>

                <section class="i-boxes shadow-1" style="margin-bottom: 3px;">
                  <h1 class="header-font-size-text">Unschedule - Truck </h1>
                  <section class="i-boxes-cover">
                    <div class="i-box" data-my-box style="height: 76px!important;">
                      <?php if(in_array('P0228',USER_PRIV)){ ?>
                          <a href="../user/maintenance/repair-orders?class_id=UNSCHEDULE&vehicle_type=TRUCK&status_id=">
                      <?php }else{ ?>
                          <a href="JavaScript:void(0)">
                      <?php } ?>
                        <h2>ALL</h3>
                          <h1 data-repair-order-truck-unschedule-all><i class="fa fa-spinner fa-spin"></i></h1>
                        </a>
                      </div>
                      <div class="i-box" data-my-box style="height: 76px!important;">
                        <?php if(in_array('P0228',USER_PRIV)){ ?>
                            <a href="../user/maintenance/repair-orders?class_id=UNSCHEDULE&vehicle_type=TRUCK&status_id=OPEN">
                        <?php }else{ ?>
                            <a href="JavaScript:void(0)">
                         <?php } ?>
                          <h2>OPEN</h3>
                            <h1 data-repair-order-truck-unschedule-open><i class="fa fa-spinner fa-spin"></i></h1>
                          </a>
                        </div>
                        <div class="i-box" data-my-box style="height: 76px!important;">
                          <?php if(in_array('P0228',USER_PRIV)){ ?>
                              <a href="../user/maintenance/repair-orders?class_id=UNSCHEDULE&vehicle_type=TRUCK&status_id=CLOSED">
                          <?php }else{ ?>
                            <a href="JavaScript:void(0)">
                          <?php } ?>
                            <h2>CLOSED</h3>
                              <h1 data-repair-order-truck-unschedule-closed><i class="fa fa-spinner fa-spin"></i></h1>
                            </a>
                          </div>
                          <div class="i-box" data-my-box style="height: 76px!important;">
                            <?php if(in_array('P0228',USER_PRIV)){ ?>
                                <a href="../user/maintenance/repair-orders?class_id=UNSCHEDULE&vehicle_type=TRUCK&status_id=RESOLVED">
                            <?php }else{ ?>
                                <a href="JavaScript:void(0)">
                            <?php } ?>
                              <h2>RESOLVED</h3>
                                <h1 data-repair-order-truck-unschedule-resolved><i class="fa fa-spinner fa-spin"></i></h1>
                              </a>
                            </div>
                            <div class="i-box" data-my-box style="height: 76px!important;">
                                <?php if(in_array('P0228',USER_PRIV)){ ?>
                                  <a href="../user/maintenance/repair-orders?class_id=UNSCHEDULE&vehicle_type=TRUCK&status_id=RFC">
                                <?php }else{ ?>
                                  <a href="JavaScript:void(0)">
                                <?php } ?>
                                <h2>RFC</h3>
                                  <h1 data-repair-order-truck-unschedule-rfc><i class="fa fa-spinner fa-spin"></i></h1>
                                </a>
                              </div>
                            </section>
                          </section>

                          <section class="i-boxes shadow-1" style="margin-bottom: 3px;">
                            <h1 class="header-font-size-text">Schedule - Trailer</h1>
                            <section class="i-boxes-cover">
                              <div class="i-box" data-my-box style="height: 76px!important;">
                                  <?php if(in_array('P0228',USER_PRIV)){ ?>
                                    <a href="../user/maintenance/repair-orders?class_id=SCHEDULE&vehicle_type=TRAILER&status_id=">
                                  <?php }else{ ?>
                                    <a href="JavaScript:void(0)">
                                  <?php } ?>
                                  <h2>ALL</h3>
                                    <h1 data-repair-order-trailer-schedule-all><i class="fa fa-spinner fa-spin"></i></h1>
                                  </a>
                                </div>
                                <div class="i-box" data-my-box style="height: 76px!important;">
                                  <?php if(in_array('P0228',USER_PRIV)){ ?>
                                      <a href="../user/maintenance/repair-orders?class_id=SCHEDULE&vehicle_type=TRAILER&status_id=OPEN">
                                  <?php }else{ ?>
                                      <a href="JavaScript:void(0)">
                                  <?php } ?>
                                    <h2>OPEN</h3>
                                      <h1 data-repair-order-trailer-schedule-open><i class="fa fa-spinner fa-spin"></i></h1>
                                    </a>
                                  </div>
                                  <div class="i-box" data-my-box style="height: 76px!important;">
                                    <?php if(in_array('P0228',USER_PRIV)){ ?>
                                        <a href="../user/maintenance/repair-orders?class_id=SCHEDULE&vehicle_type=TRAILER&status_id=CLOSED">
                                    <?php }else{ ?>
                                      <a href="JavaScript:void(0)">
                                    <?php } ?>
                                      <h2>CLOSED</h3>
                                        <h1 data-repair-order-trailer-schedule-closed><i class="fa fa-spinner fa-spin"></i></h1>
                                      </a>
                                    </div>
                                    <div class="i-box" data-my-box style="height: 76px!important;">
                                      <?php if(in_array('P0228',USER_PRIV)){ ?>
                                          <a href="../user/maintenance/repair-orders?class_id=SCHEDULE&vehicle_type=TRAILER&status_id=RESOLVED">
                                      <?php }else{ ?>
                                          <a href="JavaScript:void(0)">
                                      <?php } ?>
                                        <h2>RESOLVED</h3>
                                          <h1 data-repair-order-trailer-schedule-resolved><i class="fa fa-spinner fa-spin"></i></h1>
                                        </a>
                                      </div>
                                      <div class="i-box" data-my-box style="height: 76px!important;">
                                        <?php if(in_array('P0228',USER_PRIV)){ ?>
                                            <a href="../user/maintenance/repair-orders?class_id=SCHEDULE&vehicle_type=TRAILER&status_id=RFC">
                                        <?php }else{ ?>
                                          <a href="JavaScript:void(0)">
                                        <?php } ?>
                                          <h2>RFC</h3>
                                            <h1 data-repair-order-trailer-schedule-rfc><i class="fa fa-spinner fa-spin"></i></h1>
                                          </a>
                                        </div>
                                      </section>
                                    </section>

                                    <section class="i-boxes shadow-1" style="margin-bottom: 3px;">
                                      <h1 class="header-font-size-text">Unschedule - Trailer</h1>
                                      <section class="i-boxes-cover">
                                        <div class="i-box" data-my-box style="height: 76px!important;">
                                          <?php if(in_array('P0228',USER_PRIV)){ ?>
                                            <a href="../user/maintenance/repair-orders?class_id=UNSCHEDULE&vehicle_type=TRAILER&status_id=">
                                          <?php }else{ ?>
                                            <a href="JavaScript:void(0)">
                                          <?php } ?>
                                            <h2>ALL</h3>
                                              <h1 data-repair-order-trailer-unschedule-all><i class="fa fa-spinner fa-spin"></i></h1>
                                            </a>
                                          </div>
                                          <div class="i-box" data-my-box style="height: 76px!important;">
                                            <?php if(in_array('P0228',USER_PRIV)){ ?>
                                              <a href="../user/maintenance/repair-orders?class_id=UNSCHEDULE&vehicle_type=TRAILER&status_id=OPEN">
                                            <?php }else{ ?>
                                              <a href="JavaScript:void(0)">
                                            <?php } ?>
                                              <h2>OPEN</h3>
                                                <h1 data-repair-order-trailer-unschedule-open><i class="fa fa-spinner fa-spin"></i></h1>
                                              </a>
                                            </div>
                                            <div class="i-box" data-my-box style="height: 76px!important;">
                                              <?php if(in_array('P0228',USER_PRIV)){ ?>
                                                  <a href="../user/maintenance/repair-orders?class_id=UNSCHEDULE&vehicle_type=TRAILER&status_id=CLOSED">
                                              <?php }else{ ?>
                                                <a href="JavaScript:void(0)">
                                              <?php } ?>
                                                <h2>CLOSED</h3>
                                                  <h1 data-repair-order-trailer-unschedule-closed><i class="fa fa-spinner fa-spin"></i></h1>
                                                </a>
                                              </div>
                                              <div class="i-box" data-my-box style="height: 76px!important;">
                                                <?php if(in_array('P0228',USER_PRIV)){ ?>
                                                  <a href="../user/maintenance/repair-orders?class_id=UNSCHEDULE&vehicle_type=TRAILER&status_id=RESOLVED">
                                                <?php }else{ ?>
                                                  <a href="JavaScript:void(0)">
                                                <?php } ?>
                                                  <h2>RESOLVED</h3>
                                                    <h1 data-repair-order-trailer-unschedule-resolved><i class="fa fa-spinner fa-spin"></i></h1>
                                                  </a>
                                                </div>
                                                <div class="i-box" data-my-box style="height: 76px!important;">
                                                  <?php if(in_array('P0228',USER_PRIV)){ ?>
                                                    <a href="../user/maintenance/repair-orders?class_id=UNSCHEDULE&vehicle_type=TRAILER&status_id=RFC">
                                                  <?php }else{ ?>
                                                    <a href="JavaScript:void(0)">
                                                  <?php } ?>
                                                    <h2>RFC</h3>
                                                      <h1 data-repair-order-trailer-unschedule-rfc><i class="fa fa-spinner fa-spin"></i></h1>
                                                    </a>
                                                  </div>
                                                </section>
                                              </section>
                                              <br>

                                              <section class="i-boxes shadow" style="margin-bottom: 16px;height: 600px;padding-bottom: 173px;">
                                                <h1 class="header-font-size-text">Type Wise Repair Order Count</h1>
                                                <div class="field-p" style="text-align: center;">
                                                  <label>Unit Type</label>
                                                  <select name="unit_type_id_1" onchange="showGraph_TypeWise()"></select>
                                                </div>
                                                <div id="chart-container-typewise" style="width: 100% height: 100%;">
                                                  <canvas id="graphCanvas-typewise"></canvas>
                                                </div>
                                              </section>

                                              <section class="i-boxes shadow-TrailersLocatedAtVendor" style="margin-bottom: 16px;height: 600px;">
                                                <h1 class="header-font-size-text">Trailers Located At Vendor</h1>
                                                <div id="chart-container-TrailersLocatedAtVendor" style="width: 100% height: 100%;">
                                                  <canvas id="graphCanvas-TrailersLocatedAtVendor"></canvas>
                                                </div>
                                              </section>

                                              <section class="i-boxes shadow-TrailersUnderRepair" style="margin-bottom: 16px;height: 600px;">
                                                <h1 class="header-font-size-text">Trailers Under Repair</h1>
                                                <div id="chart-container-TrailersUnderRepair" style="width: 100% height: 100%;">
                                                  <canvas id="graphCanvas-TrailersUnderRepair"></canvas>
                                                </div>
                                              </section>

                                              <section class="i-boxes shadow-TrailersUnderBreakDown" style="margin-bottom: 16px;height: 600px;">
                                                <h1 class="header-font-size-text">Trailers Under Break Down</h1>
                                                <div id="chart-container-TrailersUnderBreakDown" style="width: 100% height: 100%;">
                                                  <canvas id="graphCanvas-TrailersUnderBreakDown"></canvas>
                                                </div>
                                              </section>

                                            </section>      
                                          </div>
                                        </section>
                                      </section>

                                      <script type="text/javascript">
                                        get_vehicles().then(function(data) {
                                          if (data.status) {
                                            if (data.response.list) {
                                              var options = "";
                                              options += `<option value="">- - Select - -</option>`
                                              $.each(data.response.list, function(index, item) {
                                                options += `<option value="` + item.id + `">` + item.name + `</option>`;
                                              })
                                              $('[name="unit_type_id"]').html(options);
                                            }
                                          }
                                        })
                                      </script>

                                      <script type="text/javascript">
                                        get_vehicles().then(function(data) {
                                          if (data.status) {
                                            if (data.response.list) {
                                              var options = "";
                                              options += `<option value="">- - Select - -</option>`
                                              $.each(data.response.list, function(index, item) {
                                                options += `<option value="` + item.id + `">` + item.name + `</option>`;
                                              })
                                              $('[name="unit_type_id_1"]').html(options);
                                            }
                                          }
                                        })
                                      </script>

                                      <script type="text/javascript">
                                        function showGraph_ClassWise()
                                        {
                                          var report_name = 'Class Wise Repair Order Count'
                                          $.ajax({
                                            url: location.pathname + '-graph',
                                            type: 'POST',
                                            data: {
                                              report_name: report_name,
                                            },
                                            success: function (data)
                                            {
                                             if ((typeof data) == 'string') {
                                              datas = JSON.parse(data);
                                              var name = [];
                                              var marks = [];
                                              for (var i in datas.response.data) {
                                                name.push(datas.response.data[i].student_name);
                                                marks.push(datas.response.data[i].marks);
                                              }
                                              var chartdata = {
                                                labels: name,
                                                datasets: [
                                                {
                                                  label: report_name,
                                                  backgroundColor: '#002346',
                                                  borderColor: '#46d5f1',
                                                  hoverBackgroundColor: '#CCCCCC',
                                                  hoverBorderColor: '#666666',
                                                  data: marks,
                                                }
                                                ]
                                              };
                                              var options = {
                                                responsive:true,
                                                scales:{
                                                  yAxes:[{
                                                    ticks:{
                                                      min:0
                                                    }
                                                  }]
                                                }
                                              };
                                              var graphTarget = $("#graphCanvas-ClassWise");
                                              var barGraph = new Chart(graphTarget, {
                                                type: 'bar',
                                                data: chartdata,
                                                options: {
                                                  scales: {
                                                    yAxes: [{
                                                      ticks: {
                                                        beginAtZero: true
                                                      }
                                                    }]
                                                  },
                                                  responsive: false,
                                                  maintainAspectRatio: false
                                                }
                                              });
                                            }
                                          }
                                        });
                                        }
                                        showGraph_ClassWise();
                                        var chartEl = document.getElementById("graphCanvas-ClassWise");
                                        chartEl.width = 300;  
                                        chartEl.height = 650; 
                                      </script>

                                      <script type="text/javascript">
                                        function showGraph_StageWise()
                                        {
                                          var report_name = 'Stage Wise Repair Order Count'
                                          var unit_type = $('[name="unit_type_id"]').val()
                                          $.ajax({
                                            url: location.pathname + '-graph',
                                            type: 'POST',
                                            data: {
                                              report_name: report_name,
                                              unit_type:unit_type,
                                            },
                                            success: function (data)
                                            {
                                             if ((typeof data) == 'string') {
                                              datas = JSON.parse(data);
                                              var name = [];
                                              var marks = [];
                                              for (var i in datas.response.data) {
                                                name.push(datas.response.data[i].student_name);
                                                marks.push(datas.response.data[i].marks);
                                              }
                                              var chartdata = {
                                                labels: name,
                                                datasets: [
                                                {
                                                  label: report_name,
                                                  backgroundColor: '#002346',
                                                  borderColor: '#46d5f1',
                                                  hoverBackgroundColor: '#CCCCCC',
                                                  hoverBorderColor: '#666666',
                                                  data: marks,
                                                  fill: false,
                                                  borderWidth: 1
                                                }
                                                ]
                                              };
                                              var options = {
                                                responsive:true,
                                                maintainAspectRatio: false,
                                                scales:{
                                                  yAxes:[{
                                                    ticks:{
                                                      min:0
                                                    }
                                                  }]
                                                }
                                              };
                                              var graphTarget = $("#graphCanvas-stagewise");
                                              if(window.myCharts != undefined)
                                                window.myCharts.destroy();
                                                window.myCharts = new Chart(graphTarget, {
                                                  type: 'bar',
                                                  data: chartdata,
                                                });
                                              }
                                            }
                                          });
                                        }
                                        showGraph_StageWise()  
                                      </script>

                                      <script type="text/javascript">
                                        function showGraph_TypeWise()
                                        {
                                          var report_name = 'Type Wise Repair Order Count'
                                          var unit_type = $('[name="unit_type_id_1"]').val()
                                          $.ajax({
                                            url: location.pathname + '-graph',
                                            type: 'POST',
                                            data: {
                                              report_name: report_name,
                                              unit_type:unit_type,
                                            },
                                            success: function (data)
                                            {
                                             if ((typeof data) == 'string') {
                                              datas = JSON.parse(data);
                                              var name = [];
                                              var marks = [];
                                              for (var i in datas.response.data) {
                                                if(datas.response.data[i].student_name!='Others' && datas.response.data[i].student_name!='IFTA'){ 
                                                  name.push(datas.response.data[i].student_name);
                                                  marks.push(datas.response.data[i].marks);
                                                }
                                              }
                                              var chartdata = {
                                                labels: name,
                                                datasets: [
                                                {
                                                  label: report_name,
                                                  backgroundColor: '#002346',
                                                  borderColor: '#46d5f1',
                                                  hoverBackgroundColor: '#CCCCCC',
                                                  hoverBorderColor: '#666666',
                                                  data: marks,
                                                  fill: false,
                                                  borderWidth: 1
                                                }
                                                ]
                                              };
                                              var options = {
                                                responsive:true,
                                                maintainAspectRatio: false,
                                                scales:{
                                                  yAxes:[{
                                                    ticks:{
                                                      min:0
                                                    }
                                                  }]
                                                }
                                              };
                                              var graphTarget = $("#graphCanvas-typewise");
                                              if(window.barGraph != undefined)
                                                window.barGraph.destroy();
                                                window.barGraph = new Chart(graphTarget, {
                                                type: 'bar',
                                                data: chartdata
                                              });
                                            }
                                          }
                                        });
                                        }
                                        showGraph_TypeWise()  
                                      </script>

                                      <script type="text/javascript">
                                        function showGraph_TrucksAtVendor()
                                        {
                                          var report_name = 'Truck/s Located At Vendor'
                                          $.ajax({
                                            url: location.pathname + '-graph',
                                            type: 'POST',
                                            data: {
                                              report_name: report_name,
                                            },
                                            success: function (data)
                                            {
                                             if ((typeof data) == 'string') {
                                              datas = JSON.parse(data);
                                              var name = [];
                                              var marks = [];
                                              for (var i in datas.response.data) {
                                                name.push(datas.response.data[i].student_name);
                                                marks.push(datas.response.data[i].marks);
                                              }
                                              var chartdata = {
                                                labels: name,
                                                datasets: [
                                                {
                                                  label: report_name,
                                                  backgroundColor: '#002346',
                                                  borderColor: '#46d5f1',
                                                  hoverBackgroundColor: '#CCCCCC',
                                                  hoverBorderColor: '#666666',
                                                  data: marks
                                                }
                                                ]
                                              };
                                              var options = {
                                                responsive:true,
                                                scales:{
                                                  yAxes:[{
                                                    ticks:{
                                                      min:0
                                                    }
                                                  }]
                                                }
                                              };
                                              var graphTarget = $("#graphCanvas");
                                              var barGraph = new Chart(graphTarget, {
                                                type: 'bar',
                                                data: chartdata
                                              });
                                            }
                                          }
                                        });
                                        }
                                        showGraph_TrucksAtVendor()  
                                      </script>

                                      <script type="text/javascript">
                                        function showGraph_TrailersAtVendor()
                                        {
                                          var report_name = 'Trailer/s Located At Vendor'
                                          $.ajax({
                                            url: location.pathname + '-graph',
                                            type: 'POST',
                                            data: {
                                              report_name: report_name,
                                            },
                                            success: function (data)
                                            {
                                             if ((typeof data) == 'string') {
                                              datas = JSON.parse(data);
                                              var name = [];
                                              var marks = [];
                                              for (var i in datas.response.data) {
                                                name.push(datas.response.data[i].student_name);
                                                marks.push(datas.response.data[i].marks);
                                              }
                                              var chartdata = {
                                                labels: name,
                                                datasets: [
                                                {
                                                  label: report_name,
                                                  backgroundColor: '#002346',
                                                  borderColor: '#46d5f1',
                                                  hoverBackgroundColor: '#CCCCCC',
                                                  hoverBorderColor: '#666666',
                                                  data: marks
                                                }
                                                ]
                                              };
                                              var options = {
                                                responsive:true,
                                                scales:{
                                                  yAxes:[{
                                                    ticks:{
                                                      min:0
                                                    }
                                                  }]
                                                }
                                              };
                                              var graphTarget = $("#graphCanvas-TrailersLocatedAtVendor");
                                              var barGraph = new Chart(graphTarget, {
                                                type: 'bar',
                                                data: chartdata
                                              });
                                            }
                                          }
                                        });
                                        }
                                        showGraph_TrailersAtVendor()  
                                      </script>

                                      <script type="text/javascript">
                                        function showGraph_TrucksUnderRepair()
                                        {
                                          var report_name = 'Truck/s Under Repair'
                                          $.ajax({
                                            url: location.pathname + '-graph',
                                            type: 'POST',
                                            data: {
                                              report_name: report_name,
                                            },
                                            success: function (data)
                                            {
                                             if ((typeof data) == 'string') {
                                              datas = JSON.parse(data);
                                              var name = [];
                                              var marks = [];
                                              for (var i in datas.response.data) {
                                                name.push(datas.response.data[i].student_name);
                                                marks.push(datas.response.data[i].marks);
                                              }
                                              var chartdata = {
                                                labels: name,
                                                datasets: [
                                                {
                                                  label: report_name,
                                                  backgroundColor: '#002346',
                                                  borderColor: '#46d5f1',
                                                  hoverBackgroundColor: '#CCCCCC',
                                                  hoverBorderColor: '#666666',
                                                  data: marks
                                                }
                                                ]
                                              };
                                              var options = {
                                                responsive:true,
                                                scales:{
                                                  yAxes:[{
                                                    ticks:{
                                                      min:0
                                                    }
                                                  }]
                                                }
                                              };
                                              var graphTarget = $("#graphCanvas1");
                                              var barGraph = new Chart(graphTarget, {
                                                type: 'bar',
                                                data: chartdata
                                              });
                                            }
                                          }
                                        });
                                        }
                                        showGraph_TrucksUnderRepair()  
                                      </script>

                                      <script type="text/javascript">
                                        function showGraph_TrailersUnderRepair()
                                        {
                                          var report_name = 'Trailer/s Under Repair'
                                          $.ajax({
                                            url: location.pathname + '-graph',
                                            type: 'POST',
                                            data: {
                                              report_name: report_name,
                                            },
                                            success: function (data)
                                            {
                                             if ((typeof data) == 'string') {
                                              datas = JSON.parse(data);
                                              var name = [];
                                              var marks = [];
                                              for (var i in datas.response.data) {
                                                name.push(datas.response.data[i].student_name);
                                                marks.push(datas.response.data[i].marks);
                                              }
                                              var chartdata = {
                                                labels: name,
                                                datasets: [
                                                {
                                                  label: report_name,
                                                  backgroundColor: '#002346',
                                                  borderColor: '#46d5f1',
                                                  hoverBackgroundColor: '#CCCCCC',
                                                  hoverBorderColor: '#666666',
                                                  data: marks
                                                }
                                                ]
                                              };
                                              var options = {
                                                responsive:true,
                                                scales:{
                                                  yAxes:[{
                                                    ticks:{
                                                      min:0
                                                    }
                                                  }]
                                                }
                                              };
                                              var graphTarget = $("#graphCanvas-TrailersUnderRepair");
                                              var barGraph = new Chart(graphTarget, {
                                                type: 'bar',
                                                data: chartdata
                                              });
                                            }
                                          }
                                        });
                                        }
                                        showGraph_TrailersUnderRepair()  
                                      </script>

                                      <script type="text/javascript">
                                        function showGraph_TrucksBreakDown()
                                        {
                                          var report_name = 'Truck/s Under Break Down'
                                          $.ajax({
                                            url: location.pathname + '-graph',
                                            type: 'POST',
                                            data: {
                                              report_name: report_name,
                                            },
                                            success: function (data)
                                            {
                                             if ((typeof data) == 'string') {
                                              datas = JSON.parse(data);
                                              var name = [];
                                              var marks = [];
                                              for (var i in datas.response.data) {
                                                name.push(datas.response.data[i].student_name);
                                                marks.push(datas.response.data[i].marks);
                                              }
                                              var chartdata = {
                                                labels: name,
                                                datasets: [
                                                {
                                                  label: report_name,
                                                  backgroundColor: '#002346',
                                                  borderColor: '#46d5f1',
                                                  hoverBackgroundColor: '#CCCCCC',
                                                  hoverBorderColor: '#666666',
                                                  data: marks
                                                }
                                                ]
                                              };
                                              var options = {
                                                responsive:true,
                                                scales:{
                                                  yAxes:[{
                                                    ticks:{
                                                      min:0
                                                    }
                                                  }]
                                                }
                                              };
                                              var graphTarget = $("#graphCanvas2");
                                              var barGraph = new Chart(graphTarget, {
                                                type: 'bar',
                                                data: chartdata
                                              });
                                            }
                                          }
                                        });
                                        }
                                        showGraph_TrucksBreakDown()  
                                      </script>

                                      <script type="text/javascript">
                                        function showGraph_TrailersBreakDown()
                                        {
                                          var report_name = 'Trailer/s Under Break Down'
                                          $.ajax({
                                            url: location.pathname + '-graph',
                                            type: 'POST',
                                            data: {
                                              report_name: report_name,
                                            },
                                            success: function (data)
                                            {
                                             if ((typeof data) == 'string') {
                                              datas = JSON.parse(data);
                                              var name = [];
                                              var marks = [];
                                              for (var i in datas.response.data) {
                                                name.push(datas.response.data[i].student_name);
                                                marks.push(datas.response.data[i].marks);
                                              }
                                              var chartdata = {
                                                labels: name,
                                                datasets: [
                                                {
                                                  label: report_name,
                                                  backgroundColor: '#002346',
                                                  borderColor: '#46d5f1',
                                                  hoverBackgroundColor: '#CCCCCC',
                                                  hoverBorderColor: '#666666',
                                                  data: marks
                                                }
                                                ]
                                              };
                                              var options = {
                                                responsive:true,
                                                scales:{
                                                  yAxes:[{
                                                    ticks:{
                                                      min:0
                                                    }
                                                  }]
                                                }
                                              };
                                              var graphTarget = $("#graphCanvas-TrailersUnderBreakDown");
                                              var barGraph = new Chart(graphTarget, {
                                                type: 'bar',
                                                data: chartdata
                                              });
                                            }
                                          }
                                        });
                                        }
                                        showGraph_TrailersBreakDown()  
                                      </script>

                                      <script type="text/javascript" src="js/jquery.min.js"></script>
                                      <script type="text/javascript" src="js/Chart.min.js"></script>  

                                      <script type="text/javascript">

                                        function getRecordsAsPerSelected(sel)
                                        {
                                          $.ajax({
                                            url: "<?php echo AJAXROOT; ?>" + 'user/maintenance/dashboard/truck-quick-totals',
                                            type: 'POST',
                                            data: {time_period:check_url_params('time_period')},
                                            beforeSend: function() {
                                              $('#tabledata').html('loading data');
                                            },
                                            success: function(data) {
                                              if ((typeof data) == 'string') {
      // console.log(data)
      data = JSON.parse(data)

      var name = [];
      var marks = [];
      //for (var i in data.response.data) {
        name.push('Test');
        marks.push(data.response.schedule_total);
      //}
      var chartdata = {
        labels: name,
        datasets: [
        {
          label: 'Counts',
          backgroundColor: '#002346',
          borderColor: '#46d5f1',
          hoverBackgroundColor: '#CCCCCC',
          hoverBorderColor: '#666666',
          data: marks
        }
        ]
      };
      var graphTarget = $("#graphCanvas");
      var barGraph = new Chart(graphTarget, {
        type: 'bar',
        data: chartdata
      });


      $('#tabledata').html("");
      if (data.status) {
        //---assign values to i boxes
        $('[data-repair-order-truck-schedule-all]').html(data.response.schedule_total)
        $('[data-repair-order-truck-schedule-open]').html(data.response.schedule_open)
        $('[data-repair-order-truck-schedule-closed]').html(data.response.schedule_closed)
        $('[data-repair-order-truck-schedule-resolved]').html(data.response.schedule_resolved)
        $('[data-repair-order-truck-schedule-rfc]').html(data.response.schedule_rfc)
        
        $('[data-repair-order-truck-unschedule-all]').html(data.response.unschedule_total)
        $('[data-repair-order-truck-unschedule-open]').html(data.response.unschedule_open)
        $('[data-repair-order-truck-unschedule-closed]').html(data.response.unschedule_closed)
        $('[data-repair-order-truck-unschedule-resolved]').html(data.response.unschedule_resolved)
        $('[data-repair-order-truck-unschedule-rfc]').html(data.response.unschedule_rfc)
        //---assign color codes to i boxes
      }
    }
  }
})


                                          $.ajax({
                                            url: "<?php echo AJAXROOT; ?>" + 'user/maintenance/dashboard/trailer-quick-totals',
                                            type: 'POST',
                                            data: {time_period:check_url_params('time_period')},
                                            beforeSend: function() {
                                              $('#tabledata').html('loading data');
                                            },
                                            success: function(data) {
                                              if ((typeof data) == 'string') {
      // console.log(data)
      data = JSON.parse(data)
      $('#tabledata').html("");
      if (data.status) {
        //---assign values to i boxes
        $('[data-repair-order-trailer-schedule-all]').html(data.response.schedule_total)
        $('[data-repair-order-trailer-schedule-open]').html(data.response.schedule_open)
        $('[data-repair-order-trailer-schedule-closed]').html(data.response.schedule_closed)
        $('[data-repair-order-trailer-schedule-resolved]').html(data.response.schedule_resolved)
        $('[data-repair-order-trailer-schedule-rfc]').html(data.response.schedule_rfc)
        $('[data-repair-order-trailer-unschedule-all]').html(data.response.unschedule_total)
        $('[data-repair-order-trailer-unschedule-open]').html(data.response.unschedule_open)
        $('[data-repair-order-trailer-unschedule-closed]').html(data.response.unschedule_closed)
        $('[data-repair-order-trailer-unschedule-resolved]').html(data.response.unschedule_resolved)
        $('[data-repair-order-trailer-unschedule-rfc]').html(data.response.unschedule_rfc)
        //---assign color codes to i boxes
      }
    }
  }
})

                                        }

                                        var time_period = 'ALL';
                                        if(check_url_params('time_period')){
                                          time_period = check_url_params('time_period');
                                        }
                                        $.ajax({
                                          url: "<?php echo AJAXROOT; ?>" + 'user/maintenance/dashboard/truck-quick-totals',
                                          type: 'POST',
                                          data: {time_period: time_period},
                                          beforeSend: function() {
                                            $('#tabledata').html('loading data');
                                          },
                                          success: function(data) {
                                            $('#time_period').val(time_period);
                                            if ((typeof data) == 'string') {
    // console.log(data)
    data = JSON.parse(data)
    $('#tabledata').html("");
    if (data.status) {
      //---assign values to i boxes
      $('[data-repair-order-truck-schedule-all]').html(data.response.schedule_total)
      $('[data-repair-order-truck-schedule-open]').html(data.response.schedule_open)
      $('[data-repair-order-truck-schedule-closed]').html(data.response.schedule_closed)
      $('[data-repair-order-truck-schedule-resolved]').html(data.response.schedule_resolved)
      $('[data-repair-order-truck-schedule-rfc]').html(data.response.schedule_rfc)
      $('[data-repair-order-truck-unschedule-all]').html(data.response.unschedule_total)
      $('[data-repair-order-truck-unschedule-open]').html(data.response.unschedule_open)
      $('[data-repair-order-truck-unschedule-closed]').html(data.response.unschedule_closed)
      $('[data-repair-order-truck-unschedule-resolved]').html(data.response.unschedule_resolved)
      $('[data-repair-order-truck-unschedule-rfc]').html(data.response.unschedule_rfc)
      //---assign color codes to i boxes
    }
  }
}
})
</script>
<script type="text/javascript">
  var time_period = 'ALL';
  if(check_url_params('time_period')){
    time_period = check_url_params('time_period');
  }

  $.ajax({
    url: "<?php echo AJAXROOT; ?>" + 'user/maintenance/dashboard/trailer-quick-totals',
    type: 'POST',
    data: {time_period: time_period},
    beforeSend: function() {
      $('#tabledata').html('loading data');
    },
    success: function(data) {
      if ((typeof data) == 'string') {
    // console.log(data)
    data = JSON.parse(data)
    $('#tabledata').html("");
    if (data.status) {
      //---assign values to i boxes
      $('[data-repair-order-trailer-schedule-all]').html(data.response.schedule_total)
      $('[data-repair-order-trailer-schedule-open]').html(data.response.schedule_open)
      $('[data-repair-order-trailer-schedule-closed]').html(data.response.schedule_closed)
      $('[data-repair-order-trailer-schedule-resolved]').html(data.response.schedule_resolved)
      $('[data-repair-order-trailer-schedule-rfc]').html(data.response.schedule_rfc)
      $('[data-repair-order-trailer-unschedule-all]').html(data.response.unschedule_total)
      $('[data-repair-order-trailer-unschedule-open]').html(data.response.unschedule_open)
      $('[data-repair-order-trailer-unschedule-closed]').html(data.response.unschedule_closed)
      $('[data-repair-order-trailer-unschedule-resolved]').html(data.response.unschedule_resolved)
      $('[data-repair-order-trailer-unschedule-rfc]').html(data.response.unschedule_rfc)
      //---assign color codes to i boxes
    }
  }
}
})
</script>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>