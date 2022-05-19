<?php
require_once APPROOT . '/views/includes/user/header.php';
$details = $data['details'];
$filename = $details['file_upload_url'];
//$ext = pathinfo($filename, PATHINFO_EXTENSION);
?>

<br><br>
<style type="text/css">
  .ticket-details {
    border-radius: 10px;
    box-shadow: 0 0 14px -5px grey;
  }

  .ticket-details>h1 {
    padding: 10px;
    text-align: center;
  }

  .ticket-details-main-detials {
    border: 1px solid lightgrey;
    display: flex;
    flex-wrap: wrap;
    border-radius: 8px;
  }

  .ticket-details-main-detials>div:nth-child(1) {
    width: 70%;
    border-right: 1px solid lightgrey;
    padding: 5px;
  }

  .ticket-details-main-detials>div:nth-child(2) {
    width: 20%;
    flex-grow: 1;
  }

  .ticket-details-main-detials>div:nth-child(2)>ul {
    padding: 5px 15px;
  }

  .ticket-details-main-detials>div:nth-child(2)>ul>li {
    margin-bottom: 10px;
    display: flex;
  }

  .ticket-details-main-detials>div:nth-child(2)>ul>li>span {
    display: block;
  }

  .ticket-details-main-detials>div:nth-child(2)>ul>li>span:nth-child(1) {
    width: 40%;
    font-style: italic;
  }

  .ticket-details-main-detials>div:nth-child(2)>ul>li>span:nth-child(1)::after {
    content: ' : ';
  }

  .ticket-details-main-detials>div:nth-child(2)>ul>li>span:nth-child(2) {
    font-weight: bold;
    width: 60%;
  }

  .ticket-details-main-detials>div:nth-child(3) {
    width: 100%;
    border-top: 1px solid lightgrey;
    padding: 10px;
  }

  .ticket-details-main-detials>div:nth-child(3)>div>span:nth-child(1) {
    font-weight: bold;
    margin-right: 10xp;
    font-size: 1.1em;
    font-style: italic;
  }
</style>
<section class="content-box ticket-details" style="margin: auto;max-width: 1000px">
  <h1>Ticket <?php echo  $details['id']; ?></h1>

  <section class="ticket-details-main-detials">
    <div>
      <h3>Text</h3>
      <div style="padding:10px"><?php echo  $details['text']; ?></div>
    </div>
    <div>
      <ul>
        <li><span>Status</span> <span style="font-size: 1.5em;"><?php echo  $details['status']; ?></span></li>
        <li><span>Due Date</span> <span><?php echo  $details['due_datetime']; ?></span></li>
        <li><span>Created Time</span> <span><?php echo  $details['added_on_datetime']; ?></span></li>
        <li><span>Created By</span> <span><?php echo  $details['added_by_user_code']; ?></span></li>
      </ul>
    </div>
    <div>

      <?php if (count($details['assigned_to_levels']) > 0) {
        echo  '<div><span>Assigned to levels : </span> <span>';
        $count = 0;
        foreach ($details['assigned_to_levels'] as $atl) {
          $count++;
          echo $atl['level_name'];
          echo ($count < count($details['assigned_to_levels'])) ? ', ' : ' ';
        }
        echo "</span></div>";
      }
      ?>

      <?php
      if (count($details['assigned_to_users']) > 0) {
        echo  '<div><span>Assigned to users : </span> <span>';
        $count = 0;
        foreach ($details['assigned_to_users'] as $atl) {
          $count++;
          echo $atl['user_name'];
          echo ($count < count($details['assigned_to_users'])) ? ', ' : ' ';
        }
        echo "</span></div>";
      } ?>
      <div>
        <span>View Document : </span> <span>
          <?php
          if ($filename) {
          ?>
            <button class='btn_grey_c' type="button" onclick="open_document('<?php echo $details['file_upload_url'] ?>')"><i class='fa fa-file'></i></button>
          <?php
          } else {
            echo "No File Exist";
          }
          ?>

        </span>
      </div>
    </div>

  </section>
</section>


<br>
<br>
<section class="list-200 content-box" style="margin: auto;max-width: 1000px">
  <h1 class="list-200-heading">Actions History</h1>
  <div class="table  table-a">
    <table>
      <thead>
        <tr>
          <th style="width: 80px;">Sr. No.</th>
          <th style="width: 100px;text-align: left;">Status</th>
          <th style="width: 100px;text-align: left;">User</th>
          <th style="width: 200px;">Reaction datetime</th>
          <th style="text-align:left">Text</th>

        </tr>
      </thead>
      <tbody>
        <?php
        $counter = 0;
        foreach ($details['actions'] as $action) {
          echo "<tr>
          <td>" . ++$counter . "</td>
          <td style='width: 100px;text-align: left;'>" . $action['status'] . "</td>
          <td style='width: 100px;text-align: left;'>" . $action['added_by_user_name'] . "</td>
          <td>" . $action['added_on_datetime'] . "</td>
          <td style='text-align:left'>" . $action['text'] . "</td>
          </tr>";
        }
        if (count($details['actions']) == 0) {
          echo "<tr><td colspan='5'>No action take yet</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
  <br>
  <br>
  <br>


  <style type="text/css">
    .add-action {
      width: 80%;
    }

    .aaf-b {
      padding: 10px 0px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .aaf-b>div {
      width: 50%;
    }

    .aaf-b>div select {
      width: 70%;
      height: 35px
    }
  </style>
  <section>
    <h2 style="text-align: center;margin-bottom:8px">Add New Action</h2>
    <form method="POST" id="MyForm" class="aaf" onsubmit="return add_new()">
      <input type="hidden" name="ticket_eid" value="<?php echo $data['eid'] ?>">
      <div>
        <textarea name="text" style="min-height:100px;width: 100%" placeholder="Write description here"></textarea>
      </div>
      <div class="aaf-b">
        <div>
          <label>Status &nbsp </label>
          <select name="stage_id" required="required"></select>
        </div>
        <div>
          <button class="form-submit-btn" id="submit">Save</button>
        </div>
      </div>

      <div>

      </div>
    </form>
  </section>

  <br><br>
</section>
<br>
<br>

<section class="form-a" style="max-width: 600px;display: none;">
  <div class="form-a-header">Add New Action</div>
  <form method="POST" id="MyForm" onsubmit="return add_new()">
    <input type="hidden" name="ticket_eid" value="<?php echo $data['eid'] ?>">
    <div>
      <label>Status</label>
      <select name="stage_id" required="required"></select>
    </div>
    <div>
      <label>Text</label>
      <textarea name="text" style="min-height:100px"></textarea>
    </div>
    <div>
      <button class="form-submit-btn" id="submit">SAVE</button>
    </div>
  </form>
</section>

<script type="text/javascript">
  function add_new() {
    show_processing_modal()
    submit_to_wait_btn('#submit', 'loading')
    $('#formErro').show()
    var form = document.getElementById('MyForm');
    var isValidForm = form.checkValidity();
    var currentForm = $('#MyForm')[0];
    var formData = new FormData(currentForm);
    if (isValidForm) {
      var arr = $('#MyForm').serializeArray();
      var obj = {}
      for (var a = 0; a < arr.length; a++) {
        obj[arr[a].name] = arr[a].value
      }
      $.ajax({
        url: "<?php echo AJAXROOT; ?>" + 'user/task-management/tickets/tickets-add-action',
        type: 'POST',
        data: obj,
        success: function(data) {
          if ((typeof data) == 'string') {
            data = JSON.parse(data)
          }
          alert(data.message);
          if (data.status) {
            location.reload()
            wait_to_submit_btn('#submit', 'ADD')
          } else {
            wait_to_submit_btn('#submit', 'ADD')
          }
          hide_processing_modal()
        }
      })
    }
    return false
  }
</script>
<script type="text/javascript">
  function show_stages() {
    get_tickets_statges().then(function(data) {
      // Run this when your request was successful
      if (data.status) {

        //Run this if response has list
        if (data.response.list) {
          var options = "";
          options += `<option value="">- - Select - -</option>`
          $.each(data.response.list, function(index, item) {
            options += `<option value="${item.id}">${item.name}</option>`;
          })
          $('[name="stage_id"]').html(options);
          $(`[name="stage_id"] option[value="<?php echo  $details['status']; ?>"]`).prop('selected', true);
        }
      }
    }).catch(function(err) {
      // Run this when promise was rejected via reject()
    })
  }

  show_stages()
</script>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>