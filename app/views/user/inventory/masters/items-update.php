<?php
require_once APPROOT . '/views/includes/user/header.php';
$details = $data['details'];
// echo '<pre>';
// print_r($details);
// echo '</pre>';
//exit;
?>
<br><br>
<section class="lg-form-outer">
    <div class="lg-form-header">Inventory - Update Item</div>
    <form autocomplete="off" class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
        <section class="section-111" style="max-width: 400px">
            <div>
                <fieldset>
                    <legend>Item Code</legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Item Code</label>
                            <input disabled name="item_code" type="text" value="<?php echo $details['item_code'] ?>">
                        </div>
                        <div class="field-p">
                            <label>Status</label>
                            <select name="status" data-default-select="<?php echo $details['status'] ?>">
                                <option value="ACTIVE">ACTIVE</option>
                                <option value="INACTIVE">INACTIVE</option>
                            </select>
                        </div>
                    </div>
                </fieldset>
            </div>
        </section>
        <section class="section-111">
            <div>
                <fieldset>
                    <legend>Item Details</legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Item Type</label>
                            <select name="product_type_id_fk" data-default-select="<?php echo $details['product_type_id_fk'] ?>"></select>
                        </div>
                        <div class="field-p">
                            <label>Item Name</label>
                            <select name="product_id_fk" data-default-select="<?php echo $details['product_id_fk'] ?>"></select>
                        </div>
                        <div class="field-p">
                            <label>Maker</label>
                            <select name="maker_id_fk" data-default-select="<?php echo $details['maker_id_fk'] ?>"></select>
                        </div>
                        <div class="field-p">
                            <label>Model</label>
                            <select name="model_id_fk" data-default-select="<?php echo $details['model_id_fk'] ?>"></select>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Description</legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Description</label>
                            <textarea name="description" type="text" value="<?php echo $details['description'] ?>" rows="4" cols="50"><?php echo $details['description'] ?></textarea>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div>
                <fieldset>
                    <legend>UOM</legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>UOM</label>
                            <select name="uom_id_fk" data-default-select="<?php echo $details['uom_id_fk'] ?>"></select>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Reorder Level</legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Minimum</label>
                            <input min="0" name="reorder_min" type="number" value="<?php echo $details['reorder_min'] ?>">
                        </div>
                        <div class="field-p">
                            <label>Maximum</label>
                            <input min="0" name="reorder_max" type="number" value="<?php echo $details['reorder_max'] ?>">
                        </div>
                    </div>
                </fieldset>
            </div>
        </section>
        <section class="section-111">
            <div>
                <fieldset>
                    <legend>Storage</legend>
                    <div class="field-section table-rows">
                        <table style="width: 100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Location</th>
                                    <th>Storage</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="location_tbody">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4"><button type="button" class="btn_blue" onclick="add_row({})">Add</button></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </fieldset>
            </div>
        </section>
        <section class="action-button-box">
            <button type="submit" id="submit" class="btn_green">SAVE</button>
            &nbsp; &nbsp;&nbsp;<button type="button" class="btn_green" onclick="back_alert()">BACK</button>
        </section>
    </form>
</section>

<script type="text/javascript">
    function save() {

        var min = $('[name="reorder_min"]').val();
        var max = $('[name="reorder_max"]').val();

        if(parseInt(min) >= parseInt(max)){
            alert('Invalid Min and Max Reorder values');
            return false;
        }
        
        var item_name = $('[name="item_code"]').val();
       item_name += ($('[name="product_id_fk"]').val()) ? ' '+$('[name="product_id_fk"] option:selected').text() : '';
       item_name += ($('[name="maker_id_fk"]').val()) ? ', '+$('[name="maker_id_fk"] option:selected').text() : '';
       item_name += ($('[name="model_id_fk"]').val()) ? ', '+$('[name="model_id_fk"] option:selected').text() : '';
        
        var $data_location_rows = $("[data-location-row]");
        data_location_array = [];

        $data_location_rows.each(function(index) {
            var $data_location_row = $(this);
            location_id = $data_location_row.find("[name=location_id_fk]").val();
            if(location_id){
                storage_array = [];

                var $data_storage_rows = $data_location_row.find("[data-storage-row]");
                // console.log($data_storage_rows)
                $data_storage_rows.each(function(index) {
                    var $data_storage_row = $(this);
                    storage_id = $data_storage_row.find("[name=storage_id_fk]").val();
                    if(storage_id){
                        storage_array.push({
                        storage_id_fk: storage_id,
                        item_location_storage_id: $data_storage_row.find("[name=item_location_storage_id]").val(),
                        item_location_storage_id_status: $data_storage_row.find("[name=item_location_storage_id_status]").val(),
                        });
                    }
                });
                var stop_row = {
                    item_location_id: $data_location_row.find("[name=item_location_id]").val(),
                    item_location_id_status: $data_location_row.find("[name=item_location_id_status]").val(),
                    location_id_fk: location_id,
                    storage_array: storage_array,
                }
                data_location_array.push(stop_row);
            }
            
        });
        if(!data_location_array.length){
            alert('Select atleast one location');
            return false;
        }
        // console.log(data_storage_array);return false;
        //show_processing_modal()
        //submit_to_wait_btn('#submit', 'loading')
        $('#formErro').show()
        var form = document.getElementById('MyForm');
        var isValidForm = form.checkValidity();
        //var currentForm = $('#MyForm')[0];
        // var formData = new FormData(currentForm);
        if (isValidForm) {
            var arr = $('#MyForm').serializeArray();
            var form_data = new FormData();
            var obj = {
                update_eid: '<?php echo $details['eid']; ?>',
                item_code: $('[name="item_code"]').val(),
                item_name: item_name,
                product_id_fk: $('[name="product_id_fk"]').val(),
                maker_id_fk: ($('[name="maker_id_fk"]').val()) ? $('[name="maker_id_fk"]').val(): '',
                model_id_fk: ($('[name="model_id_fk"]').val()) ? $('[name="model_id_fk"]').val(): '',
                uom_id_fk: ($('[name="uom_id_fk"]').val()) ? $('[name="uom_id_fk"]').val(): '',
                description: $('[name="description"]').val(),
                reorder_min: $('[name="reorder_min"]').val(),
                reorder_max: $('[name="reorder_max"]').val(),
                status: $('[name="status"]').val(),
                location_array: JSON.stringify(data_location_array)
            }
            // console.log(obj);return false;
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
    $(document.body).on('click', '[data-remove-row]', function() {
        let row_id = $(this).parents('tr').attr('id');
        if ($('tr#' + row_id + ' [name="item_location_id"]').val()) {
            $('tr#' + row_id + ' [name="item_location_id_status"]').val('DEL');
            $(this).parent().parent().hide();
            $(this).parents('tr').find('.cc').removeClass('cc');
        } else {
            $(this).parent().parent().remove();
        }
        cc = 0;
        $('.cc').each(function(index, item) {
            cc = cc + 1;
            $(this).html(cc)
        })
    });
</script>
<script>
    $(document.body).on('click', '[data-remove-sub-row]', function() {
        let row_id = $(this).parents('tr').attr('id');
        if ($('tr#' + row_id + ' [name="item_location_storage_id"]').val()) {
            $('tr#' + row_id + ' [name="item_location_storage_id_status"]').val('DEL');
            $(this).parent().parent().hide();
            // $(this).parents('tr').find('.cc').removeClass('cc');
        } else {
            $(this).parent().parent().remove();
        }
        // cc = 0;
        // $('.cc').each(function(index, item) {
        //     cc = cc + 1;
        //     $(this).html(cc)
        // })
    });
</script>
<script type="text/javascript">
    function show_storage_types(param) {
        get_storage_types().then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        if(item.storage_type_status == 'ACTIVE'){
                            options += `<option value="${item.id}">${item.storage_type}</option>`;
                        }
                    })
                    //$('tr#' + row_id + ' [name="storage_type_id_fk"]').html(options);
                    $('tr#' + param.row_id + ' [name="storage_type_id_fk"]').html(options);
                    if (param.hasOwnProperty('default_select')) {
                        $('tr#' + param.row_id + ' [name="storage_type_id_fk"] option[value="' + param.default_select + '"]').prop('selected', true);
                    }
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    // show_storage_types('row_0');
</script>
<script type="text/javascript">
    function show_locations(param) {
        get_product_locations().then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        if(item.location_status == 'ACTIVE'){
                            options += `<option value="${item.id}">${item.location}</option>`;
                        }
                    })
                    //$('tr#' + row_id + ' [name="location_id_fk"]').html(options);
                    $('tr#' + param.row_id + ' [name="location_id_fk"]').html(options);
                    if (param.hasOwnProperty('default_select')) {
                        $('tr#' + param.row_id + ' [name="location_id_fk"] option[value="' + param.default_select + '"]').prop('selected', true);
                    }
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    // show_locations('row_0');
</script>
<script type="text/javascript">
    $(document.body).on('change', '[name="storage_type_id_fk"]', function() {
        let row_id = $(this).parents('tr').attr('id');
        if ($(this).val() != '') {
            $(this).parents('tr').find('[name="storage_id_fk"]').prop('disabled', false);
            show_storage({
                type_id_fk: $(this).val(),
                row_id: row_id
            });
        } else {
            //$(this).parents('tr').find('[name="storage_id_fk"]').html('');
            //$(this).parents('tr').find('[name="storage_id_fk"]').prop('selectedIndex', 0).prop('disabled', true);
            $('#'+row_id).find('[name="storage_id_fk"]').html('');
            $('#'+row_id).find('[name="storage_id_fk"]').prop('selectedIndex', 0).prop('disabled', true);
        }
    });
</script>
<script type="text/javascript">
    function show_storage(param) {
        get_storage_names(param).then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        if(item.storage_status == 'ACTIVE'){
                            options += `<option value="${item.id}">${item.storage}</option>`;
                        }
                    })
                    $('tr#' + param.row_id + ' [name="storage_id_fk"]').html(options);
                    if (param.hasOwnProperty('default_select')) {
                        $('tr#' + param.row_id + ' [name="storage_id_fk"] option[value="' + param.default_select + '"]').prop('selected', true);
                    }
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
</script>
<script type="text/javascript">
    function show_product_type() {
        get_product_type().then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        if(item.product_type_status == 'ACTIVE'){
                            options += `<option value="${item.id}">${item.product_type}</option>`;
                        }
                    })
                    $('[name="product_type_id_fk"]').html(options);
                    select_default('[name="product_type_id_fk"]')
                    // show_products("<?php //echo $details['product_type_id_fk'] ?>")
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    // show_product_type()
</script>

<script type="text/javascript">
    $(document.body).on('change', '[name="product_type_id_fk"]', function() {
        $('[name="product_id_fk"]').html('');
        $('[name="maker_id_fk"]').html('');
        $('[name="model_id_fk"]').html('');
        var id = $(this).val();
        if (id != '') {
            show_products({
                type_id_fk: $(this).val(),
            });
        }
    });

    function show_products(param) {
        if (param.type_id_fk === '') {
            $('[name="product_id_fk"]').html('');
            $('[name="maker_id_fk"]').html('');
            $('[name="model_id_fk"]').html('');
        } else if (param.type_id_fk !== '') {
            get_product_names(param).then(function(data) {
                // Run this when your request was successful
                if (data.status) {
                    //Run this if response has list
                    if (data.response.list) {
                        var options = "";
                        options += `<option value="">- - Select - -</option>`
                        $.each(data.response.list, function(index, item) {
                            if(item.product_status == 'ACTIVE'){
                                options += `<option value="${item.id}">${item.product}</option>`;
                            }
                        })
                        $('[name="product_id_fk"]').html(options);
                        select_default('[name="product_id_fk"]')
                        // show_makers({
                        //     product_id_fk: $('[name="product_id_fk"]').val(),
                        // });
                    }
                }
            }).catch(function(err) {
                // Run this when promise was rejected via reject()
            })
        }
    }
</script>
<script type="text/javascript">
    $(document.body).on('change', '[name="product_id_fk"]', function() {
        $('[name="maker_id_fk"]').html('');
        $('[name="model_id_fk"]').html('');
        var id = $(this).val();
        if (id != '') {
            show_makers({
                product_id_fk: $(this).val(),
            });
        }
    });

    function show_makers(param) {
        if (param.product_id_fk === '') {
            $('[name="maker_id_fk"]').html('');
            $('[name="model_id_fk"]').html('');
        } else if (param.product_id_fk !== '') {
            get_product_makers(param).then(function(data) {
                // Run this when your request was successful
                //console.log(data);
                if (data.status) {
                    //Run this if response has list
                    if (data.response.list) {
                        var options = "";
                        options += `<option value="">- - Select - -</option>`
                        $.each(data.response.list, function(index, item) {
                            if(item.maker_status == 'ACTIVE'){
                                options += `<option value="${item.id}">${item.maker}</option>`;
                            }
                        })
                        $('[name="maker_id_fk"]').html(options);
                        select_default('[name="maker_id_fk"]')
                        // show_models({
                        //     maker_id_fk: $('[name="maker_id_fk"]').val(),
                        // });
                    }
                }
            }).catch(function(err) {
                // Run this when promise was rejected via reject()
            })
        }
    }
</script>
<script type="text/javascript">
    $(document.body).on('change', '[name="maker_id_fk"]', function() {
        $('[name="model_id_fk"]').html('');
        var id = $(this).val();
        if (id != '') {
            show_models({
                maker_id_fk: $(this).val(),
            })
        }
    });

    function show_models(param) {
        if (param.maker_id_fk === '') {
            $('[name="model_id_fk"]').html('');
        } else if (param.maker_id_fk !== '') {
            get_product_models(param).then(function(data) {
                // Run this when your request was successful
                //console.log(data);
                if (data.status) {
                    //Run this if response has list
                    if (data.response.list) {
                        var options = "";
                        options += `<option value="">- - Select - -</option>`
                        $.each(data.response.list, function(index, item) {
                            if(item.model_status == 'ACTIVE'){
                                options += `<option value="${item.id}">${item.model}</option>`;
                            }
                        })
                        $('[name="model_id_fk"]').html(options);
                        select_default('[name="model_id_fk"]')
                    }
                }
            }).catch(function(err) {
                // Run this when promise was rejected via reject()
            })
        }
    }
</script>
<script type="text/javascript">
    function show_uom() {
        get_unit_of_measurement().then(function(data) {
            // Run this when your request was successful
            if (data.status) {
                //Run this if response has list
                if (data.response.list) {
                    var options = "";
                    options += `<option value="">- - Select - -</option>`
                    $.each(data.response.list, function(index, item) {
                        if(item.uom_status == 'ACTIVE'){
                            options += `<option value="${item.id}">${item.uom}</option>`;
                        }
                    })
                    $('[name="uom_id_fk"]').html(options);
                    select_default('[name="uom_id_fk"]')
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    // show_uom()
</script>

<script type="text/javascript">
    var counter = 0
    var cc = 0
    var $issue_table = $('#location_tbody');

    function add_row(param) {
        ++counter;
        ++cc;
        if (param.hasOwnProperty('item_location_id')) {
            item_location_id = param.item_location_id
        } else {
            item_location_id = ''
        }
        if (param.hasOwnProperty('item_location_id_status')) {
            item_location_id_status = param.item_location_id_status
        } else {
            item_location_id_status = 'ACT'
        }
        if (param.hasOwnProperty('default_select_location_id_fk')) {
            default_select_location_id_fk = param.default_select_location_id_fk
        } else {
            default_select_location_id_fk = ''
        }
       
        
       
        var $add_row = `<tr id="row_${counter}" data-location-row>
           <td class="cc">${cc}</td>
            <td>
                <input type="hidden" name="item_location_id" value="${item_location_id}">
                <input type="hidden" name="item_location_id_status" value="${item_location_id_status}">
                <select required style="width: 300px" name="location_id_fk"></select>
            </td>
            <td>
                <table style="width: 100%;border: 1px solid;padding: 10px">
                    <tbody id="storage_tbody_${counter}">


                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="text-align: right" colspan="3"><button type="button" onclick="add_sub_row({row_id: ${counter}})" class="btn_blue" >Add Storage</button></td>
                        </tr>
                    </tfoot>
                </table>
            </td>
           
            `;
        if (counter > 1) {
        $add_row += ` <td><button type="button" class="btn_red_c" data-remove-row=""><i class="fa fa-trash"></i></button></td>`;
         }
        $add_row += ` </tr>`;
        $('#location_tbody').append($add_row);
        show_locations({
            row_id: 'row_' + counter,
            default_select: default_select_location_id_fk
        })
       
        if(item_location_id == ''){
            add_sub_row({ row_id: counter });
        }

    }
</script>
<script type="text/javascript">
    var sub_row_counter = 0;
    function add_sub_row(param) {
        row_id = param.row_id
        if (param.hasOwnProperty('item_location_storage_id')) {
            item_location_storage_id = param.item_location_storage_id
        } else {
            item_location_storage_id = ''
        }if (param.hasOwnProperty('item_location_storage_id_status')) {
            item_location_storage_id_status = param.item_location_storage_id_status
        } else {
            item_location_storage_id_status = 'ACT'
        }
        if (param.hasOwnProperty('default_select_storage_type_id_fk')) {
            default_select_storage_type_id_fk = param.default_select_storage_type_id_fk
        } else {
            default_select_storage_type_id_fk = ''
        }
        if (param.hasOwnProperty('default_select_storage_id_fk')) {
            default_select_storage_id_fk = param.default_select_storage_id_fk
        } else {
            default_select_storage_id_fk = ''
        }

        var total_rows = $('#storage_tbody_'+row_id).find('tr').length;
        // ++cc;
        var html = `
            <tr id="sub_row_${sub_row_counter}" data-storage-row>
                <td></td>
                <td>
                    <input type="hidden" name="item_location_storage_id" value="${item_location_storage_id}">
                    <input type="hidden" name="item_location_storage_id_status" value="${item_location_storage_id_status}">
                    <select required style="width: 300px" name="storage_type_id_fk"></select>
                </td>
                <td>
                    <select required style="width: 300px" name="storage_id_fk"></select>
                </td>
                <td>`;
            if(total_rows > 0){
                html += `<button type="button" class="btn_red_c" data-remove-sub-row=""><i class="fa fa-trash"></i></button>`;
            }

             html += `</td>
            </tr>
           
        `;
        // $('#row_'+(row_count-1)).after(html);
        $('#storage_tbody_'+row_id).append(html);
        // show_storage_types('sub_row_' + sub_row_counter);
        show_storage_types({
            row_id: 'sub_row_' + sub_row_counter,
            default_select: default_select_storage_type_id_fk
        })
        if (param.hasOwnProperty('default_select_storage_type_id_fk')) {
            show_storage({
                type_id_fk: param.default_select_storage_type_id_fk,
                row_id: 'sub_row_' + sub_row_counter,
                default_select: default_select_storage_id_fk
            })
        }
        sub_row_counter += 1;
    }
</script>
<script type="text/javascript">
    async function f() {
        show_processing_modal()
        submit_to_wait_btn('#submit','loading');

        show_product_type();
        show_products("<?php echo $details['product_type_id_fk'] ?>");
        show_makers({ product_id_fk: "<?php echo $details['product_id_fk'] ?>" });
        show_models({ maker_id_fk: "<?php echo $details['maker_id_fk'] ?>" });
        show_uom();

        var locations_list = '<?php echo json_encode($details['locations']) ?>';
        locations_list = JSON.parse(locations_list)
        // console.log(locations_list);
        var time = 1000;
        $.each(locations_list, function(index, item) {

            setTimeout(function(){

                add_row({
                    item_location_id: item.item_location_id,
                    item_location_id_status: item.item_location_id_status,
                    default_select_location_id_fk: item.location_id_fk,
                })

            if(item.storage.length > 0){
                $.each(item.storage, function(index2, item2) {
                add_sub_row({
                        row_id: counter,
                        item_location_storage_id: item2.item_location_storage_id,
                        item_location_storage_id_status: item2.item_location_storage_id_status,
                        default_select_storage_type_id_fk: item2.storage_type_id_fk,
                        default_select_storage_id_fk: item2.storage_id_fk
                    })
                })
            }
            else{
                add_sub_row({
                        row_id: counter
                    })
                
            }
                
          
            }, time);
                
          time += 1000;

        })
        wait_to_submit_btn('#submit','SAVE')
        hide_processing_modal()
    }
    f()
</script>

<script>
    
    $(document.body).on('change', '[name="location_id_fk"]', function() {
        var obj = $(this);
        var new_location_id = $(this).val();
        if(new_location_id != '')
        {
            var $data_location_rows = $("[data-location-row]");
 
            var location_array = [];
            $data_location_rows.each(function(index) {
                var $data_location_row = $(this);
                var location_id = $data_location_row.find("[name=location_id_fk]").val(); 
                var status = $data_location_row.find("[name=item_location_id_status]").val();
                if(status == 'ACT'){
                    location_array.push(location_id)
                }  
                
            });

            var index = location_array.indexOf(new_location_id);
            if (index > -1) {
                location_array.splice(index, 1);
            }

            index = location_array.indexOf(new_location_id);
            if (index > -1) {
                alert('Duplicate location not allowed');
                obj.val('');
            }
        
        }
    });
</script>
<script>
    
    $(document.body).on('change', '[name="storage_id_fk"]', function() {
        var obj = $(this);
        var new_storage_id = $(this).val();
        if(new_storage_id != '')
        {
            var $data_storage_rows = $(this).closest('[data-location-row]').find('[data-storage-row]');
 
            var storage_array = [];
            $data_storage_rows.each(function(index) {
                var $data_storage_row = $(this);
                var storage_id = $data_storage_row.find("[name=storage_id_fk]").val();
                var status = $data_storage_row.find("[name=item_location_storage_id_status]").val();
                if(status == 'ACT'){
                    storage_array.push(storage_id)
                }
            });

            var index = storage_array.indexOf(new_storage_id);
            if (index > -1) {
                storage_array.splice(index, 1);
            }

            index = storage_array.indexOf(new_storage_id);
            if (index > -1) {
                alert('Duplicate storage not allowed');
                obj.val('');
            }
        
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