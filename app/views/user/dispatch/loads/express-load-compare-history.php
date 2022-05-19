<?php
require_once APPROOT.'/views/includes/user/header.php';
$bi=$data['details']['basic_info'];
$stops=$data['details']['stops'];
?>
<style type="text/css">
  .dtlv{
    box-shadow: 0 0 10px -1px darkgrey;
    background: white;
    text-align: center;
    padding:10px;
    display: block;
    border-radius: 12px;
  }
  .dtlv-heading{
    margin-bottom: 10px;
    font-size: 2em;
    color: var(--theme-color-four);
  }
  .dtlv>section{
    border:1px solid lightgrey;
    border-radius: 8px;
    overflow: hidden;
    margin: 25px auto;
  }
  .dtlv .dtlv-sec-head{
    display: flex;
    justify-content: space-between;
    padding:5px 10px;
    background: #486e94;
    border-bottom: 1px solid lightgrey;
  }
  .dtlv .dtlv-sec-heading{
    font-weight: bold;
    font-size: 1.1em;
    color: white;
  }
  .dtlv-sec-heading.angle_down::after{
    color: grey;
    font-family: "Font Awesome 5 Free"; 
    font-weight: 900;
    content: "\f107";
    font-size: 1.2em;
  }
  .dtlv .dtlv-sec-head a{
    color: white;
  }
  .dtlv .dtlv-dtl{
  }
  .dtlv .dtlv-dtl .dtlv-dtl-content{
    padding: 8px;
    display: flex;
    justify-content: space-between;
  }
  .dtlv .dtlv-dtl .dtlv-dtl-action-bar{
    display: flex;
    justify-content: flex-end;
  }
  .dtlv .dtlv-dtl .dtlv-dtl-content>div{
    margin: 8px;
    flex-grow: 1;
  }

  .dtlv .dtlv-attr-val-list ul{
  }
  .dtlv .dtlv-attr-val-list li{
    display: flex;
  }
  .dtlv .dtlv-attr-val-list li>div{
    padding:3px 10px;
  }
  .dtlv .dtlv-attr-val-list li>div:nth-child(1){
    width: 40%;
    font-style: italic;
    text-align: left;
  }
  .dtlv .dtlv-attr-val-list li>div:nth-child(2){
    width: 55%;
    flex-grow: 1;
    text-align: left;
  }
  .icon{
    font-family: "Font Awesome 5 Free"; 
    font-weight: 900;
  }
  .icon:hover{
    transform: scale(1.1);
  }
  .icon.white{
    color: white !important;
  }
  .icon.grey{
    color: grey !important;
  }
  .icon.view::after{
    content: "\f06e";
  }
  .icon.view:hover{
    color: green;
  }

  .icon.edit::after{ 
    content: "\f304";
  }
  .icon.edit:hover{
    color: steelblue;
  }

  .icon.delete::after{
    content: "\f1f8";
  } 
  .icon.delete:hover{
    color: red;
  }
  .icon.angle_down::after{
    content: "\f107";
    font-size: 1.2em;
  }
  .icon.angle_up::after{
    content: "\f106";
    font-size: 1.2em;
  }
  .icon.toggle-on::after{
    content: "\f205";
    font-size: 1.2em;
  }
  .icon.toggle-off::after{
    content: "\f204";
    font-size: 1.2em;
  }
  .icon.toggle-off:hover,  
  .icon.toggle-on:hover{
    color: steelblue;
  }

  .dtlv-dtl-list>table{
    border:1px solid darkgrey;
    border-collapse: collapse;
    background: white;
    overflow: auto;
    box-sizing: border-box;
    width: 95%;
    margin:8px auto;
  }
  .dtlv-dtl-list>table>thead{
    background: #f2f2f2;
    color: black;
  }
  .dtlv-dtl-list>table>thead>tr{
    border-bottom:1px solid darkgrey;
  }
  .dtlv-dtl-list>table>thead>tr>th{
    padding:8px 12px;
    font-weight: normal;
  }

  .dtlv-dtl-list>table>tbody>tr>td{
    padding: 8px 12px;

  }
  .dtlv-dtl-list>table>tbody>tr{
    border-bottom: 1px solid #f0f0f0
  }
  .dtlv-dtl-list>table>tbody>tr:last-child{
    border-bottom: none;
  }
  .dtlv-dtl-list>table>thead>tr>td{
    text-align: center;
  }
  .dtlv-dtl-list>table>tbody>tr>td{
    text-align: center;
  }


  .dtlv-dtl-list.dtlv-dtl-list-a{
  }
  .dtlv-dtl-list.dtlv-dtl-list-a>table>thead{
    background: #486e94;
  }
  .dtlv-dtl-list.dtlv-dtl-list-a>table>thead>tr{
    border:1px solid grey;
  }
  .comp-high{
    color: red;
    font-weight: bolder;
  }
  .comp-hist{
    color: lightgrey;
    font-style: italic;
    font-size: .9em;
  }
</style>
<br><br>
<section class="dtlv content-box" style="margin: auto;max-width: 1200px">
  <h1 class="dtlv-heading">COMPARE EXPRESS LOAD <?php echo $bi['id']['old']; ?></h1>

  <section>
    <div class="dtlv-sec-head" data-hide-show-details>
      <div class="dtlv-sec-heading">Basic Information</div>
      <div>
        <button class="icon angle_up white" data-up-down-button></button>
      </div>
    </div>
    <div class="dtlv-dtl">
      <div class="dtlv-dtl-action-bar">
        <button style="display: none;" title="Edit" class="icon edit grey" onclick="open_child_window({url:'../user/dispatch/loads/load-information-update&eid=<?php echo $bi['eid']; ?>',width:1000,height:500})"></button>
      </div>
      <div class="dtlv-dtl-content">
        <div class="dtlv-attr-val-list" style="max-width: 500px;">
          <ul >
            <li>
              <div>Customer</div>
              <div>
                <?php
                if($bi['customer']['current']==$bi['customer']['old']){
                  echo "<span>".$bi['customer']['current']."</span>";
                }else{
                  echo "<span class='comp-high'>".$bi['customer']['current']."</span><br><span class='comp-hist'>".$bi['customer']['old']."</span>";
                }
                ?>

              </div>
            </li>
            <li>
              <div>PO Number</div>
              <div><?php
              if($bi['po_number']['current']==$bi['po_number']['old']){
                echo "<span>".$bi['po_number']['current']."</span>";
              }else{
                echo "<span class='comp-high'>".$bi['po_number']['current']."</span> <span class='comp-hist'>".$bi['po_number']['old']."</span>";
              }
              ?></div>
            </li>
            <li>
              <div>Rate</div>
              <div><?php
              if($bi['rate']['current']==$bi['rate']['old']){
                echo "<span>".$bi['rate']['current']."</span>";
              }else{
                echo "<span class='comp-high'>".$bi['rate']['current']."</span> <span class='comp-hist'>".$bi['rate']['old']."</span>";
              }
              ?></div>
            </li>

            <li>
              <div>Load Type</div>
              <div><?php
              if($bi['load_type']['current']==$bi['load_type']['old']){
                echo "<span>".$bi['load_type']['current']."</span>";
              }else{
                echo "<span class='comp-high'>".$bi['load_type']['current']."</span><br><span class='comp-hist'>".$bi['load_type']['old']."</span>";
              }
              ?></div>
            </li>
            <li>
              <div>Trailer Type</div>
              <div><?php
              if($bi['trailer_type']['current']==$bi['trailer_type']['old']){
                echo "<span>".$bi['trailer_type']['current']."</span>";
              }else{
                echo "<span class='comp-high'>".$bi['trailer_type']['current']."</span><br><span class='comp-hist'>".$bi['trailer_type']['old']."</span>";
              }
              ?></div>
            </li>

          </ul>
        </div>


        <div class="dtlv-attr-val-list" style="max-width: 500px;">
          <ul >
            <li>
              <div>Reefer Mode </div>
              <div><?php
              if($bi['reefer_mode']['current']==$bi['reefer_mode']['old']){
                echo "<span>".$bi['reefer_mode']['current']."</span>";
              }else{
                echo "<span class='comp-high'>".$bi['reefer_mode']['current']."</span><br><span class='comp-hist'>".$bi['reefer_mode']['old']."</span>";
              }
              ?></div>
            </li>
            <li>
              <div>Reefer Temp </div>
              <div><?php
              if($bi['temperature_to_maintain']['current']==$bi['temperature_to_maintain']['old']){
                echo "<span>".$bi['temperature_to_maintain']['current']."</span>";
              }else{
                echo "<span class='comp-high'>".$bi['temperature_to_maintain']['current']."</span> <span class='comp-hist'>".$bi['temperature_to_maintain']['old']."</span>";
              }
              ?></div>
            </li>
            <li>
              <div>Temp As Per Shipper </div>
              <div><?php
              if($bi['temperature_as_per_shipper']['current']==$bi['temperature_as_per_shipper']['old']){
                echo "<span>".$bi['temperature_as_per_shipper']['current']."</span>";
              }else{
                echo "<span class='comp-high'>".$bi['temperature_as_per_shipper']['current']."</span><br><span class='comp-hist'>".$bi['temperature_as_per_shipper']['old']."</span>";
              }
              ?></div>
            </li>                   
          </ul>
        </div>
      </div>

      <!-- Drop at shipper comparsion-->
      <?php
      if($bi['has_shipper_range']['current']=='YES' || $bi['has_shipper_range']['current']=='YES'){
        ?>
        <div class="dtlv-dtl-list">
          <h3 style="text-align: center;">Drop at Shipper</h3>
          <table>
            <thead>
              <tr>
                <th>Date</th>
                <th>Time</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php
                if($bi['drop_at_shipper_date']['current']==$bi['drop_at_shipper_date']['old']){
                  echo "<span>".$bi['drop_at_shipper_date']['current']."</span>";
                }else{
                  echo "<span class='comp-high'>".$bi['drop_at_shipper_date']['current']."</span><br><span class='comp-hist'>".$bi['drop_at_shipper_date']['old']."</span>";
                }
                ?></td>
                <td><?php
                if($bi['drop_at_shipper_time']['current']==$bi['drop_at_shipper_time']['old']){
                  echo "<span>".$bi['drop_at_shipper_time']['current']."</span>";
                }else{
                  echo "<span class='comp-high'>".$bi['drop_at_shipper_time']['current']."</span><br><span class='comp-hist'>".$bi['drop_at_shipper_time']['old']."</span>";
                }
                ?></td>
              </tr>
            </tbody>
          </table>

          <?php
        }
        ?>
        <!-- /Drop at shipper comparsion-->
        <br><br><br><br>
        <!-- Pick from consignee comparsion-->
        <?php
        if($bi['has_shipper_range']['current']=='YES' || $bi['has_shipper_range']['current']=='YES'){
          ?>
          <div class="dtlv-dtl-list">
            <h3 style="text-align: center;">Pick from Shipper</h3>
            <table>
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Time</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php
                  if($bi['pick_from_consignee_date']['current']==$bi['pick_from_consignee_date']['old']){
                    echo "<span>".$bi['pick_from_consignee_date']['current']."</span>";
                  }else{
                    echo "<span class='comp-high'>".$bi['pick_from_consignee_date']['current']."</span><br><span class='comp-hist'>".$bi['pick_from_consignee_date']['old']."</span>";
                  }
                  ?></td>
                  <td><?php
                  if($bi['pick_from_consignee_time_from']['current']==$bi['pick_from_consignee_time_from']['old']){
                    echo "<span>".$bi['pick_from_consignee_time_from']['current']."</span>";
                  }else{
                    echo "<span class='comp-high'>".$bi['pick_from_consignee_time_from']['current']."</span><br><span class='comp-hist'>".$bi['pick_from_consignee_time_from']['old']."</span>";
                  }
                  ?></td>
                </tr>
              </tbody>
            </table>

            <?php
          }
          ?>
          <!-- /Pick from consignee comparsion-->

          <br><br><br>
          <div class="dtlv-dtl-list">
            <h3 style="text-align: center;">Stops Comparison</h3>
            <table>
              <thead>
                <tr>
                  <th style='text-align:left'>Category</th>
                  <th>Type</th>
                  <th>Appointment</th>
                  <th>City</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>TBD</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  //----print all in-between stops

                foreach ($stops as $stp) {
                  $row="<tr>";
                  $row.="<td>".$stp['category']['current']."</td>";
                  
                  if($stp['type']['current']==$stp['type']['old']){
                    $row.="<td><span>".$stp['type']['current']."</span></td>";
                  }else{
                    $row.="<td><span class='comp-high'>".$stp['type']['current']."</span><br> <span class='comp-hist'>".$stp['type']['old']."</span></td>";
                  }
                  
                  if($stp['appointment_type']['current']==$stp['appointment_type']['old']){
                    $row.="<td><span>".$stp['appointment_type']['current']."</span></td>";
                  }else{
                    $row.="<td><span class='comp-high'>".$stp['appointment_type']['current']."</span><br> <span class='comp-hist'>".$stp['appointment_type']['old']."</span></td>";
                  }

                  if($stp['location']['current']==$stp['location']['old']){
                    $row.="<td><span>".$stp['location']['current']."</span></td>";
                  }else{
                    $row.="<td><span class='comp-high'>".$stp['location']['current']."</span><br> <span class='comp-hist'>".$stp['location']['old']."</span></td>";
                  }

                  if($stp['date']['current']==$stp['date']['old']){
                    $row.="<td><span>".$stp['date']['current']."</span></td>";
                  }else{
                    $row.="<td><span class='comp-high'>".$stp['date']['current']."</span><br> <span class='comp-hist'>".$stp['date']['old']."</span></td>";
                  }

                  if($stp['time']['current']==$stp['time']['old']){
                    $row.="<td><span>".$stp['time']['current']."</span></td>";
                  }else{
                    $row.="<td><span class='comp-high'>".$stp['time']['current']."</span><br> <span class='comp-hist'>".$stp['time']['old']."</span></td>";
                  }

                  if($stp['datetime_tbd']['current']==$stp['datetime_tbd']['old']){
                    $row.="<td><span>".$stp['datetime_tbd']['current']."</span></td>";
                  }else{
                    $row.="<td><span class='comp-high'>".$stp['datetime_tbd']['current']."</span><br> <span class='comp-hist'>".$stp['datetime_tbd']['old']."</span></td>";
                  }
                  $row.="</tr>";
                  echo $row;        
                }

                "</tr>";
                ?>                    
              </tbody>
            </table>
          </div>
        </div>
        <br>
        <div style="text-align: center;">
          <button class="btn_green" data-action="approve-el">Approve</button> &nbsp
          <button class="btn_red" data-action="want-to-reject">Want to reject ?</button>
        </div>
        <div data-reject-section style="display: flex;align-items: center;flex-direction: column;"></div>
        <br>
        <br>
      </section>
    </section>

    <script type="text/javascript">

      $(document).ready(function(){
       $(document).on("click", "[data-action='approve-el']",function(){
        if(confirm('Do you want to approve this ?')){
          var eid=$(this).data("eid");
          $.ajax({
            url:'user/dispatch/express-loads/approve-details-action',
            type:'POST',
            data:{
              express_load_eid:"<?php echo $_GET['eid'] ?>"
            },
            context: this,
            success:function(data){
             if((typeof data)=='string'){
               data=JSON.parse(data) 
             }
             
             if(data.status){
               window.history.back()
             }else{
              alert(data.message)
            }
          }
        })
        }
      });
     });

   </script>

<script type="text/javascript">

    $(document).ready(function(){
       $(document).on("click", "[data-action='want-to-reject']",function(){
          $('[data-reject-section]').html(`<textarea placeholder="Write reason of rejection here" data-reason-of-rejection required style="width: 100%;
            max-width: 500px;margin:10px auto;resize: none;height: 150px"></textarea>
            <section class="action-button-box">
            <button type="submit" data-submit data-action='reject-el'></button>
            <button type="button" class="btn_red" onclick="set_pref(0)">Reject & Back</button> &nbsp &nbsp
            <button type="button" class="btn_red" onclick="set_pref(1)">Reject & Edit</button> &nbsp &nbsp
            </section>`)
      });
   });

</script>
<script type="text/javascript">
    var return_to = 0

    function set_pref(val) {
        return_to = val;
        $('[data-submit]').trigger('click');
    }
</script>
 <script type="text/javascript">

  $(document).ready(function(){
   $(document).on("click", "[data-action='reject-el']",function(){
    if(confirm('Do you want to reject this ?')){
      var eid=$(this).data("eid");
      $.ajax({
        url:'user/dispatch/express-loads/reject-details-action',
        type:'POST',
        data:{
          express_load_eid:"<?php echo $_GET['eid'] ?>",
          reason_of_rejection:$('[data-reason-of-rejection]').val()
        },
        context: this,
        success:function(data){
         if((typeof data)=='string'){
           data=JSON.parse(data) 
         }
         
         if(data.status){
            if (return_to == 0) {
                window.history.back();
            } else if (return_to == 1) {
                location.href = '../user/dispatch/express-loads/update?call-back-page=user/dispatch/express-loads/approval-status-list&eid=<?php echo $_GET['eid'] ?>';
            }
        }else{
          alert(data.message)
      }
      }
    })
    }
  });
 });

</script>
<br><br><br><br>
<br><br><br><br>
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>