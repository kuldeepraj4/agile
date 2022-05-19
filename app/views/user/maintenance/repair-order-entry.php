<?php
require_once APPROOT.'/views/includes/user/header.php';
?>

<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1400px">
  <h1 class="list-200-heading">Repair Order List</h1>
  <section class="list-200-top-section">
    <div>
    </div>
    <div>
    </div>
  </section>

  <section class="list-200-top-action">
    <div class="list-200-top-action-left">

      <!-- input used for sory by call-->
      <input type="hidden" id="sort_by" value="">
      <!-- //input used for sort by call-->

      <div class="filter-item">
        <label>Class</label>
        <select data-filter="class_id" onchange="show_list(this.value)">
        </select>
      </div>
      <div class="filter-item">
        <label>Order ID</label>
        <input type="text" data-filter="order_id" onkeyup="show_list(this.value)">
      </div> 

      <div class="filter-item">
        <label>Unit Type</label>
        <select data-filter="unit_type_id" onchange="show_list(this.value), show_unit_filter({unit_type_id:this.value})"></select>
      </select>
    </div>

    <div class="filter-item">
      <label>Status</label>
      <select data-filter="status_id" onchange="show_list(this.value)">
      </select>
    </div>
    <div class="filter-item">
      <label>Unit ID</label>
      <select data-filter="unit_id" onchange="show_list(this.value)">
      </select>
    </div>

    <div class="filter-item">
      <label>Type</label>
      <select data-filter="type_id" onchange="show_list(this.value)">
      </select>
    </div>

    <div class="filter-item">
      <label>Driver</label>
      <select data-filter="driver_id" onchange="show_list()">
      </select>
    </div>

    <div class="filter-item">
      <label>Stage</label>
      <select data-filter="stage_id" onchange="show_list()">
      </select>
    </div> 

    <div class="filter-item">
    </div>
  </div>
  <div class="list-200-top-action-right">
    <div>
      <?php
      if(in_array('P0226', USER_PRIV)){
        echo "<button class='btn_grey button_href'><a href='../user/maintenance/repair-orders/add-new'>Add New</a></button>";
      }
      ?>
    </div>
  </div>

</section>
<div class="table  table-a">
  <table>
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Order ID</th>
        <th>Date Created</th>
        <th>Status</th>
        <th>Class</th>
        <th>Type</th>
        <th>Driver ID</th>
        <th>Driver Name</th>
        <th>Stage</th>
        <th>Unit Type</th>
        <th>Unit ID</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th></th>
      </tr>                       
    </thead>
    <tbody id="tabledata"></tbody>
  </table>
</div>
</section>

<script type="text/javascript">
  function show_list(){
    var sort_by=$('#sort_by').val();
    var class_id=$('[data-filter="class_id"]').val();
    var order_id=$('[data-filter="order_id"]').val();
    var unit_type_id=$('[data-filter="unit_type_id"]').val();
    var status_id=$('[data-filter="status_id"]').val();
    var unit_id=$('[data-filter="unit_id"]').val();
    var type_id=$('[data-filter="type_id"]').val();
    var driver_id=$('[data-filter="driver_id"]').val();
    var stage_id=$('[data-filter="stage_id"]').val();
    
    $.ajax({
      url:location.pathname+'-ajax',
      type:'POST',
      data:{
        sort_by:sort_by,
        class_id:class_id,
        order_id:order_id,
        unit_type_id:unit_type_id,
        status_id:status_id,
        unit_id:unit_id,
        type_id:type_id,
        driver_id:driver_id,
        stage_id:stage_id,
      },
      success:function(data){
        if((typeof data)=='string'){
         data=JSON.parse(data)
         console.log(data)
         $('#tabledata').html("");
         if(data.status){
           var counter=0;    
           $.each(data.response.list, function(index, item) {
             counter++;
             var row=`<tr>
             <td>${counter}</td>
             <td>${item.id}</td>
             <td>${item.date_created}</td>
             <td>${item.status_name}</td>
             <td>${item.class_name}</td>
             <td>${item.type_name}</td>
             <td>${item.driver_id}</td>
             <td>${item.driver_name}</td>
             <td>${item.stage_name}</td>
             <td>${item.asset_type}</td>
             <td>${item.asset_name}</td>
             <td>${item.start_date}</td>
             <td>${item.end_date}</td>
             
             <td style="white-space:nowrap">`;

             <?php if(in_array('P0010', USER_PRIV))
             {
              ?>
              row+=`<button title="Edit" class="btn_grey_c"><a href="../user/maintenance/repair-order-entry/update?eid=${item.eid}"><i class="fa fa-pen"></i></a></button>`;
              <?php
            }
            if(in_array('P0021', USER_PRIV))
            {
             ?>
             row+=`<button title="Delete" class="btn_grey_c" data-action="delete" data-eid="${item.eid}"><i class="fa fa-trash"></i></button>`;
             <?php
           } ?>
           row+=`</td> 
           </tr>`;
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
  function show_status_filter(){
   get_repair_order_status().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[data-filter="status_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_status_filter()
</script>

<script type="text/javascript">
  function show_class_filter(){
   get_repair_order_class().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[data-filter="class_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_class_filter()
</script>

<script type="text/javascript">
  function show_type_filter(param){
   get_repair_order_type1(param).then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;
      })
      $('[data-filter="type_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_type_filter()
</script>

<script type="text/javascript">
  function show_drivers(){
   get_drivers().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.code+' '+item.name_first+`</option>`;               
      })
      $('[data-filter="driver_id"]').html(options);                 
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_drivers()
</script>

<script type="text/javascript">
  function show_stage_filter(param){
   get_repair_order_stage(param).then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[data-filter="stage_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_stage_filter()
</script>

<script type="text/javascript">
  function show_unittype_filter(){
   get_vehicles().then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.name+`</option>`;               
      })
      $('[data-filter="unit_type_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_unittype_filter()
</script>

<script type="text/javascript">
  function show_unit_filter(param){
    if(param.unit_type_id==1){
      get_trucks().then(function(data){
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.code+`</option>`;               
      })
      $('[data-filter="unit_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
})
}else if(param.unit_type_id==2){
  get_trailers().then(function(data){
  //console.log(data)
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
      var options="";
      options+=`<option value="">- - Select - -</option>`
      $.each(data.response.list, function(index, item) {
        options+=`<option value="`+item.id+`">`+item.code+`</option>`;               
      })
      $('[data-filter="unit_id"]').html(options);     
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
})
} 
}
</script>

<script type="text/javascript">
  function on_change_class(value) {
    show_list();
    //show_type_filter({class:value});
  }
</script>

<script type="text/javascript">
  function sort_table(){
    show_list()
  }
</script>

<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>