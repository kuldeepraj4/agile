<?php
require_once APPROOT.'/views/includes/user/header.php';
?>
<br><br>
            <section class="list-200 content-box" style="margin: auto;max-width: 600px">
            <h1 class="list-200-heading">Trucks</h1>
            <section class="list-200-top-action">
            <div>
                <input type="text" placeholder="Search" onkeyup="showlist(this.value)">
                <?php
                    if(in_array('P13', USER_PRIV)){
                        echo "<button class='btn_grey button_href'><a href='../user/masters/locations/cities/add-new'>Add New</a></button>";
                    }
                ?>
                
            </div>                
            </section>
            <div class="table  table-a">
                <table>
                    <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th>City Name</th>
                        <th>State</th>
                        <th>Country</th>
                        <th></th>
                    </tr>                       
                    </thead>
                    <tbody id="tabledata"></tbody>
                </table>
            </div>
        </section>

 <script type="text/javascript">
    var data='<?php echo json_encode($data); ?>';
    data=JSON.parse(data);
    console.log(data);
</script>

<script type="text/javascript">
function showlist(value){
    var value=value.toLowerCase();
$('#tabledata').html("");
var counter=0;
$.each(data.list, function(index, item) {
    if(item.name.toLowerCase().includes(value)|| item.state.toLowerCase().includes(value) || item.country.toLowerCase().includes(value)){
counter++;
    var row=``;
    row+=`<tr>`;
    row+=`<td>`+counter+`</td>`;
    row+=`<td>`+item.name+`</td>`;
    row+=`<td>`+item.state+`</td>`;
    row+=`<td>`+item.country+`</td>`;
    row+=`<td>`;
<?php if(in_array('P15', USER_PRIV)){
    ?>
    row+=`<button title="Edit" onclick="GTU_masters_locations_cities_update('`+item.eid+`')" class="btn_grey_c"><i class="fa fa-pen"></i></button>`;
    row+=`<button title="Delete" class="btn_grey_c" data-action="delete" data-eid="`+item.eid+`"><i class="fa fa-trash"></i></button>`;
    <?php
} ?>

    
    row+=`</td>`; 

    row+=`</tr>`;
    $('#tabledata').append(row);
       
}
})


}
showlist('')

</script>





<script type="text/javascript">

$(document).ready(function(){
 $(document).on("click", "[data-action='delete']",function(){
    if(confirm('Do you want to delete city ?')){
        var eid=$(this).data("eid");
    $.ajax({
      url:window.location.href+'/delete-action',
      type:'POST',
       data:{
        delete_eid:eid
       },
       context: this,
        success:function(data){
               if((typeof data)=='string'){
               data=JSON.parse(data) 
               }
               
               if(data.status){
                    $(this).parent().parent().fadeOut();
               }else{
                alert(data.message)
               }
      }
    })
    }
  });
});

</script>





<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>