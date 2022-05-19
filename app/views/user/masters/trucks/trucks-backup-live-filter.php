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
                        <th onclick="sortBy('code')">Code</th>
                        <th onclick="sortBy('maker')">Maker</th>
                        <th onclick="sortBy('model')">Model</th>
                        <th></th>
                    </tr>                       
                    </thead>
                    <tbody id="tabledata"></tbody>
                </table>
            </div>
        </section>



<script type="text/javascript">
mainArray='';
var allParam={'name':'amrisign'}

function get_trucks(param){
    var param=Object.assign(allParam,param)
        $.ajax(location.pathname+'-ajax',{
        type:'POST',
        data:param,
        async: false,
        success:function(data){
               if((typeof data)=='string'){
               data=JSON.parse(data)
               if(data.status){
               mainArray=data.response 
               }
               
               }
               
        }
    })
}
get_trucks({'order_by':'truck_code'})

function showlist(value){
$('#tabledata').html("");
var counter=0;
$.each(mainArray.list, function(index, item) {
    if(item.code.toLowerCase().includes(value)|| item.model.toLowerCase().includes(value)){
counter++;
    var row=``;
    row+=`<tr>`;
    row+=`<td>`+counter+`</td>`;
    row+=`<td>`+item.code+`</td>`;
    row+=`<td>`+item.maker+`</td>`;
    row+=`<td>`+item.model+`</td>`;
    row+=`</tr>`;
    $('#tabledata').append(row);
       
}
})


}
 mylist=mainArray.list;

 function sortBy(item,method){
    alert(item)
    if(method=='A'){
    switch (item){
        case 'code':
        mylist.sort((a, b) => a.code - b.code);
        break;

        case 'maker':
        mylist.sort((a, b) => a.maker - b.maker);
        break;

        case 'model':
        mylist.sort((a, b) => a.model - b.model);
        break;

        default:
        mylist.sort((a, b) => a.code - b.code);
        break;
    }
    }else{
            switch (item){
        case 'code':
        mylist.sort((a, b) => b.code - a.code);
        break;

        case 'maker':
        mylist.sort((a, b) => b.maker - a.maker);
        break;

        case 'model':
        mylist.sort((a, b) => b.model - a.model);
        break;

        default:
        mylist.sort((a, b) => b.code - a.code);
        break;
    }
    }
    showlist('')
 }
sortBy('model','')
console.log(mainArray)
showlist('')
</script>





<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>