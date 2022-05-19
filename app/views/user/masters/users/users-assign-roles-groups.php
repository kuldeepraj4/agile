<?php
require_once APPROOT.'/views/includes/user/header.php';
?>

            <section class="list-200 content-box" style="margin: auto;max-width: 600px">
            <h1 class="list-200-heading">Assign Roles Group</h1>

            <div class="table  table-a">
                <table>
                    <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th><input type="checkbox" id="select_all"></th>
                        <th>Name</th>
                    </tr>                       
                    </thead>
                    <tbody id="tabledata"></tbody>
                    <tfoot><tr><td colspan="5" style="padding: 10px;text-align: center;"><button class="btn_green" data-assign-users>SAVE</button></td></tr></tfoot>
                </table>
            </div>
        </section>


<script type="text/javascript">
function show_list(){ 
 get_roles_groups({sort_by:'name'}).then(function(data) {
  //console.log(data)
  // Run this when your request was successful
  if(data.status){
    //Run this if response has list
    if(data.response.list){
$('#tabledata').html("");
var counter=0;

///-------sort array by name

//--------toLowerCase() is used to do case insentive sorting
var mylist=data.response.list
mylist.sort((a,b) => (a.name.toLowerCase() > b.name.toLowerCase()) ? 1 : ((b.name.toLowerCase() > a.name.toLowerCase()) ? -1 : 0))
////-------/ sort array by name

$.each(data.response.list, function(index, item) {
	counter++
	var row=`<tr>`;
	row+=`<td>${counter}</td>
	<td><p><input type="checkbox" data-eid='${item.eid}' data-user/></td>
	<td>${item.name}</td>
	</tr>`
    $('#tabledata').append(row);
})

var assigned_roles_groups=JSON.parse('<?php echo json_encode($data['assigned-roles-groups']); ?>')
//console.log(assigned_roles_groups)
$('[data-eid]').each(function () {
  if(assigned_roles_groups.includes($(this).data("eid"))){
    $(this).attr("checked",true)
  }
});
    if($('[data-user]:checked').length == $('[data-user]').length != 0)
    {
      $("#select_all").prop('checked', true); 
    }

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
var rolesGroupsArray=[];
$('[data-user]:checked').each(function () { 
  var status = (this.checked ? $(this).val() : ""); 
  rolesGroupsArray.push($(this).data("eid"));
});
    $.ajax({
      url:window.location.pathname+'-action',
      type:'POST',
       data:{
        roles_groups_eid_list:rolesGroupsArray,
        user_eid:'<?php echo $_GET['eid']; ?>'
       },
       context: this,
        success:function(data){
               if((typeof data)=='string'){
               data=JSON.parse(data) 
               }
               
               if(data.status){
                    alert(data.message)
                    location.href='../user/masters/users';
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