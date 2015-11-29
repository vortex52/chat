$(document).ready(function() {

	var ObjnameCookie = function() {
		var name = "#bob";
		return name;
	}

	 ObjnameCookie.prototype.set_cookie = function(name, value, exp_y, exp_m, exp_d, path, domain, secure){
		var cookie_string = name + "=" + escape (value);
		if (exp_y)  {
			var expires = new Date (exp_y, exp_m, exp_d);
			cookie_string += "; expires=" + expires.toGMTString();
		}
 
		if (path)
        cookie_string += "; path=" + escape(path);
 
		if (domain)
        cookie_string += "; domain=" + escape(domain);
  
		if (secure)
        cookie_string += "; secure";
  
		document.cookie = cookie_string;
	}

	ObjnameCookie.prototype.get_cookie = function(cookie_name) {
		var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' ); 
		if (results)
		return (unescape (results[2]));
		else
		return null;
	}
	
	ObjnameCookie.prototype.delete_cookie = function(cookie_name) {
		var cookie_date = new Date (); 
		cookie_date.setTime (cookie_date.getTime() - 1);
		document.cookie = cookie_name += "=; expires=" + cookie_date.toGMTString();
	}
	
	var localUser = new ObjnameCookie();
	
	$("#nav-autorization").click(function() {
		var name = ObjnameCookie();
		var login =	prompt("Введите логин",name);
		if (login === name) {
			localUser.set_cookie ("username", name);
			window.location.href = "index.php";
		}
		else alert("Не верно");
	});
	
	$("#nav-exit").click(function() {
		localUser.delete_cookie ("username");
		window.location.href = "index.php";
	});
	
	if (localUser.get_cookie("username")) {
		$("#hide").css("display", "block");	
	}
		
	var ObjSetName = function() {
		
	}
			
	ObjSetName.prototype.setValue = function(name,commentType,recipient) {
		if (recipient) {
			$(".hide-this-user").text(recipient);
			$(".hide-marg option:selected").text(recipient);
			$("#hide-comment").val(recipient+" - ");
			$(".hide-recipient").val(recipient);
			$(".hide-type").val(commentType);
		}
		else {
			$(".hide-this-user").text(name);
			$(".hide-marg option:selected").text(name);
			$("#hide-comment").val(name+" - ");
			$(".hide-recipient").val(name);
			$(".hide-type").val(commentType);		
		}
	
	}	
	
	ObjSetName.prototype.addUser = function() {		
			var summ = "";
			function buffer (name) {	
				return summ += name+" ";						
			}			
			return buffer;
		}
		
	ObjSetName.prototype.sendMess =	function(test, user, name, comment, recipient, commentType) {
		$.ajax({
				type: "POST",
				url: "backend.php",
				data: ({hide_add_comm : test, hide_name : name, hide_recipient : recipient, hide_type : commentType, hide_comment : comment, hide_user :user}),
				beforeSend: function(){$("#message").text("Отправляется!")},
				success: function(){$("#message").text("Отправлено!");},
				complete: function(){$("#message").text("Получено!");},
				error: function(){return $("#message").text("Ошибка при отправке!");}
			});
	
	}
		
	var SetName = new ObjSetName();		
	var buffer =  SetName.addUser();
		
		$(".chat-field-link").click(function() {
			var name = $(this).find(".chat-field-block-name").val();
			var res = buffer(name);
			var commentType = $(this).find(".chat-field-block-type").val();
			SetName.setValue (res,commentType);			
		});
		
		$(".chat-field-recipient").click(function() {
			var name = true;
			var recipient = $(this).find(".chat-field-recipient-name").val();
			var res = buffer(recipient);
			var commentType = $(this).find(".chat-field-recipient-type").val();
			SetName.setValue (name,commentType,res);	
			
		});
		
		$(".hide-marg").change(function() {
			var recip = $(".hide-marg option:selected").val();
			var res = buffer(recip);
			$("#hide-comment").val(recip+" - ");
		});
		
		$("#hide-comment").keydown(function() {
			var user = $(".container-left-sidebar-user").val();
			$("#print").text(user+" печатает...");
		});
		
		$("#hide-comment").blur(function() {
			$("#print").text("");
		});
		
		$(".hide-add-comm").click(function() {
			var test = true;
			var user = $("form select option:selected").val();
			var name = $(".hide-name").val();
			var comment = $("#hide-comment").val();
			var recipient = $(".hide-recipient").val();
			var commentType = $(".hide-type").val();
			
			if (name == "" || user == "" || comment == "") {
				alert("Выберите тип сообщения публичный/приватный, добавьте получателя из списка и введите комметарий");
			}
			else {
				SetName.sendMess (test, user, name, comment, recipient, commentType);
			}
					
		});
		
});