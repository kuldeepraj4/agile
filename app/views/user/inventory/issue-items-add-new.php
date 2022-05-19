<?php
require_once APPROOT . '/views/includes/user/header.php';
//$ro_details = $data['ro_details'];
// print_r($ro_details)
?>
<br><br>
<section class="lg-form-outer">
    <div class="lg-form-header">Inventory - Issue Item</div>
    <form autocomplete="off" class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
        <section class="section-111">
        </section>
        <section class="section-111" style="max-width: 1200px">
            <div>
                <fieldset>
                    <legend>Issue Item</legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Location</label>
                            <select name="location_id_fk" onchange="get_items({location_id:this.value})"></select>
                        </div>
                        <div class="field-p">
                            <label>Item </label>
                            <select name="item_location_id_fk" required></select>
                        </div>
                        <div class="field-p">
                            <label>Total Quantity</label>
                            <input name="total_quantity" type="text" readonly>
                        </div>
                        <div class="field-p">
                            <label>Issued Quantity</label>
                            <input name="issued_quantity" min="1" max="1" type="number" required>
                        </div>
                        <div class="field-p">
                            <label>Issued To</label>
                            <input name="issued_to" type="text" required>
                        </div>
                        
                        <div class="field-p">
                            <label>Issued By</label>
                            <input name="issued_by" type="text" required>
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
    function save() {
        //show_processing_modal()
        //submit_to_wait_btn('#submit', 'loading')
        $('#formErro').show()
        var form = document.getElementById('MyForm');
        var isValidForm = form.checkValidity();
        //var currentForm = $('#MyForm')[0];
        // var formData = new FormData(currentForm);
        if (isValidForm) {
            var arr = $('#MyForm').serializeArray();
            issued_quantity = parseInt($('[name="issued_quantity"]').val());
            total_quantity = parseInt($('[name="total_quantity"]').val());

            if(issued_quantity > total_quantity){
                alert('Invalid issuing quantity');
                return
            }
            var form_data = new FormData();

            var obj = {
                item_location_id_fk: $('[name="item_location_id_fk"]').val(),
                issued_to: $('[name="issued_to"]').val(),
                issued_by: $('[name="issued_by"]').val(),
                issued_quantity: issued_quantity
                
            }
            console.log(obj)
            // alert("data logged in console")
            for (var key in obj) {
                form_data.append(key, obj[key]);
            }
            form_data.append(key, obj[key]);
            $.ajax({
                url: window.location.pathname + '-action',
                type: 'POST',
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if ((typeof data) == 'string') {
                        data = JSON.parse(data)
                    }
                    alert(data.message);
                    if (data.status) {
                        window.history.back();
                        wait_to_submit_btn('#submit', 'ADD')
                        hide_processing_modal()
                    } else {
                        hide_processing_modal()
                        wait_to_submit_btn('#submit', 'ADD')
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
            // console.log(data);
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    items = data.response.list;  
                    // console.log(items);
                    show_items();
                }
            }
            $('[name="location_id_fk"]').prop('disabled', false);
        }
        });
    }
    function show_items() {
        if(items.length){
            var options = "";
            options += `<option value="">- - Select - -</option>`
            $.each(items, function(index, item) {
                options += `<option total_quantity="${item.quantity}" value="${item.id}">${item.item_name}</option>`;
            });
            $('[name="item_location_id_fk"]').html(options);
        }  
    }
    
    $(document.body).on('change', '[name="item_location_id_fk"]', function() {
        if($(this).val()){
            quantity = $('option:selected', this).attr('total_quantity');
            $('[name="total_quantity"]').val(quantity);
            $('[name="issued_quantity"]').attr('max', quantity);
        }
        else{
            $('[name="total_quantity"]').val('0');
            $('[name="issued_quantity"]').attr('max', '0');
        }
        
    });
</script>

<script type="text/javascript">
    function back_alert() {
        if (confirm('Are you Sure ?')) {
            window.history.back();
        }
    }
</script>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>