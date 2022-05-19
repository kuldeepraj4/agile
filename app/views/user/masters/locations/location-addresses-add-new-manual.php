<?php
require_once APPROOT . '/views/includes/user/header.php';
?>
<br><br>

<section class="lg-form-outer">
    <div class="lg-form-header">ADD NEW LOCATION ADDRESS MANUALLY</div>

    <form class="lg-form" method="POST" id="MyForm" onsubmit="return add_new()">
       
        <br>
        <section class="section-11">
            <div>
                <fieldset>
                    <legend>Location Address</legend>
                    <div class="field-section single-column">
                        <div class="field-p">
                            <label>Location Name</label>
                            <input type="text" name="name" required="required">
                        </div>
                        <div class="field-p">
                            <label>Address Line</label>
                            <input type="text" name="address_line" required>
                        </div>
                        <div class="field-p">
                            <label>City</label>
                            <input type="text" name="city" required>
                        </div>
                        <div class="field-p">
                            <label>State</label>
                            <input type="text" name="state" required="required">
                        </div>
                        <div class="field-p">
                            <label>Zipcode</label>
                            <input type="text" name="zipcode" required="required">
                        </div>
                        <div class="field-p">
                            <label>Latitude</label>
                            <input type="number" step="any" name="latitude" required="required">
                        </div>
                        <div class="field-p">
                            <label>Longitude</label>
                            <input type="number" step="any" name="longitude" required="required">
                        </div>
                        <div class="field-p">
                            <label>Phone Number</label>
                            <input type="text" name="phone_number">
                        </div>
                        <div class="field-p">
                            <label>Fax Number</label>
                            <input type="text" name="fax_number">
                        </div>
                        <div class="field-p">
                            <label>Sales Representative</label>
                            <input type="text" name="sales_respresentative">
                        </div>
                        <div class="field-p">
                            <label>Customer service Representative</label>
                            <input type="text" name="customer_service_respresentative">
                        </div>
                        <div class="field-p">
                            <label>Hours of operation</label>
                            <input type="text" name="hours_of_operation">
                        </div>
                        <div class="field-p">
                            <label>Remarks</label>
                            <textarea name="remarks" style="height:80px"></textarea>
                        </div>
                    </div>
                </fieldset>
            </div>
            <!-- </div> -->
        </section>
        <section class="action-button-box">
            <button type="submit" class="btn_green">SAVE</button>
            <button type="button" class="btn_green" onclick="back_alert()" style="margin-left: 10px;">BACK</button>
        </section>
    </form>
</section>
<script type="text/javascript">
    function back_alert() {
        if (confirm('Are you Sure ?')) {
            window.history.back();
        }
    }
</script>



<script type="text/javascript">
    function add_new() {
        submit_to_wait_btn('#submit', 'loading')
        $('#formErro').show()
        var form = document.getElementById('MyForm');
        var isValidForm = form.checkValidity();
        var currentForm = $('#MyForm')[0];
        var formData = new FormData(currentForm);
        if (isValidForm) {
            var arr = $('#MyForm').serializeArray();
            var obj = {}
            for (var a = 0; a < arr.length; a++) {
                obj[arr[a].name] = arr[a].value
            }
            $.ajax({
                url: window.location.href + '-action',
                type: 'POST',
                data: obj,
                success: function(data) {
                   // alert(data)
                    if ((typeof data) == 'string') {
                        data = JSON.parse(data)
                    }
                    alert(data.message);
                    if (data.status) {
                        location.href = '../user/masters/locations/location-addresses';
                        wait_to_submit_btn('#submit', 'SAVE')
                    } else {
                        wait_to_submit_btn('#submit', 'SAVE')
                    }
                }
            })
        }
        return false
    }
</script>
<script type="text/javascript">
    $(document).on("click", "[data-add-city]", function() {
        open_child_window({
            url: '../user/masters/locations/stopoff/quick-add-new',
            name: 'AddStopOff',
            width: 500,
            height: 500
        })
    });
</script>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>