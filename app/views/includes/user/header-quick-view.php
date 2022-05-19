      
   <?php require_once APPROOT.'/views/includes/common/url-func.php'; ?>   
   <?php require_once APPROOT.'/views/includes/user/url-func.php'; ?>   
   <!DOCTYPE html>
   <html>
   <head>
    <title>USER</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.png" type="img/png" sizes="16x16">
    <base href="<?php  echo URLROOT; ?>">
    <link rel="stylesheet" type="text/css" href="css/basic.css">
    <link rel="stylesheet" type="text/css" href="css/main_ui.css">
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <link rel="stylesheet" type="text/css" href="css/forms.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
   
    <link href="assets/fontawesome/css/all.min.css" rel="stylesheet">
    <script type="text/javascript" src="assets/jquery/jquery.js"></script>
    <link href=
'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/
ui-lightness/jquery-ui.css'
        rel='stylesheet'>
        <script src=
"https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" >
    </script>
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
  <body>
<?php require_once APPROOT.'/views/includes/common/processing-modal.php'; ?>
    <div id="main-ui-outer">
      
      <!----------------header section starts---------------->
      <section id="main-ui-header">
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

  
     </section>
      <!----------------navigation section ends---------------->



      <!----------------main content section starts---------------->
     <section id="main-ui-content">









