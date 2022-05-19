<?php
require_once APPROOT.'/views/includes/user/header.php';
$details=$data['details']; 

// echo '<pre>';
// print_r($details);
// echo '</pre>';
// exit;

?>
<br><br>
<section class="lg-form-outer">
    <div class="lg-form-header">Inventory - Update Issue Item</div>
    <form autocomplete="off" class="lg-form" method="POST" id="MyForm" onsubmit="return update()">
        <input type="hidden" name="update_eid" value="<?php echo $data['eid']; ?>">
        <section class="section-111">
        </section>
        <section class="section-111" style="max-width: 1200px">
            <div>
                <fieldset>
                    <legend>Update Issue Item</legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Location</label>
                            <select name="location_id_fk" onchange="get_items({location_id:this.value})"  data-default-select="<?php echo $details['location_id_fk'] ?>"></select>
                        </div>
                        <div class="field-p">
                            <label>Item </label>
                            <input type="hidden" name="old_item_location_id_fk" value="<?php echo $details['item_location_id_fk'] ?>">
                            <select name="item_location_id_fk" data-default-select="<?php echo $details['item_location_id_fk'] ?>"></select>
                        </div>
                        <div class="field-p">
                            <label>Total Quantity</label>
                            <input name="total_quantity" type="text" readonly>
                        </div>
                        <div class="field-p">
                            <label>Returned Quantity</label>
                            <input name="returned_so_far" type="text" value="<?php echo $details['returned_so_far'] ?>" disabled>
                        </div>
                        <div class="field-p">
                            <label>Issue Date</label>
                            <input name="issued_date" type="text"  data-date-picker="" value="<?php echo $details['issued_date'] ?>">
                        </div>
                        <div class="field-p">
                            <label>Issued Quantity</label>
                            <input type="hidden" name="old_issued_quantity" value="<?php echo $details['issued_quantity'] ?>">
                            <input name="issued_quantity" min="<?php echo (($details['returned_so_far'] > 0)? $details['returned_so_far']:'1') ?>" max="0" type="number" value="<?php echo $details['issued_quantity'] ?>">
                        </div>
                        
                        <div class="field-p">
                            <label>Issued To</label>
                            <input name="issued_to" type="text" value="<?php echo $details['issued_to'] ?>">
                        </div>
                        
                        <div class="field-p">
                            <label>Issued By</label>
                            <input name="issued_by" type="text" value="<?php echo $details['issued_by'] ?>">
                        </div>
                        
                    </div>
                </fieldset>
                <br>
                <section class="action-button-box">

                    <button type="submit" class="btn_green">SAVE</button>
                    &nbsp; &nbsp;&nbsp;<button type="button" class="btn_green" onclick="back_alert()">BACK</button>
                </section>
            </div>
        </section>
    </form>
</section>
<script type="text/javascript">
    function update(){
        submit_to_wait_btn('#submit','loading')
        $('#formErro').show()
        var form = document.getElementById('MyForm');
        var isValidForm = form.checkValidity();
        //var currentForm = $('#MyForm')[0];
        //var formData=new FormData(currentForm);
        if(isValidForm){
            $('[name="item_location_id_fk"]').prop('disabled', false);
            var arr=$('#MyForm').serializeArray();
            var obj={}
            for(var a=0;a<arr.length;a++ ){
                obj[arr[a].name]=arr[a].value
            }
            $('[name="item_location_id_fk"]').prop('disabled', true);
            // console.log(obj);return false;
            $.ajax({
                url:window.location.pathname+'-action',
                type:'POST',
                data: obj,
                success:function(data){
                 if((typeof data)=='string'){
                     data=JSON.parse(data) 
                 }
                 alert(data.message);
                 if(data.status){
                    location.href="../user/inventory/issue-items"
                    wait_to_submit_btn('#submit','SAVE')
                }else{
                    wait_to_submit_btn('#submit','SAVE')
                }
            }
        })
        }
        return false
    }
</script>

<script>
    function show_locations() {
        get_product_locations().then(function(data) {
            // Run this when your request was successful
            if (data.status) {

                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        options += `<option value="${item.id}">${item.location}</option>`;
                    })
                    $('[name="location_id_fk"]').html(options);
                    select_default('[name="location_id_fk"]')
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_locations();

    items = [];
    function get_items(params){
        $('[name="total_quantity"]').val('0');
        $('[name="issued_quantity"]').attr('max', '0');

        $.ajax({
        url: 'user/inventory/masters/items-location-list-ajax',
        type: 'POST',
        data: {location_id: params.location_id},
        beforeSend:function(){
            $('[name="location_id_fk"]').prop('disabled', true);
            $('[name="item_location_id_fk"]').html('');
            $('[name="total_quantity"]').html('0');
            items = [];
        },
        success:function(data){
            data=JSON.parse(data);
            
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    items = data.response.list;  
                    // console.log(items);
                    show_items();
                    
                }
            }
            $('[name="location_id_fk"]').prop('disabled', false);
            check_returns();
        }
        });
    }
    get_items({location_id: <?php echo $details['location_id_fk'] ?>});

    function show_items() {
        if(items.length){
            var options = "";
            options += `<option value="">- - Select - -</option>`
            $.each(items, function(index, item) {
                options += `<option total_quantity="${item.quantity}" value="${item.id}">${item.item_name}</option>`;
            });
            $('[name="item_location_id_fk"]').html(options);
            select_default('[name="item_location_id_fk"]');
            quantity = parseInt($('option:selected', '[name="item_location_id_fk"]').attr('total_quantity'));
            old_quantity = parseInt($('[name="old_issued_quantity"]').val());
            returned = parseInt($('[name="returned_so_far"]').val());
            total_quantity = quantity + old_quantity - returned;
            $('[name="total_quantity"]').val(total_quantity);
            $('[name="issued_quantity"]').attr('max', total_quantity);
            
        }  
    }

    $(document.body).on('change', '[name="item_location_id_fk"]', function() {
        if($(this).val()){
            if($(this).val() == $('[name="old_item_location_id_fk"]').val())
            {
                quantity = parseInt($('option:selected', this).attr('total_quantity'));
                old_quantity = parseInt($('[name="old_issued_quantity"]').val());
                returned = parseInt($('[name="returned_so_far"]').val());
                total_quantity = quantity + old_quantity - returned;
                $('[name="total_quantity"]').val(total_quantity);
                $('[name="issued_quantity"]').attr('max', total_quantity);
            }
            else{
                quantity = $('option:selected', this).attr('total_quantity');
                $('[name="total_quantity"]').val(quantity);
                $('[name="issued_quantity"]').attr('max', quantity);
            }
            
        }
        else{
            $('[name="total_quantity"]').val('0');
            $('[name="issued_quantity"]').attr('max', '0');
        }
        
    });
    function check_returns()
    {
        returns = $('[name="returned_so_far"]').val();
        if(returns > 0)
        {
            $('[name="item_location_id_fk"]').prop('disabled', true);
            $('[name="location_id_fk"]').prop('disabled', true);
        }
    }
    check_returns();
</script>
<script type="text/javascript">
    function back_alert() {
        if (confirm('Are you Sure ?')) {
            window.history.back();
        }
    }
</script>
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>