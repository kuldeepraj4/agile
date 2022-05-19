<?php
require_once APPROOT . '/views/includes/user/header.php'; 
?>

<br>

<section class="lg-form-outer">

  <div class="lg-form-header">ADD NEW - INSPECTION SHEET</div>

  <form class="lg-form" method="POST" id="MyForm" onsubmit="return save()">

    <section class="section-111">

      <div>
        <fieldset>
          <legend>Basic Information</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Status</label>
              <select name="status_id" data-filter="status_id" disabled>
                <option value="">- - Select - -</option>
                <option selected value="OPEN">Open</option>
                <option value="CLOSED">Closed</option>
              </select>
            </div>
            <div class="field-p">
              <label>Inspection Date</label>
              <input name="inspection_date" data-date-picker type="text" required>
            </div>
            <div class="field-p">
              <label>Start Time</label>
              <input name="from_time" data-time-picker type="text" required>
            </div>
            <div class="field-p">
              <label>End Time</label>
              <input name="to_time" data-time-picker-inspection type="text">
            </div>
            <div class="field-p">
              <label>Reference No.</label>
              <input name="reference_no" type="text" required onchange="if(this.value!=''){inspection_sheet_reference(this.value)}">
            </div>
          </div>
        </fieldset>
        <fieldset>
          <legend>Asset Information</legend>
          <div class="field-section single-column" group-enable-disable>
            <div class="field-p">
              <label>Driver ID</label>
              <input type="hidden" name="driver_id" required><br>
              <input type="text" list="quick_list_driver_id" data-driver-id required>
            </div>
            <div class="field-p">
              <label>Co-driver ID</label>
              <input type="hidden" name="codriver_id" required><br>
              <input type="text" list="quick_list_codriver_id" data-codriver-id>
            </div>
            <div class="field-p">
              <label>Truck ID</label>
              <input type="hidden" name="truck_id" required><br>
              <input type="text" list="quick_list_truck_id" data-truck-id required>
            </div>
            <div class="field-p">
              <label>Trailer ID</label>
              <input type="hidden" name="trailer_id" required><br>
              <input type="text" list="quick_list_trailer_id" data-trailer-id>
            </div>
          </div>
        </fieldset>

        <fieldset>
          <legend>Level</legend>
          <div class="field-section single-column">
            <div class="field-p">
              <label>Level</label>
              <select name="level_id" id="level_id" required>
                <option value="">- - Select - -</option>
                <option value="LEVEL 1">Level 1</option>
                <option value="LEVEL 2">Level 2</option>
                <option value="LEVEL 3">Level 3</option>
              </select>
            </div>
          </div>
        </fieldset>
      </div>

      <div>
        <fieldset>
          <legend>Verbal Warning Information</legend>
          <div class="field-section single-column" group-enable-disable>
            <div class="field-p">
              <label>Given By</label>
              <input type="hidden" name="user_id" value="<?php echo $details['user_id'] ?>"><br>
              <input type="text" list="quick_list_user_id" data-user-id>
            </select>
          </div>
          <div class="field-p">
            <label>Date & Time</label>
            <input name="verbal_warning_given_date" style="width:100px" data-date-picker type="text">
            <input name="verbal_warning_given_time" style="width: 40px" data-time-picker type="text">
          </input>
        </div>
      </div>
    </fieldset>

    <fieldset>
      <legend>Driver Statement</legend>
      <div class="field-section single-column" group-enable-disable>
        <div class="field-p">
          <textarea name="driver_statement" style="height: 100px" type="text"></textarea>
        </div>
      </div>
    </fieldset>

    <fieldset>
      <legend>Book Transfer Information</legend>
      <div class="field-section single-column">
        <div class="field-p">
          <label>Book Transfer</label>
          <select name="book_transfer_id" id="book_transfer_id" required>
            <option value="">- - Select - -</option>
            <option value="YES">Yes</option>
            <option value="NO">No</option>
          </select>
        </div>
        <div class="field-p">
          <label>Book Tag</label>
          <select name="book_tag_id" id="book_tag_id" required>
            <option value="">- - Select - -</option>
            <option value="MB">MB</option>
            <option value="TB">TB</option>
            <option value="MB MS">MB MS</option>
            <option value="MB ES">MB ES</option>
            <option value="TB MS">TB MS</option>
            <option value="TB ES">TB ES</option>
          </select>
        </div>
      </div>
    </fieldset>
  </div>
  <div>
    <fieldset>
      <legend>Location Information</legend>
      <div class="field-section single-column">
        <div class="field-p">
          <label>Company Name</label>
          <select name="company_id" id="company_id" required></select>
        </div>
        <div class="field-p">
          <label>Location</label>
          <input name="location" type="text">
        </div>
        <div class="field-p">
          <label>State</label>
          <select name="state_id" id="state_id" required type="text" onchange="show_cities({state_id:this.value})" required data-optional></select>
        </div>
        <div class="field-p">
          <label>City</label>
          <select name="city_id" id="city_id" required disabled></select>
        </div>
      </div>
    </fieldset>
    <fieldset>
      <legend>Violation Information</legend>
      <div class="field-section single-column" group-enable-disable>
        <div class="field-p">
          <label>Violation Reported</label>
          <select name="violation_reported_id" id="violation_reported_id" data-filter="violation_reported_id" required>
          </select>
        </div>
        <div class="field-p">
          <label>Fined Amount</label>
          <input name="fined_amount" type="number" step="any" class="zero" value="">
        </div>
        <div class="field-p">
          <label>Bond Amount</label>
          <input name="bond_amount" type="number" step="any" class="zero" value="">
        </div>
      </div>
    </fieldset> 
    <fieldset>
      <legend>Remarks</legend>
      <div class="field-section single-column" group-enable-disable>  
        <div class="field-p">
          <textarea name="remarks" style="height: 80px" type="text"></textarea>
        </div>
      </div>
    </fieldset>
  </div>
</section>

<section class="section-1" style="width:100%">
  <div>
    <fieldset>
      <legend>Driver's List</legend>
      <div class="field-section table-rows">
        <table style="width: 100%">
          <thead>
            <tr>
              <th>Sr. No.</th>
              <th></th>
              <th>Reason</th>
              <th>Remarks</th>
              <th>Corrective Action</th>
              <!-- <th>Ref. Document No.</th> -->
              <th>Action</th>                                      
            </tr>
          </thead>
          <tbody id="asset_drivers">
            <tr id="issue_row1" data-drivers-row>
                  <!-- <td>1</td>                              
                  <td><select name="asset_type_id" required hidden></select></td>
                  <td><select name="asset_reason_id"></select></td>
                  <td><input name="asset_remarks"  type="text"></td>                              
                  <td><select name="asset_corrective_id"></select></td> -->
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="8" align="right"><button type="button" class="btn_blue" onclick="add_row_drivers({})">Add Row</button>
                  </td>
                </tr>
              </tfoot>
            </table>
          </div>
        </fieldset>
      </div>
    </section>

    <section class="section-1" style="width:100%">
      <div>
        <fieldset>
          <legend>Truck's List</legend>
          <div class="field-section table-rows">
            <table style="width: 100%">
              <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th></th>
                  <th>Reason</th>
                  <th>Remarks</th>
                  <th>Corrective Action</th>
                  <th>Action</th>                                      
                </tr>
              </thead>
              <tbody id="asset_trucks">
                <tr id="issue_row2" data-trucks-row>
                  <!-- <td>1</td>                              
                  <td><select name="asset_type_id_trucks" hidden></select></td>
                  <td><select name="asset_reason_id_trucks"></select></td>
                  <td><input name="asset_remarks_trucks" type="text"></td>                              
                  <td><select name="asset_corrective_id_trucks"></select></td> -->
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="8" align="right"><button type="button" class="btn_blue" onclick="add_row_trucks({})">Add Row</button>
                  </td>
                </tr>
              </tfoot>
            </table>
          </div>
        </fieldset>
      </div>
    </section>

    <section class="section-1" style="width:100%">
      <div>
        <fieldset>
          <legend>Trailer's List</legend>
          <div class="field-section table-rows">
            <table style="width: 100%">
              <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th></th>
                  <th>Reason</th>
                  <th>Remarks</th>
                  <th>Corrective Action</th>
                  <!-- <th>Ref. Document No.</th> -->
                  <th>Action</th>                                      
                </tr>
              </thead>
              <tbody id="asset_trailers">
                <tr id="issue_row3" data-trailers-row>
                  <!-- <td>1</td>                              
                  <td><select name="asset_type_id_trailers" hidden></select></td>
                  <td><select name="asset_reason_id_trailers"></select></td>
                  <td><input name="asset_remarks_trailers" type="text"></td>                              
                  <td><select name="asset_corrective_id_trailers"></select></td> -->
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="8" align="right"><button type="button" class="btn_blue" onclick="add_row_trailers({})">Add Row</button>
                  </td>
                </tr>
              </tfoot>
            </table>
          </div>
        </fieldset>
      </div>
    </section>

    <section class="action-button-box">
      <!-- <button type="submit" class="btn_green">Save</button>&nbsp &nbsp -->
      <button type="submit" data-submit></button>
      <button type="button" class="btn_green" onclick="set_pref(0)">SAVE</button> &nbsp &nbsp
      <button type="button" class="btn_green" onclick="set_pref(1)">SAVE & UPLOAD DOCUMENTS</button> &nbsp &nbsp
      <button type="button" class="btn_green" onclick="back_alert()" >BACK</button>
    </section>

  </form>

</section>

<script type="text/javascript">
    function inspection_sheet_reference(param) {
        $.ajax({
            url: "<?php echo AJAXROOT; ?>" + 'user/maintenance/inspection-sheet-ajax',
            type: 'POST',
            data: {
                refence_no: param,
            },
            success: function(data) {
                if ((typeof data) == 'string') {
                    data = JSON.parse(data)
                    if (data.status) {
                        $.each(data.response.list, function(index, item) {
                            if(item['reference_no'] === param){
                    alert('Reference Number Already exits ');
                    $('[name="reference_no"]').val('').focus();
                  }
                        })
                    }
                }
            }
        })
    }
</script>

<datalist id="quick_list_driver_id"></datalist>
<script type="text/javascript">
  $(document.body).on('input', '[data-driver-id]' ,function()
  {
    id_selected=$(`[data-driver-id-rows="${$(this).val()}"]`).data('value');
    if(id_selected!=undefined)
    {
     $(this).data('driver-id', id_selected)
   }
 });

  $(document.body).on('change', '[data-driver-id]' ,function()
  {
   id_selected=$(`[data-driver-id-rows="${$(this).val()}"]`).data('value');
   if($(this).val()!='')
   {
     if(id_selected==undefined)
     {
      alert("Please enter correct Driver ID")
      id_selected=''
      $(this).val('')
      $(this).focus()
    }
  }
  else
  {
    id_selected=''
  }
  $('[name="driver_id"]').val(id_selected)
});

  quick_list_drivers({status_ids:'ACTIVE'}).then(function(data) {
        // Run this when your request was successful
        if (data.status) {
          //Run this if response has list
          if (data.response.list) {
            var options = "";
            options+=`<option data-driver-id-rows="" data-value="" value="">- - Select - -</option>`
            $.each(data.response.list, function(index, item) {
              options+=`<option data-driver-id-rows="` + item.code + ' ' + item.name + `" data-value="${item.id}" value="`+ item.code + ' ' + item.name + `"></option>`;

            })
            $('#quick_list_driver_id').html(options);
          }
        }
      }).catch(function(err) {
        // Run this when promise was rejected via reject()
      })
    </script>

    <datalist id="quick_list_codriver_id"></datalist>
    <script type="text/javascript">
      $(document.body).on('input', '[data-codriver-id]' ,function()
      {
        id_selected=$(`[data-codriver-id-rows="${$(this).val()}"]`).data('value');
        if(id_selected!=undefined)
        {
         $(this).data('codriver-id', id_selected)
       }
     });

      $(document.body).on('change', '[data-codriver-id]' ,function()
      {
       id_selected=$(`[data-codriver-id-rows="${$(this).val()}"]`).data('value');
       if($(this).val()!='')
       {
         if(id_selected==undefined)
         {
          alert("Please enter correct Co-Driver ID")
          id_selected=''
          $(this).val('')
          $(this).focus()
        }
      }
      else
      {
        id_selected=''
      }
      $('[name="codriver_id"]').val(id_selected)
    });

      quick_list_drivers().then(function(data) {
        // Run this when your request was successful
        if (data.status) {
          //Run this if response has list
          if (data.response.list) {
            var options = "";
            options+=`<option data-codriver-id-rows="" data-value="" value="">- - Select - -</option>`
            $.each(data.response.list, function(index, item) {
              options+=`<option data-codriver-id-rows="` + item.code + ' ' + item.name + `" data-value="${item.id}" value="`+ item.code + ' ' + item.name + `"></option>`;

            })
            $('#quick_list_codriver_id').html(options);
          }
        }
      }).catch(function(err) {
        // Run this when promise was rejected via reject()
      })
    </script>

    <datalist id="quick_list_truck_id"></datalist>
    <script type="text/javascript">
      $(document.body).on('input', '[data-truck-id]' ,function()
      {
       id_selected=$(`[data-truck-id-rows="${$(this).val()}"]`).data('value');
       if(id_selected!=undefined)
       {
         $(this).data('truck-id', id_selected)
       }
     });

      $(document.body).on('change', '[data-truck-id]' ,function()
      {
       id_selected=$(`[data-truck-id-rows="${$(this).val()}"]`).data('value');
       if($(this).val()!='')
       {
         if(id_selected==undefined)
         {
          alert("Please enter correct Truck ID")
          id_selected=''
          $(this).val('');
          $(this).focus();
        }
      }
      else
      {
        id_selected=''
        id_selected=''
        $(this).val('');
        $(this).focus();
      }
      $('[name="truck_id"]').val(id_selected)
    });
      
      quick_list_trucks().then(function(data) {
        // Run this when your request was successful
        if (data.status) {
          //Run this if response has list
          if (data.response.list) {
            var options = "";
            options+=`<option data-truck-id-rows="" data-value="" value="">- - Select - -</option>`
            $.each(data.response.list, function(index, item) {
              options+=`<option data-truck-id-rows="`+item.code+`" data-value="${item.id}" value="`+item.code+`"></option>`;
            })
            $('#quick_list_truck_id').html(options);
          }
        }
      }).catch(function(err) {
        // Run this when promise was rejected via reject()
      })
    </script>

    <datalist id="quick_list_trailer_id"></datalist>
    <script type="text/javascript">
      $(document.body).on('input', '[data-trailer-id]' ,function()
      {
       id_selected=$(`[data-trailer-id-rows="${$(this).val()}"]`).data('value');
       if(id_selected!=undefined)
       {
         $(this).data('trailer-id', id_selected)
       }
     });

      $(document.body).on('change', '[data-trailer-id]' ,function()
      {
       id_selected=$(`[data-trailer-id-rows="${$(this).val()}"]`).data('value');
       if($(this).val()!='')
       {
         if(id_selected==undefined)
         {
          alert("Please enter correct Trailer ID")
          id_selected=''
          $(this).val('')
          $(this).focus()
        }
      }
      else
      {
        id_selected=''
      }
      $('[name="trailer_id"]').val(id_selected)
    });

      quick_list_trailers().then(function(data) {
        // Run this when your request was successful
        if (data.status) {
          //Run this if response has list
          if (data.response.list) {
            var options = "";
            options+=`<option data-trailer-id-rows="" data-value="" value="">- - Select - -</option>`
            $.each(data.response.list, function(index, item) {
              options+=`<option data-trailer-id-rows="` + item.code + `" data-value="${item.id}" value="` + item.code + `"></option>`;
            })
            $('#quick_list_trailer_id').html(options);
          }
        }
      }).catch(function(err) {
        // Run this when promise was rejected via reject()
      })
    </script>

    <datalist id="quick_list_user_id"></datalist>
    <script type="text/javascript">
      $(document.body).on('input', '[data-user-id]' ,function()
      {
       id_selected=$(`[data-user-id-rows="${$(this).val()}"]`).data('value');
       if(id_selected!=undefined)
       {
         $(this).data('user-id', id_selected)
       }
     });

      $(document.body).on('change', '[data-user-id]' ,function()
      {
       id_selected=$(`[data-user-id-rows="${$(this).val()}"]`).data('value');
       if($(this).val()!='')
       {
         if(id_selected==undefined)
         {
          alert("Please enter correct warning given by ID")
          id_selected=''
          $(this).val('')
          $(this).focus()
        }
      }
      else
      {
        id_selected=''
      }
      $('[name="user_id"]').val(id_selected)
    });

      quick_list_users().then(function(data) {
        // Run this when your request was successful
        if (data.status) {
          //Run this if response has list
          if (data.response.list) {
            var options = "";
            options+=`<option data-user-id-rows="" data-value="" value="">- - Select - -</option>`
            $.each(data.response.list, function(index, item) {
              options+=`<option data-user-id-rows="` + item.user_display_name + `" data-value="${item.id}" value="` + item.user_display_name + `"></option>`;
            })
            $('#quick_list_user_id').html(options);
          }
        }
      }).catch(function(err) {
        // Run this when promise was rejected via reject()
      })
    </script>


    <script type='text/javascript'>
      function back_alert() {
        if (confirm('Are you Sure to go back?')) {
          window.history.back();
        }
      }
    </script>

    <script type="text/javascript">
      var return_to = 0
      function set_pref(val) {
        return_to = val;
        $('[data-submit]').trigger('click');
      }
    </script>

    <script type="text/javascript">
      function show_companies() {
        get_companies().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[name="company_id"]').html(options);                 
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_companies()
</script>

<script type="text/javascript">
  function load_violation_reported() {
    get_violation_reported_list().then(function(data) {
      // Run this when your request was successful
      if (data.status) {
        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            //console.log(item)
            options += `<option value="` + item.id + `">` + item.name + `</option>`;
          })
          $('[data-filter="violation_reported_id"]').html(options);
          select_default('[data-filter="violation_reported_id"]')
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }
  load_violation_reported()
</script>

<script type="text/javascript">
  function show_states(){
   get_states().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[name="state_id"]').html(options);                 
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_states()
</script>

<script type="text/javascript">
  function show_cities(param){
    if (param.state_id === '') {
      $('[name="city_id"]').html('');
      $('[name="city_id"]').prop('disabled',true);
    } else if (param.state_id !== '') {
      $('[name="city_id"]').prop('disabled',false);
      get_cities(param).then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;
      })
      $('[name="city_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
}
</script>

<script type="text/javascript">
  var counter_drivers = 0
  var $asset_drivers = $('#asset_drivers');
  function add_row_drivers(param) {
    ++counter_drivers;
    var $add_row_drivers=`<tr id="issue_row1${counter_drivers}"  data-drivers-row>
    <td class="counterdrivers">${counter_drivers}</td>
    <td><select name="asset_type_id" required hidden></select></td>
    <td><select name="asset_reason_id" required></select></td>
    <td><input name="asset_remarks" type="text" required></td>
    <td><select name="asset_corrective_id" required></select></td>
    <td><button type="button" class="btn_red_c" data-remove-drivers-button=""><i class="fa fa-trash"></i></button></td>
    </tr>`;

    $('#asset_drivers').append($add_row_drivers);
    show_assets_type_drivers('issue_row1'+counter_drivers)
    show_reasons_list_drivers('issue_row1'+counter_drivers)
    show_corrective_list_drivers('issue_row1'+counter_drivers)
  }
  $(document.body).on('click', '[data-remove-drivers-button=""]' ,function(){
    $(this).parent().parent().remove();
  // for re-calculating total amount code by swaran
  var a = 0;
  var b =0;
  $('[data-row-amount]').each(function(index,item){
    b = $(this).val();
    a = eval(a) + eval(b);
  })
  $('[data-total-amount]').val(a)
    // for re-calculating total amount code by swaran ENDS HERE
    // for re-setting dynamic-counter code by swaran
    counter_drivers = 0;
    $('.counterdrivers').each(function(index,item){
      counter_drivers= counter_drivers+1;
      $(this).html(counter_drivers)
    })
  });
    //-----------/remove stop
  </script>

  <script type="text/javascript">
    var counter_trucks = 0
    var $asset_trucks = $('#asset_trucks');
    function add_row_trucks(param) {
      ++counter_trucks;
      var $add_row_trucks=`<tr id="issue_row2${counter_trucks}" data-trucks-row>
      <td class="countertrucks">${counter_trucks}</td>
      <td><select name="asset_type_id_trucks" required hidden></select></td>
      <td><select name="asset_reason_id_trucks" required></select></td>
      <td><input name="asset_remarks_trucks" type="text" required></td>
      <td><select name="asset_corrective_id_trucks" required></select></td>
      <td><button type="button" class="btn_red_c" data-remove-trucks-button=""><i class="fa fa-trash"></i></button></td>
      </tr>`;

      $('#asset_trucks').append($add_row_trucks);
      show_assets_type_trucks('issue_row2'+counter_trucks)
      show_reasons_list_trucks('issue_row2'+counter_trucks)
      show_corrective_list_trucks('issue_row2'+counter_trucks)
    }
    $(document.body).on('click', '[data-remove-trucks-button=""]' ,function(){
      $(this).parent().parent().remove();
  // for re-calculating total amount code by swaran
  var a = 0;
  var b =0;
  $('[data-row-amount]').each(function(index,item){
    b = $(this).val();
    a = eval(a) + eval(b);
  })
  $('[data-total-amount]').val(a)
    // for re-calculating total amount code by swaran ENDS HERE
    // for re-setting dynamic-counter code by swaran
    counter_trucks = 0;
    $('.countertrucks').each(function(index,item){
      counter_trucks= counter_trucks+1;
      $(this).html(counter_trucks)
    })
  });
    //-----------/remove stop
  </script>

  <script type="text/javascript">
    var counter_trailers = 0
    var $asset_trailers = $('#asset_trailers');
    function add_row_trailers(param) {
      ++counter_trailers;
      var $add_row_trailers=`<tr id="issue_row3${counter_trailers}" data-trailers-row>
      <td class="countertrailers">${counter_trailers}</td>
      <td><select name="asset_type_id_trailers" required hidden></select></td>
      <td><select name="asset_reason_id_trailers" required></select></td>
      <td><input name="asset_remarks_trailers" type="text" required></td>
      <td><select name="asset_corrective_id_trailers" required></select></td>
      <td><button type="button" class="btn_red_c" data-remove-trailers-button=""><i class="fa fa-trash"></i></button></td>
      </tr>`;

      $('#asset_trailers').append($add_row_trailers);
      show_assets_type_trailers('issue_row3'+counter_trailers)
      show_reasons_list_trailers('issue_row3'+counter_trailers)
      show_corrective_list_trailers('issue_row3'+counter_trailers)
    }
    $(document.body).on('click', '[data-remove-trailers-button=""]' ,function(){
      $(this).parent().parent().remove();
  // for re-calculating total amount code by swaran
  var a = 0;
  var b =0;
  $('[data-row-amount]').each(function(index,item){
    b = $(this).val();
    a = eval(a) + eval(b);
  })
  $('[data-total-amount]').val(a)
    // for re-calculating total amount code by swaran ENDS HERE
    // for re-setting dynamic-counter code by swaran
    counter_trailers = 0;
    $('.countertrailers').each(function(index,item){
      counter_trailers= counter_trailers+1;
      $(this).html(counter_trailers)
    })
  });

    //-----------/remove stop
  </script>

  <script type="text/javascript">
    function show_assets_type_drivers(row_id){
     get_assets_type().then(function(data) {
   // Run this when your request was successful
   if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      // options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        if(item.status == "ACT" || item.status == "ACTIVE") {
          options+=`<option value="`+item.id+`">`+item.name+`</option>`;    
        }
      })
      $('tr#'+row_id+' [name="asset_type_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_assets_type_drivers('issue_row1')
</script>

<script type="text/javascript">
  function show_assets_type_trucks(row_id){
   get_assets_type_trucks().then(function(data) {
   // Run this when your request was successful
   if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      // options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        if(item.status == "ACT" || item.status == "ACTIVE") {
          options+=`<option value="`+item.id+`">`+item.name+`</option>`;    
        }           
      })
      $('tr#'+row_id+' [name="asset_type_id_trucks"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_assets_type_trucks('issue_row2')
</script>

<script type="text/javascript">
  function show_assets_type_trailers(row_id){
   get_assets_type_trailers().then(function(data) {
   // Run this when your request was successful
   if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      // options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        if(item.status == "ACT" || item.status == "ACTIVE") {
          options+=`<option value="`+item.id+`">`+item.name+`</option>`;    
        }           
      })
      $('tr#'+row_id+' [name="asset_type_id_trailers"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_assets_type_trailers('issue_row3')
</script>

<script type="text/javascript">
  function show_reasons_list_drivers(row_id){
    get_reasons_list().then(function(data) {
    // Run this when your request was successful
    if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        if(item.status == "ACT" || item.status == "ACTIVE") {
          options+=`<option value="`+item.id+`">`+item.name+`</option>`;     
        }          
      })
      $('tr#'+row_id+' [name="asset_reason_id"]').html(options);    
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_reasons_list_drivers('issue_row1')
</script>

<script type="text/javascript">
  function show_reasons_list_trucks(row_id){
    get_reasons_list_trucks().then(function(data) {
    // Run this when your request was successful
    if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        if(item.status == "ACT" || item.status == "ACTIVE") {
          options+=`<option value="`+item.id+`">`+item.name+`</option>`;     
        }          
      })
      $('tr#'+row_id+' [name="asset_reason_id_trucks"]').html(options);    
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_reasons_list_trucks('issue_row2')
</script>

<script type="text/javascript">
  function show_reasons_list_trailers(row_id){
    get_reasons_list_trailers().then(function(data) {
    // Run this when your request was successful
    if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        if(item.status == "ACT" || item.status == "ACTIVE") {
          options+=`<option value="`+item.id+`">`+item.name+`</option>`;     
        }          
      })
      $('tr#'+row_id+' [name="asset_reason_id_trailers"]').html(options);    
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_reasons_list_trailers('issue_row3')
</script>

<script type="text/javascript">
  function show_corrective_list_drivers(row_id){
    get_corrective_list().then(function(data) {
    // Run this when your request was successful
    if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        if(item.status == "ACT" || item.status == "ACTIVE" ) {
          options+=`<option value="`+item.id+`">`+item.name+`</option>`;     
        }          
      })
      $('tr#'+row_id+' [name="asset_corrective_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_corrective_list_drivers('issue_row1')
</script>

<script type="text/javascript">
  function show_corrective_list_trucks(row_id){
    get_corrective_list_trucks().then(function(data) {
    // Run this when your request was successful
    if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        if(item.status == "ACT" || item.status == "ACTIVE") {
          options+=`<option value="`+item.id+`">`+item.name+`</option>`;     
        }          
      })
      $('tr#'+row_id+' [name="asset_corrective_id_trucks"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_corrective_list_trucks('issue_row2')
</script>

<script type="text/javascript">
  function show_corrective_list_trailers(row_id){
    get_corrective_list_trailers().then(function(data) {
    // Run this when your request was successful
    if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        if(item.status == "ACT" || item.status == "ACTIVE") {
          options+=`<option value="`+item.id+`">`+item.name+`</option>`;     
        }          
      })
      $('tr#'+row_id+' [name="asset_corrective_id_trailers"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_corrective_list_trailers('issue_row3')
</script>

<script type="text/javascript">
  function save() {
    show_processing_modal()
    submit_to_wait_btn('#submit', 'loading')
    $('#formErro').show()
    var form = document.getElementById('MyForm');
    var isValidForm = form.checkValidity();
    var currentForm = $('#MyForm')[0];
    var formData = new FormData(currentForm);
    if (isValidForm) {
      var arr = $('#MyForm').serializeArray();

      var $data_drivers_rows = $("[data-drivers-row]");
      data_drivers_array = []
      $data_drivers_rows.each(function(index)
      {
        var $data_drivers_row = $(this);
        var drivers_row =
        {
          asset_type_id: $data_drivers_row.find('[name="asset_type_id"]').val(),
          asset_reason_id: $data_drivers_row.find('[name="asset_reason_id"]').val(),
          asset_remarks: $data_drivers_row.find('[name="asset_remarks"]').val(),
          asset_corrective_id: $data_drivers_row.find('[name="asset_corrective_id"]').val(),
          asset_reference_document_id: $data_drivers_row.find('[name="asset_reference_document_id"]').val()
        }
        data_drivers_array.push(drivers_row)
      })

      var $data_trucks_rows = $("[data-trucks-row]");
      data_trucks_array = []
      $data_trucks_rows.each(function(index)
      {
        var $data_trucks_row = $(this);
        var trucks_row =
        {
          asset_type_id: $data_trucks_row.find('[name="asset_type_id_trucks"]').val(),
          asset_reason_id: $data_trucks_row.find('[name="asset_reason_id_trucks"]').val(),
          asset_remarks: $data_trucks_row.find('[name="asset_remarks_trucks"]').val(),
          asset_corrective_id: $data_trucks_row.find('[name="asset_corrective_id_trucks"]').val(),
          asset_reference_document_id: $data_trucks_row.find('[name="asset_reference_document_id_trucks"]').val()
        }
        data_trucks_array.push(trucks_row)
      })

      var $data_trailers_rows = $("[data-trailers-row]");
      data_trailers_array = []
      $data_trailers_rows.each(function(index)
      {
        var $data_trailers_row = $(this);
        var trailers_row =
        {
          asset_type_id: $data_trailers_row.find('[name="asset_type_id_trailers"]').val(),
          asset_reason_id: $data_trailers_row.find('[name="asset_reason_id_trailers"]').val(),
          asset_remarks: $data_trailers_row.find('[name="asset_remarks_trailers"]').val(),
          asset_corrective_id: $data_trailers_row.find('[name="asset_corrective_id_trailers"]').val(),
          asset_reference_document_id: $data_trailers_row.find('[name="asset_reference_document_id_trailers"]').val()
        }
        data_trailers_array.push(trailers_row)
      })

      var obj = {
        status_id: 'OPEN',
        ins_date: $('[name="inspection_date"]').val(),
        from_time: $('[name="from_time"]').val(),
        to_time: $('[name="to_time"]').val(),
        reference_no: $('[name="reference_no"]').val(),
        driver_id: $('[name="driver_id"]').val(),
        codriver_id: $('[name="codriver_id"]').val(),
        truck_id: $('[name="truck_id"]').val(),
        trailer_id: $('[name="trailer_id"]').val(),
        company_id: $('[name="company_id"]').val(),
        location: $('[name="location"]').val(),
        state_id: $('[name="state_id"]').val(),
        city_id: $('[name="city_id"]').val(),
        violation_reported_id: $('[name="violation_reported_id"]').val(),
        fine_amount: $('[name="fined_amount"]').val(),
        bond_amount: $('[name="bond_amount"]').val(),
        remarks: $('[name="remarks"]').val(),
        level_id: $('[name="level_id"]').val(),

        book_transfer_id: $('[name="book_transfer_id"]').val(),
        book_tag_id: $('[name="book_tag_id"]').val(),
        driver_statement: $('[name="driver_statement"]').val(),

        verbal_warning_given_by_id: $('[name="user_id"]').val(),
        verbal_warning_given_date: $('[name="verbal_warning_given_date"]').val(),
        verbal_warning_given_time: $('[name="verbal_warning_given_time"]').val(),

        stops:data_drivers_array,
        trucks:data_trucks_array,
        trailers:data_trailers_array,
      }

      $.ajax({
        url: window.location.pathname + '-action',
        type: 'POST',
        data: obj,
        success: function(data) {
          console.log(data);
          if ((typeof data) == 'string') {
            data = JSON.parse(data)
          }
          alert(data.message);
          if (data.status) {
            if (return_to == 0) {
              window.history.back();
            } else if (return_to == 1) {
              location.href = '../user/maintenance/inspection-sheet/documents?eid=' + data.response.new_eid;
            }
            wait_to_submit_btn('#submit', 'ADD')
          } else {
            wait_to_submit_btn('#submit', 'ADD')
          }
          hide_processing_modal();
        }
      })
    }
    return false
  }
</script>

<script type="text/javascript">
  $(document.body).on('change', '.zero' ,function(){
    if($(this).val().trim().length === 0){
      $(this).val(0);
    }
  })
</script>

<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>