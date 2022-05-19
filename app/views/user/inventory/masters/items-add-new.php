<?php
require_once APPROOT . '/views/includes/user/header.php';
//$ro_details = $data['ro_details'];
// print_r($ro_details)
?>
<br><br>
<section class="lg-form-outer">
    <div class="lg-form-header">Inventory - Add New Item</div>
    <form autocomplete="off" class="lg-form" method="POST" id="MyForm" onsubmit="return save()">
        
        <section class="section-111">
            <div>
                <fieldset>
                    <legend>Item Details</legend>
                    <div class="field-section single-column">

                        <div class="field-p">
                            <label>Item Type</label>
                            <select required name="product_type_id_fk"></select>
                        </div>
                        <div class="field-p">
                            <label>Item Name</label>
                            <select required name="product_id_fk"></select>
                        </div>
                        <div class="field-p">
                            <label>Maker</label>
                            <select name="maker_id_fk"></select>
                        </div>
                        <div class="field-p">
                            <label>Model</label>
                            <select name="model_id_fk"></select>
                        </div>

                    </div>
                </fieldset>
                <fieldset>
                    <legend>Description</legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Description</label>
                            <textarea  name="description" type="text" rows="4" cols="50"></textarea>
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
                            <select name="uom_id_fk" required></select>
                        </div>

                    </div>
                </fieldset>
                <fieldset>
                    <legend>Reorder Level</legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Minimum</label>
                            <input min="0" name="reorder_min" type="number" required>
                        </div>
                        <div class="field-p">
                            <label>Maximum</label>
                            <input min="0" name="reorder_max" type="number" required>
                        </div>
                    </div>
                    <div class="field-p">
                        <label>Image</label>
                        <input class="inv_no" type="file" id="invoice_file" name="" >
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
                                    <th>Sr.No</th>
                                    <th>Location</th>
                                    <th>Storage</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="location_tbody">
                                <tr id="row_0" data-location-row>
                                    <td class="cc">1</td>
                                    <td>
                                        <select required style="width: 300px" name="location_id_fk"></select>
                                    </td>
                                    <td>
                                        <table style="width: 100%;border: 1px solid;padding: 10px">
                                            <tbody id="storage_tbody_0">
                                                <tr id="sub_row_0" data-storage-row>
                                                    <td></td>
                                                    <td>
                                                        <select required style="width: 300px" name="storage_type_id_fk"></select>
                                                    </td>
                                                    <td>
                                                        <select required style="width: 300px" name="storage_id_fk"></select>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td style="text-align: right" colspan="3"><button type="button" onclick="add_sub_row(0)" class="btn_blue" >Add Storage</button></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4"><button type="button" class="btn_blue" onclick="add_row()">Add Location</button></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </fieldset>
            </div>
        </section>

        <section class="action-button-box">

            <button type="submit" class="btn_green">SAVE</button>
            &nbsp; &nbsp;&nbsp;<button type="button" class="btn_green" onclick="back_alert()">BACK</button>
        </section>
    </form>
</section>
<!-- <script>
    
    $(document.body).on('change', '[name="location_id_fk"]', function() {
        var obj = $(this);
        var new_location_id = $(this).val();
        var $data_location_rows = $("[data-location-row]");
        var location_array = [];
        $data_location_rows.each(function(index) {
            var $data_location_row = $(this);
            location_id = $data_location_row.find("[name=location_id_fk]").val();

            if(location_id != '')
            {
                if ($.inArray(new_location_id, location_array) >= 0) {
                    alert('Duplicate locations not allowed');
                    obj.val('');
                }
                else {
                    location_array.push(location_id)
                }
            } 
            
        });
        // console.log('location_array', location_array);
    });
</script> -->
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
                location_id = $data_location_row.find("[name=location_id_fk]").val();   
                location_array.push(location_id)
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
                storage_id = $data_storage_row.find("[name=storage_id_fk]").val();   
                storage_array.push(storage_id)
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

    function save() {

        var min = $('[name="reorder_min"]').val();
        var max = $('[name="reorder_max"]').val();
        if(parseInt(min) >= parseInt(max)){
            alert('Invalid Min and Max Reorder values');
            return false;
        }

        var item_name = '';
       item_name = ($('[name="product_id_fk"]').val()) ? ''+$('[name="product_id_fk"] option:selected').text() : '';
       item_name += ($('[name="maker_id_fk"]').val()) ? ', '+$('[name="maker_id_fk"] option:selected').text() : '';
       item_name += ($('[name="model_id_fk"]').val()) ? ', '+$('[name="model_id_fk"] option:selected').text() : '';


        var $data_location_rows = $("[data-location-row]");
        data_location_array = [];

        $data_location_rows.each(function(index) {
            var $data_location_row = $(this);
            location_id = $data_location_row.find("[name=location_id_fk]").val();
            if(location_id != ''){
                storage_array = [];

                var $data_storage_rows = $data_location_row.find("[data-storage-row]");
            
                $data_storage_rows.each(function(index) {
                    var $data_storage_row = $(this);
                    storage_id = $data_storage_row.find("[name=storage_id_fk]").val();
                    if(storage_id){
                        storage_array.push({storage_id_fk: storage_id});
                    }
                });
                var stop_row = {
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
        
        // console.log(data_location_array);return false;

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

            if (document.getElementById('invoice_file').files.length != 0) {
                var property = document.getElementById('invoice_file').files[0];
            }
            form_data.append(`document`, property);

            var obj = {
                product_id_fk: $('[name="product_id_fk"]').val(),
                maker_id_fk: ($('[name="maker_id_fk"]').val()) ? $('[name="maker_id_fk"]').val(): '',
                model_id_fk: ($('[name="model_id_fk"]').val()) ? $('[name="model_id_fk"]').val(): '',
                uom_id_fk: ($('[name="uom_id_fk"]').val()) ? $('[name="uom_id_fk"]').val(): '',
                description: $('[name="description"]').val(),

                reorder_min: $('[name="reorder_min"]').val(),
                reorder_max: $('[name="reorder_max"]').val(),
                location_array: JSON.stringify(data_location_array),
                item_name: item_name
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
    var sub_row_count = 1;
    function add_sub_row(row_id) {
        // ++cc;
        var html = `
            <tr id="sub_row_${sub_row_count}" data-storage-row>
                <td></td>
                <td>
                    <select required style="width: 300px" name="storage_type_id_fk"></select>
                </td>
                <td>
                    <select required style="width: 300px" name="storage_id_fk"></select>
                </td>
                <td>
                    <button type="button" class="btn_red_c" data-remove-sub-row=""><i class="fa fa-trash"></i></button>
                </td>
            </tr>
           
        `;
        // $('#row_'+(row_count-1)).after(html);
        $('#storage_tbody_'+row_id).append(html);
        show_storage_types('sub_row_' + sub_row_count);
        sub_row_count += 1;
    }
</script>
<script>
    var row_count = 1;
    var cc = 1;

    function add_row() {
        ++cc;
        var html = `
    
        <tr id="row_${row_count}" data-location-row>
            <td class="cc">${cc}</td>
            <td>
                <select required style="width: 300px" name="location_id_fk"></select>
            </td>
            <td>
                <table style="width: 100%;border: 1px solid;padding: 10px">
                    <tbody id="storage_tbody_${row_count}">
                        <tr id="sub_row_${sub_row_count}" data-storage-row>
                            <td></td>
                            <td>
                                <select required style="width: 300px" name="storage_type_id_fk"></select>
                            </td>
                            <td>
                                <select required style="width: 300px" name="storage_id_fk"></select>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="text-align: right" colspan="3"><button type="button" onclick="add_sub_row(${row_count})" class="btn_blue" >Add Storage</button></td>
                        </tr>
                    </tfoot>
                </table>
            </td>
           
            <td>
            <button type="button" class="btn_red_c" data-remove-row=""><i class="fa fa-trash"></i></button>
            </td>
        </tr>
        `;
        // $('#row_'+(row_count-1)).after(html);
        $('#location_tbody').append(html);
        show_storage_types('sub_row_' + sub_row_count );
        show_locations('row_' + row_count);
        row_count += 1;
        sub_row_count += 1;
    }
    $(document.body).on('click', '[data-remove-row]', function() {
        $(this).parent().parent().remove();
        cc = 0;
        $('.cc').each(function(index, item) {
            cc = cc + 1;
            $(this).html(cc)
        })
    });
    $(document.body).on('click', '[data-remove-sub-row]', function() {
        $(this).parent().parent().remove();
       
    });


    function show_storage_types(row_id) {
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
                    $('tr#' + row_id + ' [name="storage_type_id_fk"]').html(options);
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
    show_storage_types('sub_row_0');

    function show_locations(row_id) {
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
                    $('tr#' + row_id + ' [name="location_id_fk"]').html(options);
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }

    show_locations('row_0');

    $(document.body).on('change', '[name="storage_type_id_fk"]', function() {
        let row_id = $(this).closest('tr').attr('id');
        if ($(this).val() != '') {
            $(this).closest('tr').find('[name="storage_id_fk"]').prop('disabled', false);
            show_storage($(this).val(), row_id);

        } else {
            $(this).closest('tr').find('[name="storage_id_fk"]').html('');
            $(this).closest('tr').find('[name="storage_id_fk"]').prop('selectedIndex', 0).prop('disabled', true);
        }
    });

    function show_storage(id, row_id) {
        get_storage_names({
            type_id_fk: id
        }).then(function(data) {
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
                    // $('[name="storage_id_fk"]').html(options);
                    $('tr#' + row_id + ' [name="storage_id_fk"]').html(options);
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }
</script>
<script>
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
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }

    show_product_type()
</script>
<script>
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
                }
            }
        }).catch(function(err) {
            // Run this when promise was rejected via reject()
        })
    }

    show_uom()
</script>

<script type="text/javascript">
    $(document.body).on('change', '[name="product_type_id_fk"]', function() {
        $('[name="product_id_fk"]').html('');
        $('[name="maker_id_fk"]').html('');
        $('[name="model_id_fk"]').html('');
        var id = $(this).val();
        if (id != '') {
            get_product_names({
                type_id_fk: id
            }).then(function(data) {
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
                    }
                }
            }).catch(function(err) {
                // Run this when promise was rejected via reject()
            })
        }

    });
</script>
<script type="text/javascript">
    $(document.body).on('change', '[name="product_id_fk"]', function() {
        $('[name="maker_id_fk"]').html('');
        $('[name="model_id_fk"]').html('');
        var id = $(this).val();
        if (id != '') {
            get_product_makers({
                product_id_fk: id
            }).then(function(data) {
                // Run this when your request was successful
                console.log(data);
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
                    }
                }
            }).catch(function(err) {
                // Run this when promise was rejected via reject()
            })
        }

    });

    $(document.body).on('change', '[name="maker_id_fk"]', function() {
        $('[name="model_id_fk"]').html('');
        var id = $(this).val();
        if (id != '') {
            get_product_models({
                maker_id_fk: id
            }).then(function(data) {
                // Run this when your request was successful
                console.log(data);
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
                    }
                }
            }).catch(function(err) {
                // Run this when promise was rejected via reject()
            })
        }

    });
</script>
<script type="text/javascript">
    //     function show_locations(){
    //         get_product_locations().then(function(data) {
    //         // Run this when your request was successful
    //         if(data.status){

    //             //Run this if response has list
    //             if(data.response.list){
    //             var options="";
    //             options+=`<option value="">- - Select - -</option>`
    //             $.each(data.response.list, function(index, item) {
    //                 options+=`<option value="${item.id}">${item.location}</option>`;               
    //             })
    //             $('[name="location_id_fk"]').html(options);     
    //         }
    //         }
    //         }).catch(function(err) {
    //         // Run this when promise was rejected via reject()
    //         }) 
    // }

    // show_locations()
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