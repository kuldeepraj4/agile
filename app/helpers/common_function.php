<?php
  function getUrl(){
      if(isset($_GET['url'])){
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
      }
    }
  function getUri(){
      if(isset($_GET['url'])){
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        return $url;
      }
    }

function is_user_set(){
  return true;
}

function GT_default_page(){
 // header('location:'.URLROOT.'error-page');
  ?>
  <script>location.href="<?php echo URLROOT.'../error-page'; ?>"</script>
  <?php
}
function GT_login_page(){
  ?>
  <script>location.href="<?php echo URLROOT.'../login'; ?>"</script>
  <?php
  //header('location:'.URLROOT.'login');
}

?>


