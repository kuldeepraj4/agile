<?php
require_once APPROOT.'/views/includes/user/header.php';
?>

<style type="text/css">
.i-boxes{
  max-width: 1200px;
  margin:auto;
  background: white;
  padding: 15px;
  border-radius: 10px;
}
.i-boxes .i-boxes-head{
  display: flex;
  align-items: center;
}
.i-boxes .i-boxes-head>h1{
 color:var(--theme-color-grey);
 padding: 8px;   
}
.i-boxes .i-boxes-head>button{
  margin:5px;
}

.i-boxes-cover{
  display: flex;
  flex-wrap: wrap;
  width: 100%;
  justify-content: flex-start;
  margin:auto;
  padding:1px;
  background: #f2f2f2

}
.i-box{
  background:white;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
  margin:1px;
}

.i-box>a{
  background: white;
  height: 66%;
  flex-grow: 1;
  padding: 5px;
  border-bottom:1px solid #f2f2f2;
  display: flex;
  flex-direction: column;

}
.i-box>a>h2{
  font-size: 1.1em;
  font-weight: 500;
}
.i-box>a>h1{
  font-size:2em;
  font-weight: 600;
  display: flex;
  justify-content: flex-end;
  align-items: flex-end;
  flex-grow: 1;
  padding: 5px;

}
.i-box>div:nth-child(2){
  flex-grow: 1;
  padding: 5px;
  display: flex;
  height: 30%;
  flex-grow: 1;
  justify-content: space-between;
}
.span-loading{

}

</style>
<br><br><br>
<section class="i-boxes shadow-1">
  <div class="i-boxes-head">
    <h1>Tickets By Me</h1>
    <div><button class="btn_green"><a href="../user/task-management/tickets/create-new"><i class="fa fa-plus"></i></a></button></div>
  </div>
  
  <section class="i-boxes-cover">
    <div class="i-box" data-my-box style="width:200px;height: 100px">
      <a href="../user/task-management/tickets/tickets-by-user?stage=OPEN">
        <h2>Open</h3>
          <h1 data-tickets-by-me-open><i class="fa fa-spinner fa-spin"></i></h1>
        </a>
      </div>  
      <div class="i-box" data-my-box style="width:200px;height: 100px">
        <a href="../user/task-management/tickets/tickets-by-user?stage=AWAITING">
          <h2>Awaiting</h3>
            <h1 data-tickets-by-me-awaiting><i class="fa fa-spinner fa-spin"></i></h1>
          </a>
        </div>
        <div class="i-box" data-my-box style="width:200px;height: 100px">
          <a href="../user/task-management/tickets/tickets-by-user?stage=WORKING">
            <h2>Working</h2>
            <h1 data-tickets-by-me-working><i class="fa fa-spinner fa-spin"></i></h1>
          </a>
        </div>
        <div class="i-box" data-my-box style="width:200px;height: 100px">
          <a href="../user/task-management/tickets/tickets-by-user?stage=RESOLVED">
            <h2>Resolved</h2>
            <h1 data-tickets-by-me-resolved><i class="fa fa-spinner fa-spin"></i></h1>
          </a>
        </div>
        <div class="i-box" data-my-box style="width:200px;height: 100px">
          <a href="../user/task-management/tickets/tickets-by-user?stage=CLOSED">
            <h2>Closed</h2>
            <h1 data-tickets-by-me-closed><i class="fa fa-spinner fa-spin"></i></h1>
          </a>
        </div>
      </section>    
    </section>

    <script type="text/javascript">
      function show_tickets_by_me(){
        var total_open=0; 
        var total_awaiting=0; 
        var total_working=0;
        var total_resolved=0; 
        var total_closed=0; 
        $.ajax({
          url:"<?php echo AJAXROOT; ?>"+'user/task-management/tickets/tickets-by-user-ajax',
          type:'POST',
          data:{},
          beforeSend:function(){
            $('#tabledata').html('loading data');
          },
          success:function(data){
            console.log(data)
           if((typeof data)=='string'){
             data=JSON.parse(data)
             $('#tabledata').html("");
             if(data.status){
              $.each(data.response.list, function(index, item) {

                switch(item.stage) {
                  case 'OPEN':
                  total_open++
                  break;
                  case 'AWAITING':
                  total_awaiting++
                  break;
                  case 'WORKING':
                  total_working++
                  break;
                  case 'RESOLVED':
                  total_resolved++
                  break;
                  case 'CLOSED':
                  total_closed++
                  break;                                                      
                  default:
                  // code block
                }


              })

              $('[data-tickets-by-me-open]').html(total_open)
              $('[data-tickets-by-me-awaiting]').html(total_awaiting)
              $('[data-tickets-by-me-working]').html(total_working)
              $('[data-tickets-by-me-resolved]').html(total_resolved)
              $('[data-tickets-by-me-closed]').html(total_closed)

            }else{
                  $('[data-tickets-by-me-open]').html(0)
                  $('[data-tickets-by-me-awaiting]').html(0)
                  $('[data-tickets-by-me-working]').html(0)
                  $('[data-tickets-by-me-resolved]').html(0)
                  $('[data-tickets-by-me-closed]').html(0)
                }
          }

        }

      })

      }
      show_tickets_by_me()

    </script>


    <br><br><br>
    <section class="i-boxes shadow-1">
      <div class="i-boxes-head">
        <h1>Tickets For Me</h1>
      </div>

      <section class="i-boxes-cover">
        <div class="i-box" data-my-box style="width:200px;height: 100px">
          <a href="../user/task-management/tickets/tickets-for-user?stage=OPEN">
            <h2>Open</h3>
              <h1 data-tickets-for-me-open><i class="fa fa-spinner fa-spin"></i></h1>
            </a>
          </div>  
          <div class="i-box" data-my-box style="width:200px;height: 100px">
            <a href="../user/task-management/tickets/tickets-for-user?stage=AWAITING">
              <h2>Awaiting</h3>
                <h1 data-tickets-for-me-awaiting><i class="fa fa-spinner fa-spin"></i></h1>
              </a>
            </div>
            <div class="i-box" data-my-box style="width:200px;height: 100px">
              <a href="../user/task-management/tickets/tickets-for-user?stage=WORKING">
                <h2>Working</h2>
                <h1 data-tickets-for-me-working><i class="fa fa-spinner fa-spin"></i></h1>
              </a>
            </div>
            <div class="i-box" data-my-box style="width:200px;height: 100px">
              <a href="../user/task-management/tickets/tickets-for-user?stage=RESOLVED">
                <h2>Resolved</h2>
                <h1 data-tickets-for-me-resolved><i class="fa fa-spinner fa-spin"></i></h1>
              </a>
            </div>
            <div class="i-box" data-my-box style="width:200px;height: 100px">
              <a href="../user/task-management/tickets/tickets-for-user?stage=CLOSED">
                <h2>Closed</h2>
                <h1 data-tickets-for-me-closed><i class="fa fa-spinner fa-spin"></i></h1>
              </a>
            </div>
          </section>    
        </section>

        <script type="text/javascript">
          function show_tickets_for_me(){
            var total_open=0; 
            var total_awaiting=0; 
            var total_working=0;
            var total_resolved=0; 
            var total_closed=0; 
            $.ajax({
              url:"<?php echo AJAXROOT; ?>"+'user/task-management/tickets/tickets-for-user-ajax',
              type:'POST',
              data:{},
              beforeSend:function(){
                $('#tabledata').html('loading data');
              },
              success:function(data){
                 console.log(data)
               if((typeof data)=='string'){
                 data=JSON.parse(data)
                 $('#tabledata').html("");
                 if(data.status){
                  $.each(data.response.list, function(index, item) {

                    switch(item.stage) {
                      case 'OPEN':
                      total_open++
                      break;
                      case 'AWAITING':
                      total_awaiting++
                      break;
                      case 'WORKING':
                      total_working++
                      break;
                      case 'RESOLVED':
                      total_resolved++
                      break;
                      case 'CLOSED':
                      total_closed++
                      break;                                                      
                      default:
                  // code block
                }


              })

                  $('[data-tickets-for-me-open]').html(total_open)
                  $('[data-tickets-for-me-awaiting]').html(total_awaiting)
                  $('[data-tickets-for-me-working]').html(total_working)
                  $('[data-tickets-for-me-resolved]').html(total_resolved)
                  $('[data-tickets-for-me-closed]').html(total_closed)

                }else{
                  $('[data-tickets-for-me-open]').html(0)
                  $('[data-tickets-for-me-awaiting]').html(0)
                  $('[data-tickets-for-me-working]').html(0)
                  $('[data-tickets-for-me-resolved]').html(0)
                  $('[data-tickets-for-me-closed]').html(0)
                }
              }

            }

          })

          }
          show_tickets_for_me()

        </script>

        <br><br><br>
        <section class="i-boxes shadow-1">
          <div class="i-boxes-head">
            <h1>Tickets For Team</h1>
          </div>

          <section class="i-boxes-cover">
            <div class="i-box" data-my-box style="width:200px;height: 100px">
              <a href="../user/task-management/tickets/tickets-for-team?stage=OPEN">
                <h2>Open</h3>
                  <h1 data-tickets-for-team-open><i class="fa fa-spinner fa-spin"></i></h1>
                </a>
              </div>  
              <div class="i-box" data-my-box style="width:200px;height: 100px">
                <a href="../user/task-management/tickets/tickets-for-team?stage=AWAITING">
                  <h2>Awaiting</h3>
                    <h1 data-tickets-for-team-awaiting><i class="fa fa-spinner fa-spin"></i></h1>
                  </a>
                </div>
                <div class="i-box" data-my-box style="width:200px;height: 100px">
                  <a href="../user/task-management/tickets/tickets-for-team?stage=WORKING">
                    <h2>Working</h2>
                    <h1 data-tickets-for-team-working><i class="fa fa-spinner fa-spin"></i></h1>
                  </a>
                </div>
                <div class="i-box" data-my-box style="width:200px;height: 100px">
                  <a href="../user/task-management/tickets/tickets-for-team?stage=RESOLVED">
                    <h2>Resolved</h2>
                    <h1 data-tickets-for-team-resolved><i class="fa fa-spinner fa-spin"></i></h1>
                  </a>
                </div>
                <div class="i-box" data-my-box style="width:200px;height: 100px">
                  <a href="../user/task-management/tickets/tickets-for-team?stage=CLOSED">
                    <h2>Closed</h2>
                    <h1 data-tickets-for-team-closed><i class="fa fa-spinner fa-spin"></i></h1>
                  </a>
                </div>
              </section>    
            </section>

            <script type="text/javascript">
              function show_tickets_for_me(){
                var total_open=0; 
                var total_awaiting=0; 
                var total_working=0;
                var total_resolved=0; 
                var total_closed=0; 
                $.ajax({
                  url:"<?php echo AJAXROOT; ?>"+'user/task-management/tickets/tickets-for-team-ajax',
                  type:'POST',
                  data:{},
                  beforeSend:function(){
                    $('#tabledata').html('loading data');
                  },
                  success:function(data){
                     console.log(data)
                   if((typeof data)=='string'){
                     data=JSON.parse(data)
                     $('#tabledata').html("");
                     if(data.status){
                      $.each(data.response.list, function(index, item) {

                        switch(item.stage) {
                          case 'OPEN':
                          total_open++
                          break;
                          case 'AWAITING':
                          total_awaiting++
                          break;
                          case 'WORKING':
                          total_working++
                          break;
                          case 'RESOLVED':
                          total_resolved++
                          break;
                          case 'CLOSED':
                          total_closed++
                          break;                                                      
                          default:
                  // code block
                }


              })

                      $('[data-tickets-for-team-open]').html(total_open)
                      $('[data-tickets-for-team-awaiting]').html(total_awaiting)
                      $('[data-tickets-for-team-working]').html(total_working)
                      $('[data-tickets-for-team-resolved]').html(total_resolved)
                      $('[data-tickets-for-team-closed]').html(total_closed)

                    }else{
                      $('[data-tickets-for-team-open]').html(0)
                      $('[data-tickets-for-team-awaiting]').html(0)
                      $('[data-tickets-for-team-working]').html(0)
                      $('[data-tickets-for-team-resolved]').html(0)
                      $('[data-tickets-for-team-closed]').html(0)
                    }
                  }

                }

              })

              }
              show_tickets_for_me()

            </script>
            <?php
            require_once APPROOT.'/views/includes/user/footer.php';
          ?>