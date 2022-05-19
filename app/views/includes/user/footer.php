</section>
  <style>
    .tooltip-bottom {
      position: fixed;
      right: 25px;
      top: 170px;
      font-size: 40px;
      cursor: pointer;
    }

    .tooltip-top {
      position: fixed;
      right: 25px;
      bottom: 70px;
      font-size: 40px;
      cursor: pointer;
    }

    .tooltip-top i,
    .tooltip-bottom i {
      opacity: .4;
    }

    .tooltip-top .scrollTop,
    .tooltip-bottom .scrollTop {
      visibility: hidden;
      top: 5px;
      right: 120%;
      /* opacity: 1.9 !important; */
      background-color: black;
      color: #fff;
      text-align: center;
      padding: 5px 0;
      font-size: 18px;
      width: 120px;
      border-radius: 6px;
      /* Position the tooltip */
      position: absolute;
      z-index: 1;
    }

    .tooltip-top:hover .scrollTop,
    .tooltip-bottom:hover .scrollTop {
      visibility: visible;
    }

    .tooltip-left::after {
      content: "";
      position: absolute;
      top: 50%;
      opacity: 1 !important;
      left: 100%;
      margin-top: -5px;
      border-width: 5px;
      border-style: solid;
      border-color: transparent transparent transparent #555;
    }
    #menu-main li a{
      text-transform: capitalize;
    }
  </style>
  <div class="tooltip-top "><i class="fas fa-arrow-circle-up" onclick="window.scrollTo(0, 0)"></i>
    <span class="scrollTop tooltip-left">Show Menu</span>
  </div>
  <div class="tooltip-bottom "><i class="fas fa-arrow-circle-down" onclick="window.scrollTo(0, document.body.scrollHeight)"></i>
    <span class="scrollTop tooltip-left">Hide Menu</span>
  </div>
  <!----------------main content section ends---------------->
  <script>
    $(document).ready(function() {
      $("[data-table-sort-by]").on("click", function() {
        var sort = $("#sort").val();
       if (sort == "asc") {
          $("#sort").val("desc");
        } else {
          $("#sort").val("asc");
        }
        //--remove the active sort by tag from all options
        $("[data-table-sort-by]").removeAttr("data-table-sort-by-active");
        //---add sort by tag to the currently selected option
        $(this).attr("data-table-sort-by-active", "");
        //---get the value by which sort is clickd
        let sort_by = $(this).data("table-sort-by");
        //---assign this value to #sort_by input filed;  
        $('#sort_by').val(sort_by);
        sort_table()
      });
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $(function() {
        $("[data-date-picker]").datepicker();
      });
    })
  </script>




<!--  

check date inpt wrong ener date input dev
  
 <script type="text/javascript">
   $(document.body).on('change', '[date-cheker-input]', function() {
       
            var name = $("[date-cheker-input]").attr('name');
               var rrr = $("[name='"+name+"']").val();
          var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/; //Declare Regex
    var dtArray = rrr.match(rxDatePattern);
    console.log(name);

   if(dtArray == null){
    $("[name='"+name+"']").val("").focus();
       alert("Please Enter Vaild date'"+name+"'");
     }

    });
   
</script> -->

  <script type="text/javascript">
    //---------pagination handler
    function go_to_page(pageNo) {
      show_list(pageNo)
    }

    function do_pagination() {
      let $totalPages = $('[data-list-pagination]').data('list-pagination-total-pages');
      let $activePage = $('[data-list-pagination]').data('list-pagination-active-pages');
      var pagination = `<div>Page : </div><ul>`
      for (let i = 1; i < ($totalPages + 1); i++) {
        if (i == $activePage) {
          pagination += `<li class='active' onclick="go_to_page(${i})">${i}</li>`
        } else {
          pagination += `<li onclick="go_to_page(${i})">${i}</li>`
        }
      }
      pagination += `</ul>`
      $('[data-list-pagination]').html(pagination)
    }
    //---------/pagination handler
  </script>
  <script type="text/javascript">
    $(document).on("click", "[data-notes-toggle-high-priority-status]", function() {
      var note_eid = $(this).parent().parent().parent().parent().data('note-eid')
      var high_priority_status = ($(this).prop("checked")) ? 'ON' : 'OFF';
      $.ajax({
        url: "<?php echo AJAXROOT; ?>" + 'user/miscellaneous/notes/toggle-high-priority-status',
        type: 'POST',
        data: {
          note_eid: note_eid,
          high_priority_status: high_priority_status
        },
        context: this,
        success: function(data) {
          if ((typeof data) == 'string') {
            data = JSON.parse(data)
          }
          if (data.status) {
            if (high_priority_status == 'ON') {
              $(this).parent().parent().parent().parent().addClass('high-priority-true');
            } else {
              $(this).parent().parent().parent().parent().removeClass('high-priority-true');
            }
          } else {                                                                                                                          
            alert(data.message)
          }
        }
      })
    });
    $(document).on("click", "[data-note-delete]", function() {
      if (confirm('Do you want to delete note ?')) {
        var note_eid = $(this).parent().parent().parent().parent().data('note-eid')
        $.ajax({
          url: "<?php echo AJAXROOT; ?>" + 'user/miscellaneous/notes/delete-action',
          type: 'POST',
          data: {
            note_eid: note_eid,
          },
          context: this,
          success: function(data) {
            if ((typeof data) == 'string') {
              data = JSON.parse(data)
            }
            if (data.status) {
              $(this).parent().parent().parent().parent().slideUp();
            } else {
              alert(data.message)
            }
          }
        })
      }
    });
  </script>
  <script type="text/javascript">
    $('[data-button-export-to-excel]').css({
      "background": "#1D6F42",
      "color": "white"
    })
    $('[data-button-export-to-excel]').html('<i class="fas fa-file-excel"></i> Excel')
  </script>
  <script type="text/javascript">
    //Pagination changes as per whole application
    if (check_url_params('batch') === undefined || check_url_params('batch') <= 12) {
      $(".table-a").css("height", "auto");
      //show_list();
    }

    function goto_page(pageno) {
      set_params('page_no', pageno)
      // page_no=pageno
      show_list()
    }

    function set_batch(value) {
      // set_params('batch', value)
      //Pagination changes as per whole application
      var items = value;
      if (items <= 12) {
        $(".table-a").css("height", "auto"); 
      } else {
        $(".table-a").css("height", "90%");
      }
      set_params('batch', value)
      //show_list()
      goto_page(1)
    }

    function set_pagination(param) {
      let $totalPages = param.totalPages;
      let $activePage = param.currentPage;

      //Pagination changes as per whole application
      // if(param.currentPage === 1){
      //    $(".table-a").css("height", "auto");
      // }
      // End Pagination changes as per whole application
      pn = `Page: <ul>`;
      if (param.currentPage > 1) {
        pn += `<li><button class="btn_green" onclick="goto_page('${param.currentPage-1}')"><i class="fa fa-angle-double-left"></i></button></li>`
      }
      pn += `<li>${param.currentPage} / ${param.totalPages}</li>`
      if (param.currentPage < param.totalPages) {
        pn += `<li onclick="goto_page('${param.currentPage+1}')"><button class="btn_green"><i class="fa fa-angle-double-right"></i></button></li>`
      }
      pn += `</ul>`;
      $('[data-pagination]').html(pn)
      sl_str = `<select onchange="goto_page(this.value)">`
      for (sl = 1; sl <= param.totalPages; sl++) {
        let selected_page = ($activePage == sl) ? 'selected' : ''
        sl_str += `<option value="${sl}" ${selected_page}>${sl}</option>`
      }
      sl_str += `</select>`
      $(param.selector).append(` &nbsp Go to Page : ` + sl_str)
      if (param.batch) {
        select_showing = `
        <select data-batch-selector onchange=set_batch(this.value) data-default-select="${param.batch}">
          <option value="10">10</option>
          <option value="25">25</option>
          <option value="50">50</option>
          <option value="100">100</option>
          <option value="500">500</option>
          <option value="1000">1000</option>
        </select>
        `
        $(param.selector).append(` &nbsp Showing : ` + select_showing);
        select_default('[data-batch-selector]')
      }
    }
  </script>





  <!-- ------------ONLY FOR QUICK VIEW---------SET BATCH AND PAGINATION SECTION START HERE------------ONLY FOR QUICK VIEW-------ONLY FOR QUICK VIEW-------------------------------------------------------------- -->
  <script type="text/javascript">
    function set_pagination_batch(batch, totalPages, currentPage, ajax) {
      let $totalPages = totalPages;
      let $activePage = currentPage;
      pn = `Page: <ul style="display:flex;">`;
      if (currentPage > 1) {
        pn += `<li><button class="btn_green" onclick="goto_page_my('${currentPage-1}', '${ajax}')"><i class="fa fa-angle-double-left"></i></button></li>`
      }
      pn += `<li>&nbsp${currentPage} / ${totalPages}&nbsp</li>`
      if (currentPage < totalPages) {
        pn += `<li onclick="goto_page_my('${currentPage+1}', '${ajax}')"><button class="btn_green"><i class="fa fa-angle-double-right"></i></button></li>`
      }
      pn += `</ul>`;
      $(`[data-pagination-${ajax}]`).html(pn)
      sl_str = `<select onchange="goto_page_my(this.value, '${ajax}')">`
      for (sl = 1; sl <= totalPages; sl++) {
        let selected_page = ($activePage == sl) ? 'selected' : ''
        sl_str += `<option value="${sl}" ${selected_page}>${sl}</option>`
      }
      sl_str += `</select>`
      $(`[data-pagination-${ajax}]`).append(` &nbsp Go to Page : ` + sl_str)
      if (batch) {
        select_showing = `
        <select data-batch-selector-${ajax} onchange="set_batch_my('${ajax}', this.value), show_list_${ajax}" data-default-select="${batch}">
          <option value="10">10</option>
          <option value="25">25</option>
          <option value="50">50</option>
          <option value="100">100</option>
          <option value="500">500</option>
          <option value="1000">1000</option>
        </select>`;
        $(`[data-pagination-${ajax}]`).append(` &nbsp Showing : ` + select_showing);
        $(`[data-pagination-${ajax}]`).css({
          "padding": "10px 20px",
          "display": "inline-flex"
        });
        select_default(`[data-batch-selector-${ajax}]`)
      }
    }
  </script>
  <!-- --------ONLY FOR QUICK VIEW-------------SET BATCH AND PAGINATION SECTION END HERE------ONLY FOR QUICK VIEW------END HERE----------ONLY FOR QUICK VIEW----------------------------------------------------------- -->




  <script type="text/javascript">
    $(document).ready(function() {
      $("select[data-default-select]").each(function(index) {
        $(this).children('option[value="' + ($(this).data('default-select')) + '"]').prop('selected', true);
      });
    });

    function select_default(selector) {
      $(selector).children('option[value="' + ($(selector).data('default-select')) + '"]').prop('selected', true);
    }
  </script>
  </body>

  <script type="text/javascript">
    $(document.body).on('change', '[data-time-picker-inspection]', function() {
      let entered_time = $(this).val()
      output = '';
      is_format_ok = true;
      if (entered_time.match(/[0-9]{4,4}/g)) {
        var a = entered_time.slice(0, 2);
        var b = entered_time.slice(2, 4)
        if (a < 0 || a > 23) {
          is_format_ok = false;
        }
        if (b < 0 || b > 59) {
          is_format_ok = false;
        }
        output = a + ':' + b
      } else if (entered_time.match(/[0-9]{2,2}:[0-9]{2,2}/g)) {
        output = entered_time
      } else {
        is_format_ok = false;
      }
      if (is_format_ok) {
        $(this).val(output)
        $(this).css("border-color", "lightgrey")
      } else {
        $(this).val('00:00')
      }
    });
  </script>
  <script type="text/javascript">
    //-------- add/remove required attribute based on TBD check box 
    $(document.body).on('change', '[data-time-picker]', function() {
      let entered_time = $(this).val()
      output = '';
      is_format_ok = true;
      if (entered_time.match(/[0-9]{4,4}/g)) {
        var a = entered_time.slice(0, 2);
        var b = entered_time.slice(2, 4)
        if (a < 0 || a > 23) {
          is_format_ok = false;
        }
        if (b < 0 || b > 59) {
          is_format_ok = false;
        }
        output = a + ':' + b
      } else if (entered_time.match(/[0-9]{2,2}:[0-9]{2,2}/g)) {
        output = entered_time
      } else {
        is_format_ok = false;
      }
      if (is_format_ok) {
        $(this).val(output)
        $(this).css("border-color", "lightgrey")
      } else {
        alert('invalid format type')
        $(this).css("border-color", "red")
        $(this).val('')
        $(this).focus()
      }
    });
    //--------/ add/remove required attribute based on TBD check box 
  </script>
  <script type="text/javascript">
    var current_unread_ticket_notifications = 0

    function show_new_task_notifications(new_count) {
      limit = new_count - current_unread_ticket_notifications
      current_unread_ticket_notifications = new_count
      $.ajax({
        url: '../user/task-management/ticket-notifications/user-notifications-ajax',
        type: 'POST',
        data: {
          limit: limit
        },
        success: function(data) {
          if ((typeof data) == 'string') {
            data = JSON.parse(data)
            if (data.status) {
              $('[data-ticket-noti-list]').html('')
              $('[data-ticket-noti-section]').slideDown()
              $.each(data.response.list, function(index, item) {
                $('[data-ticket-noti-list]').append(`
              <li onclick="open_child_window({url:'${item.link}',width:700,height:500})"><h4>${item.heading}</h4></li>
              `)
              })
            }
          }
        }
      })
    }
    current_unread_ticket_notifications = ''

    function fetch_ticket_notification_count() {
      $.get('../user/task-management/ticket-notifications/user-total-unread-notifications-ajax', {}, function(data) {
        if ((typeof data) == 'string') {
          data = JSON.parse(data)
          if (data.status) {
            let new_count = parseInt(data.response.total_unread_notifications)
            if (current_unread_ticket_notifications == '') {
              current_unread_ticket_notifications = new_count;
            }
            $('[data-total-task-notifications]').html(new_count)
            if (new_count > current_unread_ticket_notifications) {
              show_new_task_notifications(new_count)
            }
          }
        }
      });
    }
    setInterval(fetch_ticket_notification_count, 5000) //Runs the "func" function every second
  </script>
  <script type="text/javascript">
    $(document).on("click", "[data-close-noti-box]", function() {
      var eid = $(this).parents('.noti-box').slideUp(200);
    });
  </script>

  <script type="text/javascript">
    // shortcut key for open quick search bar 
    document.addEventListener("keydown", function(event) {
    if (event.altKey && (event.key === 'q' || event.key === 'Q'))
    {
      open_child_window({url:'../user/quick-details/quick-search',width:400,height:500});
        //alert('Alt + X pressed!');
        event.preventDefault();
    }
});



      // $(document).ready(function(){
      //       $("#test").keypress(function(e){
      //           if (e.which == 103) 
      //           {
      //               alert('g'); 
      //           };
      //       });
      //   });
</script>

 
</html>
