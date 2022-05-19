<?php
require_once APPROOT.'/views/includes/user/header.php';
?>

            <section class="list-200 content-box" style="margin: auto;max-width: 700px">
            <h1 class="list-200-heading">Assign user</h1>

            <div class="table  table-a">
                <table>
                    <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th><input type="checkbox" id="select_all"></th>
                        <th style="text-align:left">Code</th>
                        <th style="text-align:left">Name</th>
                    </tr>                       
                    </thead>
                    <tbody id="tabledata"></tbody>
                    <tfoot><tr><td colspan="5" style="padding: 10px;text-align: center;"><button class="btn_green" data-assign-users>SAVE</button></td></tr></tfoot>
                </table>
            </div>
        </section>


<script type="text/javascript">
function show_list(){ 
 quick_list_users({sort_by:'name',status_ids:['ACTIVE'].toString()}).then(function(data) {
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
$('#tabledata').html("");
var counter=0;

///-------sort array by name

//--------toLowerCase() is used to do case insentive sorting
var mylist=data.response.list
mylist.sort((a,b) => (a.code.toLowerCase() > b.code.toLowerCase()) ? 1 : ((b.code.toLowerCase() > a.code.toLowerCase()) ? -1 : 0))
////-------/ sort array by name

$.each(data.response.list, function(index, item) {
	counter++
	var row=`<tr>`;
	row+=`<td>${counter}</td>
	<td><p><input type="checkbox" data-eid='${item.eid}' data-user/></td>
	<td style="text-align:left">${item.code}</td>
	<td style="text-align:left">${item.name}</td>
	</tr>`
    $('#tabledata').append(row);
})

var assigned_user_array=JSON.parse('<?php echo json_encode($data['assigned-users-array']); ?>')
$('[data-eid]').each(function () {
  if(assigned_user_array.includes($(this).data("eid"))){
    $(this).attr("checked",true)
  }
});   
    }
  }
}).catch(function(err) {
  // Run this when promise was rejected via reject()
}) 
}
show_list()
</script>

<script type="text/javascript">

$(document).ready(function(){
 $(document).on("click", "[data-assign-users]",function(){
 
 var group_eid='<?php echo $_GET['eid']; ?>'
var usersArray=[];
$('[data-user]:checked').each(function () { 
  var status = (this.checked ? $(this).val() : ""); 
  usersArray.push($(this).data("eid"));
});
    $.ajax({
      url:window.location.pathname+'-action',
      type:'POST',
       data:{
        users_eid_list:usersArray,
        level_eid:'<?php echo $_GET['eid']; ?>'
       },
       context: this,
        success:function(data){
            // alert(data)
               if((typeof data)=='string'){
               data=JSON.parse(data) 
               }
               
               if(data.status){
                    alert(data.message)
               }else{
                alert(data.message)
               }
      }
    })
    
  });
});


$("#select_all").click(function(){
        $("[data-eid]").prop('checked', $(this).prop('checked'));

});


</script>



<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>