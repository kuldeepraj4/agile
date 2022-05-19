<?php
require_once APPROOT.'/views/includes/user/header-quick-view.php';
?>

    <style type="text/css">
      .notes-area{
        width: 100%;
        max-width:580px;
        margin:auto;
        background: lightblue;
        border:1px solid grey;
        overflow: hidden;
        border-radius: 8px;
      }
      .notes-area h1{
        text-align: center;
        background: #f1f1f1;
      }  
      .notes-area .notes-box{
       height:400px;
       overflow-y: auto;
       padding: 5px
     }
     .notes-area .note{
      background: white;
      padding:6px;
      border-radius:8px;
      margin:5px auto;
      display: flex;
      width: 90%;


    }
    .notes-area .note.user-other{
      float: left;
    }
    .notes-area .note.user-self{
      float: right;
    }
    .notes-area .note.high-priority-true{
      background: var(--theme-color-red-light) !important;
    }
    .notes-area .note>div:nth-child(1){
      width:30px;
      text-align: center;
    }
    .notes-area .note .note-info{
      padding:0 4px;
      color: grey;
      text-align: right;
      font-size: .8em;
      display: flex;
      align-items: center;
      margin-bottom:5px;
    }
    .notes-area .note .note-info>div:nth-child(1){
      width: 70%;
      text-align: left;
      color: var(--theme-color-blue)
    }
    .notes-area .note .note-info>div:nth-child(2){
      width: 25%;
      flex-grow: 1;
      display: flex;
      align-items: center;
      justify-content: flex-end; 
      text-align: right;      
    }    
    .notes-area .note .note-text{
      white-space: pre-line;
      text-align: left;
      min-height: 50px;
    }

   .notes-area .notes-add-new-box{
    display: flex;
    align-items: center;
    padding: 10px;
    padding-top: 15px;
    background: #f2f2f2;
  }
  .notes-area .notes-add-new-box>div:nth-child(2){
    width:80px; 
    padding:8px;
  }
  .notes-area .notes-add-new-box>div:nth-child(1){
    flex-grow: 1;
  }
  .notes-area .notes-add-new-box textarea{
    width: 100%;
    min-height: 100px;
  }
  .notes-area .notes-save-button{
    width: 40px;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    font-size: 25px;
    background: var(--theme-color-green);
  } 
</style>
<script type="text/javascript"></script>



<div data-notes-area="first"></div>
<script type="text/javascript">
  function create_notes_section(param){
    $(`[data-notes-area="${param.notes_area}"]`).html(`<section class="notes-area">
      <h1>Notes</h1>
      <div class="notes-box"></div>
      <div class="notes-add-new-box">
      <div><textarea name="text" placeholder="Type something here. . . . "></textarea></div>
      <div><button  class="notes-save-button" title="Add notes" data-action="add-notes"><i class="fab fa-telegram-plane" style="color:white"></i></button></div>
      </div>
      </section>`);
  }


var last_note_eid=0;
  function show_notes(param1){
   param2={
    reference_eid:'<?php echo $data['eid']?>',
    reference_type_id:'<?php echo $data['reference']?>',
    document_type_eid:'<?php echo $data['document_type_eid']?>',
   }
   let param = Object.assign(param1, param2);
   var notes_area=`[data-notes-area="${param.notes_area}"]`;   
   $.ajax({
    url:"<?php echo AJAXROOT; ?>"+'user/miscellaneous/notes/list-ajax',
    type:'POST',
    data:param,
    beforeSend:function(){
     // $(notes_area+` .notes-box`).html(`<i class="fa fa-spinner fa-span">Loading</i>`);
    },
    success:function(data){
      console.log(data)
      if((typeof data)=='string'){
       data=JSON.parse(data)
       
      // $(notes_area+` .notes-box`).html(``);
       if(data.status){
        last_note_eid=data.response.last_note_eid;
        $.each(data.response.list, function(index, item) {

          var user_type='user-self';
          if(item.user_type=='OTHER'){
            user_type='user-other';
          }

          var high_priority_status='';
          var high_priority_status_checked='';
          if(item.high_priority_status=='ON'){
            high_priority_status='high-priority-true';
            high_priority_status_checked='checked'
          }

          var note=`<div class="note ${user_type} ${high_priority_status}"  data-note-eid="${item.eid}">
          <div style="flex-grow:1">
          <div class="note-info">
          <div><b>${item.added_by_user_code} </b> (${item.added_by_user_name}) <span style="color:grey">${item.added_on_datetime} </span></div>
          <div>`
          if(user_type=='user-self'){
            note+=`<input type="checkbox" data-notes-toggle-high-priority-status ${high_priority_status_checked} title="highpriority status"/> &nbsp<i data-note-delete class="fa fa-trash" style="font-size:.9em;color:var(--theme-color-grey)"></i>`
          }
         note+= `</div>
          </div>
          <div class="note-text">${item.text}</div>
          
          </div></div>`;
          $(notes_area+` .notes-box`).append(note);

        })

        $(notes_area+` .notes-box`).animate({scrollTop: $(notes_area+` .notes-box`)[0].scrollHeight},0);
        $(notes_area+' [name="text"]').val('')
      }
    }

  }

})
 }

 create_notes_section({notes_area:'first'})
show_notes({notes_area:'first',})




</script>
<div id="demo"></div>
<script>
var myVar;    
    function showTime(){
show_notes({notes_area:'first',reference_eid:'<?php echo $data['eid']?>',last_note_eid:last_note_eid})
    }
    function stopFunction(){
        clearInterval(myVar); // stop the timer
    }
    $(document).ready(function(){
        myVar = setInterval("showTime()", 10000);
    });
</script>
<script type="text/javascript">

  $(document).ready(function(){
   $(document).on("click", "[data-action='add-notes']",function(){
    var text =$(this).parent().parent().find('[name="text"]').val()
    if(text.length){
     $.ajax({
      url:"<?php echo AJAXROOT; ?>"+'user/miscellaneous/notes/add-new-action',
      type:'POST',
      data:{
        reference_eid:'<?php echo $data['eid']; ?>',
        reference_type_id:'<?php echo $data['reference']; ?>',
        document_type_eid:'<?php echo $data['document_type_eid']?>',
        text:text
      },
      context: this,
      success:function(data){
        console.log(data)
        if((typeof data)=='string'){
         data=JSON.parse(data) 
       }

       if(data.status){
        show_notes({notes_area:'first',reference_eid:'<?php echo $data['eid']?>',last_note_eid:last_note_eid});
        var text =$(this).parent().parent().find('[name="text"]').val('')
      }else{
        alert(data.message)
      }
    }
  })
   }else{
    alert('Please write some text')
  }


});

 });

</script>


<style type="text/css">
  /*---romove scroll to top button from this screen*/
  .scrollTop{
    display: none;
  }
</style>
<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>