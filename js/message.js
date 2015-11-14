function register(){  //注册判断
	var ajax = new Ajax();
	var mail = document.getElementById("mail").value;
	var nicknames = document.getElementById("nicknames").value;
	var password = document.getElementById("password").value;
	var againpsd = document.getElementById("againpsd").value;
	
	$(".register-input").focus(function(){
		document.getElementById('error').innerHTML = ''; 
	})                 
　　var Regex = /^(?:\w+\.?)*\w+@(?:\w+\.)*\w+$/;

　　if (!Regex.test(mail)){                
　　　　if (mail == "") {   
			document.getElementById('error').innerHTML = '请输入电子邮件地址！！';                               
	　　 	return false;                
	　　}                
	　　else { 
			document.getElementById('error').innerHTML = '您好，你输入不正确，请重新输入!'; 
		    document.getElementById("mail").value = "";                    
		　　return false;                
　　　　}           
　　}            
　　else if(nicknames==""){                
	　　document.getElementById('error').innerHTML = '请输入昵称！！';          
　　}
    else if(password==""){
    	document.getElementById('error').innerHTML = '请输入密码！！';  
    }
    else if(password!=againpsd){
    	document.getElementById('error').innerHTML = '两次输入的密码不一致，请重新输入！！';
    	document.getElementById("password").value = "";
    	document.getElementById("againpsd").value = "";  
    }
   
    else if(!document.getElementById("checkbox").checked){
		document.getElementById('error').innerHTML = '请阅读注册协议！！';
	}
    else{
    	//数字+字母验证		
		var code_char = $("#code_char").val();
		$.post("../deal/chk_code.php",{code:code_char},function(msg){
			if(msg!=1){
				document.getElementById('error').innerHTML = '验证码错误！！';
			}else{
				var strarr=new Array();
		    	ajax.post("../deal/repeat-register.php",{mail:mail,nicknames:nicknames,password:password},function(data){
		    		//alert(data);
					strarr=data.split(",");
					if(strarr[0]!='0'||strarr[1]!='0'){
						if (strarr[1]!='0') {
							document.getElementById('error').innerHTML = '该邮箱已经注册，请直接登录！！';
						}
						else{
							document.getElementById('error').innerHTML = '该用户名已经注册，请换一个用户名！！';
						}
					}
					else{
						$(".activate").show();
				        $(".register-bd").hide();
				        $(".stay2").addClass("underway");
				        
				        $("#before").click(function(){
				     		$(".activate").hide();
				            $(".register-bd").show();
				            $(".stay2").removeClass("underway");
				     	})

				     	ajax.post("../deal/register_judge.php",{mail:mail,nicknames:nicknames,password:password},function(data){
								//var back = eval('(' +data+')');
								//alert(data);
								if(data.login){
									window.location.href = "../search.php";
								}else {
									document.getElementById('error').innerHTML = back.problem;
								}
							}
						)
					}
				})
			}
		})
    }
	
}

