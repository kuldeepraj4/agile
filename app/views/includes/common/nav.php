<style type="text/css">
  #menu-t{
    background:white;
    display: flex;
    flex-wrap: wrap;
  }
  #menu-t-button{
    display: flex;
    justify-content: flex-end;
    align-items: center;
    background:var(--theme-color-two);
    width:20%;
    order: 2;
    flex-grow: 1;
  }

  #menu-t-toggle{
    display: none;
  }
  #menu-t-nav{
    order: 1;
    width: 60%;
    flex-grow: 15
  }
  #menu-t-button button{
    margin-right: 8px;
    background: transparent;
    font-size: 16px;
  }
  #menu-t-button button a{
    display: block;
    color: white;
    padding:0 1.5em; 
    line-height:2em;
    font-size: 1em;
    min-height: 2em;
    border-radius: 1em;
    overflow: hidden;  
    background:var(--theme-color-one);
  }
  #menu-main{
  display: flex;
  justify-content:center;
  background:var(--theme-color-two);
}

#menu-main li{
position: relative;
text-align: center;
}
#menu-main>li{
  min-width: 120px;
  border-right: 1px solid grey;
}
#menu-main>li:last-child{
border-right: none;
}
#menu-main> li:hover:before{
  width:100%;
}

#menu-main li a{
  display: block;
  padding: 18px 8px;
  color: white;
}
#menu-main li ul li a{
  padding: 5px 8px
}
#menu-main>li>ul{
  background: var(--theme-color-two);
  position: absolute;
  min-width:180px;
  top: 150%;
  width: 100%;
  opacity: 0;
  visibility: hidden;
  transition: .2s;
  z-index: 100;
  padding: 8px 1px;
}
#menu-main>li>ul>li{
  display: block;
}
#menu-main>li:hover ul{
  opacity: 1;
  visibility:visible;
  top: 105%;
}
@media(max-width:700px){
  #menu-t-button button{
    font-size: 14px;
  }
}
@media(max-width:860px){
  #menu-t-button{
    font-size: .8em;
    order: 1;
    justify-content: flex-start;
    padding:10px 15px;
  }
  #menu-t-toggle{
    display: flex;
    order:2;
    text-align: right;
    justify-content: flex-end;
    padding-right: 15px;
    background: var(--theme-color-two)
  }
  #menu-t-toggle button{
    background: transparent;
    color: white;
    font-size: 1.7em;
  }
  #menu-t-nav{
    order: 3;
  }
#menu-t-nav{
  max-height: 0;
  width: 100%;
  overflow: hidden;
  transition: .5s;
}
#menu-main{
  flex-direction: column;
}

#menu-main li{
text-align: center;
border-bottom: 1px solid lightgrey;
}
#menu-main>li{
  min-width: 200px;
}
#menu-main>li>ul{
  position: relative;
  opacity: 1;
  visibility:visible;
  padding-left:24px;
  background: var(--theme-color-two)
}
#menu-main>li>ul>li>a{
  color: white;
}
.sub-menu{
  overflow: hidden;
  max-height: 0;
  transition: .5s;
}
#menu-main> li::before{
  content:none;
}
#menu-main>li>ul::before{
  content:none;
}


}
</style>

<section id="menu-t">

<section id="menu-t-button">
  <button><a href="../search-post-id">Search ID</a></button>
</section>


<!-- menu list-->

<section id="menu-t-nav" class="menu-t-nav">
        <ul id="menu-main">
          <li><a href="../latest-jobs"> Home</a></li>
          <li><a href="../post-categories"> Categories</a></li>
          <li><a href="../post-locations">Locations</a></li>
          <li><a href="../search-post-id">Search ID</a></li>          
        </ul>        
 </section>
<!-- //menu list-->




<!-- toggle Section  -->
<section id="menu-t-toggle">  
  <button id="toggle_open" class="">
    <i class="fa fa-bars" id="toggle_button"></i>
  </button>
</section>
<!-- //toggle Section  -->
</section>


<script type="text/javascript">
   const toggle_open=document.querySelector("#toggle_open");
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

     if(window.innerWidth <860){
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
        navbarNav.classList.remove("open");
    hideSubMenu();
    navToggleBtn.classList.remove("close");
 }) 
</script>