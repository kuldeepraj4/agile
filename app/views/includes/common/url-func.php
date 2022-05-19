<script type="text/javascript">
function GTU_login(){
  location.href="<?php echo URLROOT.'../login'; ?>";
}
function GTU_logout(){
  location.href="<?php echo URLROOT.'../logout'; ?>";
}
function GTU_home(){
  location.href='<?php echo URLROOT.'../user/home' ?>'
}



function submit_to_wait_btn(btn_id,new_text){
   $(btn_id).prop('disabled', true);
   $(btn_id).html('Loading');
}
function wait_to_submit_btn(btn_id,new_text){
   $(btn_id).prop('disabled', false);
   $(btn_id).html(new_text);
}
function timestampToDate(timestamp){
dateObj = new Date(timestamp * 1000); 
result =dateObj.getDate()+'-'+(dateObj.getMonth()+1)+'-'+dateObj.getFullYear();	
	return result;
}

function change_url_and_execute(key,value,type) {
     var myurl=window.location.href.split('&');
     var mainUrl=myurl[0];
    var paramArray={};
    for (i = 1; i < myurl.length; i++) {
        paramArray[myurl[i].split('=')[0]]=myurl[i].split('=')[1]    
        }
        paramArray[key]=value;
        if(type=='new'){
          var finalUrl=mainUrl+'&'+key+'='+value;
        }else if(type=='reset'){
          var finalUrl=mainUrl;
        }else{
          var finalUrl=mainUrl+'?&'+$.param(paramArray);
        }
        
        location.href=finalUrl;
}

</script>