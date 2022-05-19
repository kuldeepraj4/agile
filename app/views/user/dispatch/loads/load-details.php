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
</style>
<br><br>
<section class="dtlv content-box" style="margin: auto;max-width: 1150px">
    <h1 class="dtlv-heading">LOAD <?php echo $dtl['id']; ?></h1>

    <section>
        <div class="dtlv-sec-head" data-hide-show-details>
            <div class="dtlv-sec-heading">Load Information</div>
            <div>
                <button class="icon angle_up white" data-up-down-button></button>
            </div>
        </div>
        <div class="dtlv-dtl">
            <div class="dtlv-dtl-action-bar">
                <button title="Edit" class="icon edit grey" onclick="open_child_window({url:'../user/dispatch/loads/load-information-update&eid=<?php echo $dtl['eid']; ?>',width:1000,height:500})"></button>
            </div>
            <div class="dtlv-dtl-content">
                <div class="dtlv-attr-val-list" style="max-width: 500px;">
                    <ul >
                        <li><div>Customer</div><div><?php echo $dtl['customer_name']; ?></div></li>
                        <li><div>PO Number</div><div><?php echo $dtl['id']; ?></div></li>
                        <li><div>Rate</div><div><?php echo $dtl['rate']; ?></div></li>
                        <li><div>Commodity Type</div><div><?php echo $dtl['commodity_type']; ?></div></li>
                        <li><div>Bill of Lading</div><div><?php echo $dtl['bill_of_lading']; ?></div></li>
                        <li><div>Trailer Type</div><div><?php echo $dtl['trailer_type']; ?></div></li>
                        <li><div>Temperature to maintain</div><div><?php echo $dtl['temperature_to_maintain']; ?></div></li>
                    </ul>
                </div>


                <div class="dtlv-attr-val-list" style="max-width: 500px;">
                    <ul >
                        <li><div>Customer</div><div><?php echo $dtl['customer_name']; ?></div></li>
                        <li><div>PO Number</div><div><?php echo $dtl['id']; ?></div></li>
                        <li><div>Rate</div><div><?php echo $dtl['rate']; ?></div></li>
                        <li><div>Commodity Type</div><div><?php echo $dtl['commodity_type']; ?></div></li>
                        <li><div>Bill of Lading</div><div><?php echo $dtl['bill_of_lading']; ?></div></li>
                        <li><div>Trailer Type</div><div><?php echo $dtl['trailer_type']; ?></div></li>
                        <li><div>Temperature to maintain</div><div><?php echo $dtl['temperature_to_maintain']; ?></div></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

<section>
            <div class="dtlv-sec-head hide" data-hide-show-details>
                <div class="dtlv-sec-heading">Shipper </div>
                <div>
                    <button class="icon angle_down white" data-up-down-button></button>
                </div>
            </div>

            <div class="dtlv-dtl">
                <div class="dtlv-dtl-action-bar">
                <button title="Edit" class="icon edit grey" onclick="open_child_window({url:'../user/dispatch/loads/stop-information-update&eid=<?php echo $shipper['eid']; ?>',width:1000,height:500})"></button>
                </div>
                <div class="dtlv-dtl-content">
                    <div class="dtlv-attr-val-list" style="max-width: 500px;">
                        <ul >
                            <li><div>Company</div><div><?php echo $shipper['location_name']; ?></div></li>
                            <li><div>Address</div><div><?php echo $shipper['location_full_address']; ?></div></li>
                            <li><div>Appointment Type</div><div><?php echo $shipper['appointment_type']; ?></div></li>
                            <li><div>Date</div><div><?php echo $shipper['date']; ?></div></li>
                            <li><div>Time</div><div><?php echo $shipper['time_from'].' - '.$shipper['time_to']; ?></div></li>
                        </ul>
                    </div>

                    <div class="dtlv-attr-val-list" style="max-width: 500px;">
                        <ul >
                            <li><div>Pick-up Number</div><div><?php echo $shipper['pick_up_number']; ?></div></li>
                            <li><div>Confirm Number</div><div><?php echo $shipper['confirm_number']; ?></div></li>
                            <li><div>Pallet Count</div><div><?php echo $shipper['pallet_count']; ?></div></li>
                            <li><div>Case Count</div><div><?php echo $shipper['case_count']; ?></div></li>
                            <li><div>Special Instructions </div><div><?php echo $shipper['special_instructions']; ?></div></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    

    <?php
    foreach ($data['details']['stops'] as $stop) {
        ?>

        <section>
            <div class="dtlv-sec-head hide" data-hide-show-details>
                <div class="dtlv-sec-heading">Stop <span style="font-weight: normal;font-style: italic;font-size: .8em;"><?php echo $stop['location_name']; ?></span></div>
                <div>
                    <button class="icon angle_down white" data-up-down-button></button>
                </div>
            </div>

            <div class="dtlv-dtl">
                <div class="dtlv-dtl-action-bar">
                    <button title="Edit" class="icon edit grey" onclick="open_child_window({url:'../user/dispatch/loads/stop-information-update&eid=<?php echo $stop['eid']; ?>',width:1000,height:500})"></button>
                </div>
                <div class="dtlv-dtl-content">
                    <div class="dtlv-attr-val-list" style="max-width: 500px;">
                        <ul >
                            <li><div>Company</div><div><?php echo $stop['location_name']; ?></div></li>
                            <li><div>Address</div><div><?php echo $stop['location_full_address']; ?></div></li>
                            <li><div>Appointment Type</div><div><?php echo $stop['appointment_type']; ?></div></li>
                            <li><div>Date</div><div><?php echo $stop['date']; ?></div></li>
                            <li><div>Time</div><div><?php echo $stop['time_from'].' - '.$stop['time_to'];?></div></li>
                        </ul>
                    </div>

                    <div class="dtlv-attr-val-list" style="max-width: 500px;">
                        <ul >
                            <li><div>Pick-up Number</div><div><?php echo $stop['pick_up_number']; ?></div></li>
                            <li><div>Confirm Number</div><div><?php echo $stop['confirm_number']; ?></div></li>
                            <li><div>Pallet Count</div><div><?php echo $stop['pallet_count']; ?></div></li>
                            <li><div>Case Count</div><div><?php echo $stop['case_count']; ?></div></li>
                            <li><div>Special Instructions </div><div><?php echo $stop['special_instructions']; ?></div></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

    ?>
    <section>
        <div class="dtlv-sec-head hide" data-hide-show-details>
            <div class="dtlv-sec-heading">Consignee </div>
            <div>
                <button class="icon angle_down white" data-up-down-button></button>
            </div>
        </div>

        <div class="dtlv-dtl">
            <div class="dtlv-dtl-action-bar">
                <button title="Edit" class="icon edit grey" onclick="open_child_window({url:'../user/dispatch/loads/stop-information-update&eid=<?php echo $consignee['eid']; ?>',width:1000,height:500})"></button>
            </div>
            <div class="dtlv-dtl-content">
                <div class="dtlv-attr-val-list" style="max-width: 500px;">
                    <ul >
                        <li><div>Company</div><div><?php echo $consignee['location_name']; ?></div></li>
                        <li><div>Address</div><div><?php echo $consignee['location_full_address']; ?></div></li>
                        <li><div>Appointment Type</div><div><?php echo $consignee['appointment_type']; ?></div></li>
                        <li><div>Date</div><div><?php echo $consignee['date']; ?></div></li>
                        <li><div>Time</div><div><?php echo $consignee['time_from'].' - '.$consignee['time_to']; ?></div></li>
                    </ul>
                </div>

                <div class="dtlv-attr-val-list" style="max-width: 500px;">
                    <ul >
                        <li><div>Pick-up Number</div><div><?php echo $consignee['pick_up_number']; ?></div></li>
                        <li><div>Confirm Number</div><div><?php echo $consignee['confirm_number']; ?></div></li>
                        <li><div>Pallet Count</div><div><?php echo $consignee['pallet_count']; ?></div></li>
                        <li><div>Case Count</div><div><?php echo $consignee['case_count']; ?></div></li>
                        <li><div>Special Instructions </div><div><?php echo $consignee['special_instructions']; ?></div></li>
                    </ul>
                </div>
            </div>
        </div>

    </section>


    <section>
        <div class="dtlv-sec-head hide" data-hide-show-details>
            <div class="dtlv-sec-heading">Billing Information </div>
            <div>
                <button class="icon angle_down white" data-up-down-button></button>
            </div>
        </div>

        <div class="dtlv-dtl">
            <div class="dtlv-dtl-action-bar">
                <button><a class="icon edit grey" style="color: red;" href="bad"></a></button>
            </div>
            <div class="dtlv-dtl-content">
                <div class="dtlv-attr-val-list" style="max-width: 500px;">
                    <ul >
                        <li><div>Company</div><div><?php echo $consignee['location_name']; ?></div></li>
                        <li><div>Address</div><div><?php echo $consignee['location_full_address']; ?></div></li>
                        <li><div>Appointment Type</div><div><?php echo $consignee['appointment_type']; ?></div></li>
                        <li><div>Date</div><div><?php echo $consignee['date']; ?></div></li>
                        <li><div>Time</div><div><?php echo $shipper['time_from'].' - '.$shipper['time_to']; ?></div></li>
                    </ul>
                </div>

                <div class="dtlv-attr-val-list" style="max-width: 500px;">
                    <ul >
                        <li><div>Pick-up Number</div><div><?php echo $consignee['pick_up_number']; ?></div></li>
                        <li><div>Confirm Number</div><div><?php echo $consignee['confirm_number']; ?></div></li>
                        <li><div>Pallet Count</div><div><?php echo $consignee['pallet_count']; ?></div></li>
                        <li><div>Case Count</div><div><?php echo $consignee['case_count']; ?></div></li>
                        <li><div>Special Instructions </div><div><?php echo $consignee['special_instructions']; ?></div></li>
                    </ul>
                </div>
            </div>
        </div>

    </section>


</section>

<script type="text/javascript">
    function show_list(){
        var sort_by=$('#sort_by').val();
        var common_search=$('[data-filter="common_search"]').val();
        //var customer_id=$('[data-filter="customer_id"]').val();
        $.ajax({
            url:location.pathname+'-ajax',
            type:'POST',
            data:{
                sort_by:sort_by,
                common_search:common_search,
            },
            success:function(data){
               if((typeof data)=='string'){
                   data=JSON.parse(data)
                   $('#tabledata').html("");
                   if(data.status){
                    console.log(data.response.list[2])
                    var counter=1;    
                    $.each(data.response.list, function(index, item) {
                        var pick_up_datetime='';
                        var drop_datetime=''
                        var pick_up_location='';
                        var drop_location=''                
                        var row=`<tr>
                        <td>${counter++}</td>
                        <td>${item.id}</td>
                        <td>${item.po_number}</td>
                        <td style="text-align:left">${item.customer_code} - ${item.customer_name}</td>
                        <td style="text-align:left; white-space:nowrap">${item.shipper.location_id}</td>
                        <td style="text-align:left; white-space:nowrap">${item.shipper.location_city},${item.shipper.location_state}</td>
                        <td style="text-align:left; white-space:nowrap">${item.consignee.location_id}</td>
                        <td style="text-align:left; white-space:nowrap">${item.consignee.location_city},${item.consignee.location_state}</td>
                        <td>${item.shipper.date}</td>
                        <td>${item.consignee.date}</td>
                        <td style="white-space:nowrap">${item.added_by_user_code}<br>${item.added_on_datetime}</td>
                        <td style="white-space:nowrap">
                        <button title="View" class="btn_grey_c"><a href="../user/dispatch/loads/details?eid=`+item.eid+`"><i class="fa fa-eye"></i></a></button>`;
                        <?php  if(in_array('P0170', USER_PRIV)){
                            ?>
                            row+=`<button title="View" class="btn_grey_c"><a href="../user/dispatch/express-loads/update?eid=`+item.eid+`"><i class="fa fa-pen"></i></a></button>`;
                            <?php
                        }

                        ?>
                        
                        row+=`</td>`; 
                        row+=`</tr>`;
                        $('#tabledata').append(row);

                    })
                }else{
                    var false_message=`<tr><td colspan="18">`+data.message+`<td></tr>`;
                    $('#tabledata').html(false_message);
                }
            }

        }

    })
    }
    show_list()

</script>

<script type="text/javascript">
    $('[data-hide-show-details]').each(function() {

        if($(this).hasClass('hide')){
            $(this).siblings('.dtlv-dtl').slideUp(1);
        }
    })
 // $(document.body).on('change', '[name="customer_id_search"]' ,function(){
  $(document.body).on('click','[data-hide-show-details]',function(){
    if($(this).hasClass('hide')){
      $(this).siblings('.dtlv-dtl').slideDown('fast')
      $(this).find('[data-up-down-button]').removeClass('angle_down')
      $(this).find('[data-up-down-button]').addClass('angle_up')
      $(this).removeClass('hide')  
  }else{
   $(this).siblings('.dtlv-dtl').slideUp('fast')
   $(this).find('[data-up-down-button]').removeClass('angle_up')
   $(this).find('[data-up-down-button]').addClass('angle_down')

   $(this).addClass('hide')
}

})
</script>


<script type="text/javascript">
  function sort_table(){
    show_list()
}
</script>
<br><br><br>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>