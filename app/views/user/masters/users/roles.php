<?php
require_once APPROOT.'/views/includes/user/header.php';
?>
<?php
$roles=$data['all_roles'];
$group_roles=$data['group_roles'];
?>
<div id="mainContentDiv">

    <style type="text/css">
        main{
            background: white;
            padding: 15px;
            width: 100%;
            max-width: 1200px;
            margin:10px auto;
        }
        .listA{
            padding: 10px;
        }
        .listA .listA-item>h1{
            background: #486e94;
            color:white;
            padding: 5px;
            margin-top: 50px;
        }
        .listB{
            margin-top:20px;
        }
        .listB>h1{
            padding:3px 8px;
            background: #f1f1f1;
        }
        .listC-item-box {
            display: flex;
            flex-wrap: wrap;
        }
        .listC-item-box p{
            width: 250px;
            padding: 8px;
        }
    </style>
     
    <main>
    <section class="listA">

        <?php
        foreach ($roles as $rolesA) {
            echo '<div class="listA-item">
            <h1>'.$rolesA['name'].'</h1>';


            foreach ($rolesA['child'] as $rolesB) {
                echo '<div class="listB">
                <h1>'.$rolesB['name'].'</h1>';

                echo '<div class="listC-item-box">';
                foreach ($rolesB['grand_child'] as $rolesC) {

                    echo'<p><input type="checkbox" data-a="'.$rolesA['code'].'" data-b="'.$rolesB['code'].'" data-c="'.$rolesC['code'].'" data-roles /> '.$rolesC['name'].'</p>';

                }
                '</div>';
                echo '</div>';
            }

            echo '</div>';
        }

        ?>
</section>
    <button class="btn_green" data-update-roles>SAVE</button>
</main>
</div>	

<script type="text/javascript">

$(document).ready(function(){
 $(document).on("click", "[data-update-roles]",function(){
 
var rolesArray=[];
$('[data-roles]:checked').each(function () { 
  var status = (this.checked ? $(this).val() : ""); 
  rolesArray.push({data_a:$(this).data("a"),data_b:$(this).data("b"),data_c:$(this).data("c")});
});
    $.ajax({
      url:window.location.pathname+'-update',
      type:'POST',
       data:{
        roles_list:JSON.stringify(rolesArray),
        group_eid:'<?php echo $_GET['eid']; ?>'
       },
       context: this,
        success:function(data){
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

var user_roles=JSON.parse('<?php echo json_encode($group_roles); ?>')
$('[data-c]').each(function () { 
  if(user_roles.includes($(this).data("c"))){
    $(this).attr("checked",true)
  }
});
</script>



<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>