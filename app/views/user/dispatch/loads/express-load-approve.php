<?php
require_once APPROOT.'/views/includes/user/header.php';
$dtl=$data['details'];
$shipper=$data['details']['shipper'];
$consignee=$data['details']['consignee'];
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
</style>
<br><br>
<section class="dtlv content-box" style="margin: auto;max-width: 1200px">
    <h1 class="dtlv-heading">VERIFY LOAD <?php echo $dtl['id']; ?></h1>

    <section>
        <div class="dtlv-sec-head" data-hide-show-details>
            <div class="dtlv-sec-heading">Basic Information</div>
            <div>
                <button class="icon angle_up white" data-up-down-button></button>
            </div>
        </div>
        <div class="dtlv-dtl">
            <div class="dtlv-dtl-action-bar">
                <button style="display: none;" title="Edit" class="icon edit grey" onclick="open_child_window({url:'../user/dispatch/loads/load-information-update&eid=<?php echo $dtl['eid']; ?>',width:1000,height:500})"></button>
            </div>
            <div class="dtlv-dtl-content">
                <div class="dtlv-attr-val-list" style="max-width: 500px;">
                    <ul >
                        <li><div>Customer</div><div><?php echo $dtl['customer_code'].' - '.$dtl['customer_name']; ?></div></li>
                        <li><div>PO Number</div><div><?php echo $dtl['po_number']; ?></div></li>
                        <li><div>Rate</div><div><?php echo $dtl['rate']; ?></div></li>
                        <li><div>Load Type</div><div><?php echo $dtl['load_type']; ?></div></li>
                    </ul>
                </div>


                <div class="dtlv-attr-val-list" style="max-width: 500px;">
                    <ul >
                      <?php 
                      if($dtl['load_type_id']=='LOT01' || $dtl['load_type_id']=='LOT03'){
                        echo "<li><div>Trailer Type</div><div>".$dtl['trailer_type']."</div></li>";
                    }

                    if($dtl['trailer_type']=='REEFER'){
                        if($dtl['temperature_as_per_shipper']=="NO"){
                          echo "<li><div>Reefer Temp </div><div>".$dtl['temperature_to_maintain'].' '.$dtl['reefer_mode']."</div></li>";
                      }else{
                          echo "<li><div>Reefer Temp </div><div>As Per Shipper</div></li>";
                      }
                  }
                  ?>
                  <li><div>Booked By</div><div>
                    <?php 
                    echo $dtl['booked_by_user'];
                    ?>
                    
                </div></li>
                <li><div>Received on Datetime</div><div>
                    <?php 
                    echo $dtl['received_on_datetime'];
                    ?>
                    
                </div></li>                        
            </ul>
        </div>
    </div>
    <div class="dtlv-dtl-list">
      <table>
        <thead>
          <tr>
            <th style='text-align:left'>Category</th>
            <th>Type</th>
            <th>Appointment</th>
            <th>City</th>
            <th>Date</th>
            <th>Time</th>
        </tr>
    </thead>
    <tbody>
      <?php

                  //----print shipper range here if given
      if($dtl['has_shipper_range']=='YES'){
          echo "<tr>
          <td style='text-align:left'>Drop at Shipper</td>
          <td></td>
          <td></td>
          <td></td>
          <td>".$dtl['drop_at_shipper_date']."</td>
          <td>".$dtl['drop_at_shipper_time_from']." - ".$dtl['drop_at_shipper_time_to']."</td>";
          "</tr>";              
      }

                  //----print shipper row
      echo "<tr>
      <td style='text-align:left'>".$dtl['shipper']['category']."</td>
      <td>".$dtl['shipper']['type']."</td>
      <td>".$dtl['shipper']['appointment_type']."</td>
      <td>".$dtl['shipper']['location']."</td>
      <td>".$dtl['shipper']['date']."</td>";
      if($dtl['shipper']['datetime_tbd']=='NO'){
          echo "<td>".$dtl['shipper']['time_from']." - ".$dtl['shipper']['time_to']."</td>";
      }elseif ($dtl['shipper']['datetime_tbd']=='YES') {
          echo "<td>TBD</td>";
      }
      
      "</tr>";
                  //----print all in-between stops
      $stop_counter=0;
      foreach ($dtl['stops'] as $stp) {
        echo "<tr>
        <td style='text-align:left'>STOP ".++$stop_counter."</td>
        <td>".$stp['type']."</td>
        <td>".$stp['appointment_type']."</td>
        <td>".$stp['location']."</td>
        <td>".$stp['date']."</td>";
        if($stp['datetime_tbd']=='NO'){
          echo "<td>".$stp['time_from']." - ".$stp['time_to']."</td>";
      }elseif ($stp['datetime_tbd']=='YES') {
          echo "<td>TBD</td>";
      }
      
      "</tr>";
  }

                  //----print consignee row
  echo "<tr>
  <td style='text-align:left'>".$dtl['consignee']['category']."</td>
  <td>".$dtl['consignee']['type']."</td>
  <td>".$dtl['consignee']['appointment_type']."</td>
  <td>".$dtl['consignee']['location']."</td>
  <td>".$dtl['consignee']['date']."</td>";
  if($dtl['consignee']['datetime_tbd']=='NO'){
      echo "<td>".$dtl['consignee']['time_from']." - ".$dtl['consignee']['time_to']."</td>";
  }elseif ($dtl['consignee']['datetime_tbd']=='YES') {
      echo "<td>TBD</td>";
  }

                  //----print consignee range here if given
  if($dtl['has_consignee_range']=='YES'){
      echo "<tr>
      <td style='text-align:left'>Pick from Consignee</td>
      <td></td>
      <td></td>
      <td></td>
      <td>".$dtl['drop_at_shipper_date']."</td>
      <td>".$dtl['drop_at_shipper_time_from']." - ".$dtl['drop_at_shipper_time_to']."</td>";
      "</tr>";              
  }
  
  "</tr>";
  ?>                    
</tbody>
</table>
</div>
</div>
</section>
<div style="text-align: center;">
  <button class="btn_green" data-action="approve-el">Approve</button> &nbsp
  <button class="btn_red" data-action="want-to-reject">Want to reject ?</button>
</div>
<div data-reject-section style="display: flex;align-items: center;flex-direction: column;"></div>
<br>
<br>
</section>
<br>
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
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>