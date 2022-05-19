<style type="text/css">
	#menu-t{
    background:white;
    display: flex;
    flex-wrap: wrap;
    margin:auto;
    justify-content: center;
    background: black;
  }
  #menu-main{
    display: flex;
    justify-content:center;
  }

  #menu-main li{
    position: relative;
    text-align: left;
    border-right: 1px solid grey;
    border-right: none;
  }
  #menu-main li:last-child{
    border-right: none;
  }
  #menu-main> li:hover:before{
    width:100%;
  }

  #menu-main li a{
    display: block;
    padding:2px 10px;
    color: white;
    cursor: pointer;
    white-space: nowrap;
  }
  #menu-main>li>a{
    padding:10px;
  }
  #menu-main>li>ul{
    background: black;
    position: absolute;
    min-width:150px;
    border:1px solid white;
    top: 100%;
    opacity: 0;
    visibility: hidden;
    transition: .1s;
    z-index: 100;
  }
  #menu-main>li>ul>li{
    display: block;
    padding-right: 7px;
  }
  #menu-main>li:hover> ul{
    opacity: 1;
    visibility:visible;
  }
  #menu-main>li>ul>li>ul{
    position: absolute;
    background: black;
    min-width:150px;
    left:100%;
    top:0px;
    opacity: 1;
    visibility: hidden;
    border:1px solid white; 
  }

  #menu-main>li>ul>li:hover  ul{
    opacity: 1;
    visibility:visible;
  }
  #menu-main>li>ul>li>a.third-nav::after {
    font-family: "Font Awesome 5 Free"; 
    font-weight: 900; 
    content: "\f105";
    position: absolute;
    right: 4px;
  }
</style>
<section id="menu-t">
  
  <?php
  if(isset($nav_type)){
    switch ($nav_type) {
      case 'masters':
      require_once APPROOT.'/views/includes/user/nav-masters.php';    
      break;
      case 'dispatch':
      require_once APPROOT.'/views/includes/user/nav-dispatch.php';    
      break;
      case 'safety':
      require_once APPROOT.'/views/includes/user/nav-safety.php';    
      break;
      case 'maintenance':
      require_once APPROOT.'/views/includes/user/nav-maintenance.php';    
      break;   
      case 'accounts':
      require_once APPROOT.'/views/includes/user/nav-accounts.php';    
      break;
      case 'task-management':
      require_once APPROOT.'/views/includes/user/nav-task-management.php';    
      break; 
      case 'inventory':
      require_once APPROOT.'/views/includes/user/nav-inventory.php';    
      break;      
      case 'settings':
      require_once APPROOT.'/views/includes/user/nav-settings.php';    
      break;      

      default:
      # code...
      break;
    }
  }
  ?>


</section>




<script type="text/javascript">
  /* const toggle_open=document.querySelector("#toggle_open");
   const toggle_button=document.querySelector("#toggle_button");
 const nav_a=document.querySelector("#menu-t-nav");
 const subMenuToggleBtn=document.querySelectorAll("#menu-t-nav .sub-menu-toggle");


  toggle_open.addEventListener("click",function () {
  if(nav_a.classList.contains("open")){
    hide_nav_a();
       toggle_button.classList.remove("fa-times")
   toggle_button.classList.add("fa-bars")
  }
  else{
   nav_a.classList.add("open");
   nav_a.style.maxHeight= nav_a.scrollHeight + "px";
   toggle_button.classList.add("fa-times")
   toggle_button.classList.remove("fa-bars")
  }
 })

function hide_nav_a(){
  nav_a.style.maxHeight=  0 + "px";
  nav_a.classList.remove("open");
}

 for(let i=0; i<subMenuToggleBtn.length; i++){
    subMenuToggleBtn[i].addEventListener("click",function(){

     if(window.innerWidth <780){
      const dropdown=this.parentElement;
      //const height=dropdown.querySelector(".sub-menu").scrollHeight;
      const subMenu=dropdown.querySelector(".sub-menu");
      const height=subMenu.scrollHeight;
      // console.log(height)
      if(subMenu.classList.contains("open")){
        // if subMenu classList has class open then
        subMenu.classList.remove("open");
        subMenu.style.maxHeight=0 + "px";
        //nav_a.style.maxHeight=(nav_a.scrollHeight - height) + "px";
      }
       else{
         // if subMenu classList has no class open then
         subMenu.classList.add("open")
         subMenu.style.maxHeight=height + "px";
         nav_a.style.maxHeight=(nav_a.scrollHeight + height) + "px";
       }
     }
     
    })
 }


 function hideSubMenu(){
  for(let i=0; i<subMenuToggleBtn.length; i++){
    const dropdown=subMenuToggleBtn[i].parentElement;
    dropdown.querySelector(".sub-menu").classList.remove("open");
 }
}


  window.addEventListener("resize" , function(){
        nav_a.classList.remove("open");
    hideSubMenu();
    nav_a.classList.remove("close");
 }) 
 */
</script>