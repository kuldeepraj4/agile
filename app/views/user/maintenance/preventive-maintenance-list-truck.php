<?php
require_once APPROOT.'/views/includes/user/header.php';
?>

<br><br>
<section class="list-200 content-box" style="margin: auto;max-width: 1400px">
  <h1 class="list-200-heading">Preventive Maintenance List -Trucks</h1>
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
      <label>Unit ID</label>
      <select data-filter="unit_id" onchange="show_list(this.value)">
      </select>
    </div>
    <div class="filter-item">
    </div>
  </div>
  <div class="list-200-top-action-right">

  </div>

</section>
<div class="table  table-a">
  <table>
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Unit No.</th>
        <th>Job Work</th>
        <th>Mode</th>
        <th>Advance Notice On</th>
        <th>Change Every</th>
        <th>Current Reading</th>
        <th>Last Reading</th>
        <th>Reading Difference</th>
        <th>Over Due</th>
        <th>Status</th>
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
        
    $.ajax({
      url:location.pathname+'-ajax',
      type:'POST',
      data:{
        sort_by:sort_by
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
             <td>${item.name}</td>
             <td>${item.mode}</td>
             <td>${item.advancenotice}</td>
             <td>${item.value}</td>
             <td>${item.currentreading}</td>
             <td>${item.lastreading}</td>
             <td>${item.difference}</td>
             <td>${item.overdue}</td>
             <td>${item.pmstatus}</td>

             <td style="white-space:nowrap">`;
             
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
  function show_unit_filter(param){
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
}
show_unit_filter()
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
