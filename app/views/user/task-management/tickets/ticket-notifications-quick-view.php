<?php
require_once APPROOT.'/views/includes/user/header-quick-view.php';
?>
<style type="text/css">
      .noti-screen{
      z-index: 10;
      top:100%;
      background: #f2f2f2;
      right: 0;
      border-radius: 8px;
      overflow: hidden;
    }

    .noti-screen ul{
      padding:1px 10px;
      color: black;
      background: white;
      max-height:500px;
      overflow: auto;
    }
    .noti-screen ul li{
      padding:12px 4px;
      cursor: pointer;
      border-bottom: 1px solid #f1f1f1
    }
    .noti-screen ul li h4{
      font-weight: normal;
    }
    .noti-screen ul li:last-child{
      border-bottom: none
    }
    .noti-screen ul li:hover{
      background: #f2f2f2
    }
    .noti-screen .noti-head{
     height: 30px;
     display: flex;
     justify-content: space-between;
     align-items: center;
   }
   .noti-screen .noti-head>div:nth-child(1){
    width: 20px;
    margin-left: 5px;
  }
  .noti-screen .noti-head>div:nth-child(2){
    font-weight: bold;
    color: black
  }
  .noti-screen .noti-head>div:nth-child(3){      
    width: 20px;
    margin-right: 5px;
  }
  .noti-screen  .noti-bottom{
    text-align: center;
    color: blue;
    padding: 7px;
  }
</style>

<br><br>
            <section class="list-200 content-box" style="margin: auto;max-width: 600px">
            <h1 class="list-200-heading">Ticket Notifications</h1>
            <div class="noti-screen">
              <ul data-ticket-noti-list-all-list>
              </ul>
            </div>
        </section>






<script type="text/javascript">
    $.ajax({
      url:'../user/task-management/ticket-notifications/user-notifications-ajax',
      type:'POST',
      data:{
                  status:'UNREAD'
      },
      success:function(data){
        console.log(data)
        if((typeof data)=='string'){
         data=JSON.parse(data)
         if(data.status){
          $.each(data.response.list, function(index, item) {

            $('[data-ticket-noti-list-all-list]').append(`
              <li onclick="open_child_window({url:'${item.link}',width:700,height:500})"><h4>${item.heading}</h4></li>
              `)
          }) 

        }

      }
    }

  })
  
</script>



<?php
require_once APPROOT.'/views/includes/user/footer.php';
?>