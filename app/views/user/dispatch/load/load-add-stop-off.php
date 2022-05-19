<?php
require_once APPROOT . '/views/includes/user/header-quick-view.php';
?>
<br><br>
<!-- <form class="lg-form" method="POST" id="MyForm"> -->
<section class="rv content-box" style="margin: auto;max-width: 500px !important;">
    <h1 class="rv-heading">Add Stop Off</h1>
    <section>
        <div><label style="width:50%">Stop Off Location</label>
            <input type="text" value="" style="width:70%" list="quick_list_addresses" data-selected-address-id="" name="stop_off_address_id" required>
        </div>
        <!-- <div style="margin-top:10px"><button type="button" class="btn_green" onclick="add_stop_off()">Save</button> &nbsp<button class="btn_red" data-close-top-action-sec>Close</button></div> -->
    </section>
    <div data-pagination></div>
</section>
<section class="lg-form-action-button-box">
    <button type="submit" id="button" class="btn_green" onclick="add_stop_off()">SAVE</button>
</section>
<!-- </form> -->


<script type="text/javascript">
    function add_stop_off() {

        submit_to_wait_btn('#submit', 'loading')
        $.ajax({
            url: '../user/dispatch/loads/add-stop-off-action',
            type: 'POST',
            data: {
                address_id: $('[name="stop_off_address_id"]').data('selected-address-id'),
                load_eid: '<?php echo $_GET['eid']; ?>',
            },
            success: function(data) {
                if ((typeof data) == 'string') {
                    data = JSON.parse(data)
                }

                if (data.status) {
                    window.opener.location.reload();
                    alert(data.message);
                    window.close();
                        
                    // window.location.reload()
                } else {
                    alert(data.message);
                }
                wait_to_submit_btn('#submit', 'Save')
            }
        })
        return false
    }
</script>

<datalist id="quick_list_addresses"></datalist>
<script type="text/javascript">
    $(document.body).on('change', '[data-selected-address-id]', function() {
        address_id_selected = $(`[data-addresses-filter-rows="${$(this).val()}"]`).data('value');
        if ($(this).val() != '') {
            if (address_id_selected == undefined) {
                alert('Invalid address selected');
                address_id_selected = ''
                $(this).val('')
                $(this).focus()
            }
        } else {
            address_id_selected = ''
        }
        $(this).data('selected-address-id', address_id_selected);
    });


    function show_quick_list_addresses() {
        quick_list_location_addresses().then(function(data) {
            // Run this when your request was successful
            if (data.status) {

                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option data-addresses-filter-rows="" data-value="" value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        options += `<option data-addresses-filter-rows="` + item.id + ' ' + item.name + `" data-value="${item.id}" data-eid="${item.eid}" value="` + item.id + ' ' + item.name + `"></option>`;
                    })
                    $('#quick_list_addresses').html(options);
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_quick_list_addresses()
</script>