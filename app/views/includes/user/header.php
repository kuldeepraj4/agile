      
<?php require_once APPROOT.'/views/includes/common/url-func.php'; ?>   
<?php require_once APPROOT.'/views/includes/user/url-func.php'; ?>   
<!DOCTYPE html>
<html>
<head>
  <title>USER</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.png" type="img/png" sizes="16x16">
  <base href="<?php  echo URLROOT; ?>">
  <link rel="stylesheet" type="text/css" href="css/basic.css?version=1.0">
  <link rel="stylesheet" type="text/css" href="css/main_ui.css?version=1.0">
  <link rel="stylesheet" type="text/css" href="css/table.css?version=1.0">
  <link rel="stylesheet" type="text/css" href="css/forms.css?version=1.0">
  <link rel="stylesheet" type="text/css" href="css/header.css?version=1.0">
  <link href="assets/fontawesome/css/all.min.css" rel="stylesheet">
  
  
  <link rel="stylesheet" type="text/css" href="css/excelbtn.css"> 
  <script type="text/javascript" src="assets/jquery/jquery.js"></script>
<link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'rel='stylesheet'>
      
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" ></script><script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" ></script>
<script type="text/javascript" src="assets/js/table2csv.js"></script>    
</head>
<script>
  function logoutNow(){
    var confi=confirm('Want to logout ?');
    if(confi==true){
      GTU_logout();
    }
  }
  
</script>   
<?php
 

$minutes_to_add = $_SESSION['user_locked_time']*60;
$current_time = time(); 
//$endTime = strtotime("+1 minutes",$_SESSION['loggedin_time']).'<br>';

// echo $_SESSION["user_locked_time"];
// echo (time() - $_SESSION['loggedin_time']);
  if(isset($_SESSION["user_locked_time"])){  
    if(((time() - $_SESSION['loggedin_time']) > $minutes_to_add)){ 
      unset($_SESSION['userKey']);
      $_SESSION['expiry_alert']  = "Login Session has been Expired. Please Login Again!!";
    } 
  }
 

?>

<body style="overflow-y: hidden;">
  <?php require_once APPROOT.'/views/includes/common/processing-modal.php'; ?>

  <style type="text/css">
    .header{
      background: var(--theme-color-one);
      background-image: linear-gradient(to right,var(--theme-color-one),var(--theme-color-one-light));
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding:3px 10px;
      color: white;
      position: sticky;
      top: 0;
      z-index: 1000;
    }
    .header-left{
      display: flex;
      align-items: center;
    }
    .header-left>img{
      max-height: 80px;
      margin-right: 5px;
    }
    .header-right{
      display: flex;
      align-items: center;
    }

    .head-notifications{
      align-items: center;
      display: flex;
      display: block;
      margin:1px 8px;
      position: relative;
    }
    .head-notifications .hn-item a [data-counter]{
      color: orange;
      position: absolute;
      top: 0;
      right: 0;
      background: red;
      color: white;
      padding: 0px 2px;
      transform: translate(50%,-50%);
    }
    .head-notifications .hn-item a i{
      font-size: 1.4em
    }

    .header-right-user-info{
      margin:auto 10px;
      display: flex;
      align-items: center;
    }


    .noti-box{
      position: absolute;
      z-index: 10;
      top:100%;
      background: #f2f2f2;
      right: 0;
      min-width: 350px;
      max-width: 400px;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 0 10px -5px black;
      display: none;
    }

    .noti-box ul{
      padding:1px 10px;
      color: black;
      background: white;
      max-height:500px;
      overflow: auto;
    }
    .noti-box ul li{
      padding:8px 4px;
      cursor: pointer;
      border-bottom: 1px solid #f1f1f1
    }
    .noti-box ul li h4{
      font-weight: normal;
    }
    .noti-box ul li:last-child{
      border-bottom: none
    }
    .noti-box ul li:hover{
      background: #f2f2f2
    }
    .noti-box .noti-head{
     height: 30px;
     display: flex;
     justify-content: space-between;
     align-items: center;
   }
   .noti-box .noti-head>div:nth-child(1){
    width: 20px;
    margin-left: 5px;
  }
  .noti-box .noti-head>div:nth-child(2){
    font-weight: bold;
    color: black
  }
  .noti-box .noti-head>div:nth-child(3){      
    width: 20px;
    margin-right: 5px;
  }
  .noti-box  .noti-bottom{
    text-align: center;
    color: blue;
    padding: 7px;
  }
  .table > table > thead > tr > th {
    text-transform: capitalize;
  }
</style>


<div id="main-ui-outer">

  <!----------------header section starts---------------->
  <section id="main-ui-header">
    <section class="header">
      <div class="header-left">
       <a href="user/home"><img src="images/logo-rect.png" style="width: 100px;margin:1px 10px;"></a>
       <span></span>
     </div>
     <div class="header-center"></div>
     <div class="header-right">


      <div class="header-right-action-box head-notifications">
        <div class="hn-item">
          <a onclick="open_child_window({url:'../user/task-management/ticket-notifications/user-notifications',width:700,height:500})">
            <i class="noti-icon fa fa-tasks"></i>
            <span data-counter data-total-task-notifications></span>
          </a>
          <div class="noti-box" data-ticket-noti-section>
            <div class="noti-head">
              <div></div>
              <div>Ticket Notifications</div>
              <div data-close-noti-box><i class="ic cross" ></i></div>
            </div>
            <ul data-ticket-noti-list class="scroll-mini"></ul>
            <div class="noti-bottom"><a href="#">See All</a></div>
          </div>
        </div>

      </div>

      <div class="header-right-user-info qucik-seaction" >
        <span style="margin-right:8px" class="Quick-bottom">Quick Details</span>
        <i onclick="open_child_window({url:'../user/quick-details/quick-search',width:400,height:500})" class="fa fa-search" style="color: white;font-size: 1.2em"></i>
      </div>

      <div class="header-right-user-info">
        <span style="margin-right:8px"><?php echo $_SESSION['userName']; ?></span>
        <i onclick="logoutNow()" class="fas fa-power-off" style="color: white;font-size: 1.2em"></i>
      </div>
    </div>

  </section>
</section>
<!----------------header section ends---------------->



<!----------------navigation section starts---------------->

<section id="main-ui-nav">
  <style type="text/css">
    #section-menu{
    }
    #section-menu ul{
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
    }
    #section-menu a{
      display: block;
      padding: 5px 8px;
      background: lightblue;
      margin:5px 2.5px;
      color: black;
      border-radius:5px;
    }
  </style>
  <div id="section-menu">
    <ul>
      <?php
      echo (in_array('P0001', USER_PRIV)) ? '<li><a href="../user/masters/dashboard">Masters</a></li>':"";
      echo (in_array('P0160', USER_PRIV)) ? '<li><a href="../user/dispatch/dashboard">Dispatch</a></li>':"";
      echo (in_array('P0338', USER_PRIV)) ? '<li><a href="../user/safety/dashboard">Safety</a></li>':"";
      echo (in_array('P0189', USER_PRIV)) ? '<li><a href="../user/maintenance/dashboard">Maintenance</a></li>':"";
      echo (in_array('P0117', USER_PRIV)) ? '<li><a href="../user/accounts/dashboard">Accounts</a></li>':"";
      echo '<li><a href="../user/settings/dashboard">Settings</a></li>';
      echo '<li><a href="../user/task-management/dashboard">Tasks</a></li>';
      echo (in_array('P0405', USER_PRIV)) ?  '<li><a href="../user/inventory/dashboard">Inventory</a></li>' : '';

      ?>
    </ul>
  </div>

  <?php require_once APPROOT.'/views/includes/user/nav.php'; ?>    
</section>
<!----------------navigation section ends---------------->



<!----------------main content section starts---------------->
<section id="main-ui-content" >









