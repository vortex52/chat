<?php
require("backend.php");
?>
<!doctype html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<title>VortexCode</title>
	<link href="style/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="style/style.css" type="text/css">
	<script  type='text/javascript' src="js/jquery-1.11.3.js"></script>
	<script  type='text/javascript' src="js/bootstrap.js"></script>
	<script  type='text/javascript' src="js/script.js"></script>
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	<div class="main">
		<header class="nav">
			<a id="nav-autorization" href="#">Авторизация</a>
			<a id="nav-exit" href="#">Выйти</a>
		</header>
		<div class="container">
			<div class="container-left-sidebar">
				<h3>В чате:</h3>
				<?for ($i = 0; $i < count($users_online); $i++):?>
					<div><?=$users_online[$i]["name"];?></div>
				<?endfor;?>
				<input type="hidden" class="container-left-sidebar-user" value="<?=$user_name;?>"/>
				<div id="print"> </div>
			</div>
			<div class="container-chat-field">
				<?foreach ($res_arr as $message): ?>	
					<div class="chat-field-block <?=$message["comment_type"];?>">						
						<a class="chat-field-link" href="#"><?=$message["name"];?> 
							<input type="hidden" class="chat-field-block-name" value="<?=$message["name"];?>"/>
							<input type="hidden" class="chat-field-block-type" value="<?=$message["comment_type"];?>"/>
						</a>
						to <a class="chat-field-recipient" href="#"> <?=$message["recipient"];?>
							<input type="hidden" class="chat-field-recipient-name" value="<?=$message["recipient"];?>"/>
							<input type="hidden" class="chat-field-recipient-type" value="<?=$message["comment_type"];?>"/>
						</a>:<br/>
						<div class="chat-field-text"><?=$message["comment"];?></div>
						<span class="chat-field-date"><?=$message["date"];?></span>
						<span class="chat-field-comment-type"><?=$message["comment_type"];?></span>
						
					</div>
				<?endforeach;?>
			</div>
		</div>
		
		<div id="hide">
			<hr> 
			<form method="POST">
				Кому:
				<select class="form-control hide-marg" name="user" size="1">
					<option class="hide-this-user" name="user"></option>
					<?foreach ($users as $user): ?>	
						<option class="hide-user" name="hide-user" value="<?=$user["name"];?>"><?=$user["name"];?></option>
					<?endforeach;?>	
				</select>
				<input type="hidden" class="hide-recipient" name="hide-recipient" value=""/>
				<input type="hidden"  class="hide-name" name="hide-name" value="#bob"/>
				<input type="hidden" class="hide-type" name="hide-type" value="<?=$comment_type;?>">
				<input id="hide-comment" class="form-control" type="text" name="hide-comment" value="" placeholder="Комментарий..." />
				<br/>
				<div class="input-group">
					<button class="btn btn-success hide-public" name="hide-publick" type="submit">публичный</button>
					<button class="btn btn-warning hide-private" name="hide-private" type="submit">приватный</button>
					<span class="input-group-btn">
						<button class="btn btn-primary hide-add-comm" name="" type="submit">Добавить комментарий</button>
					</span>				
										
				</div>
				<div id="message"></div>
			</form>
		</div>	
			
	</div>
	
	</div> 
	<footer class="footer">
		<p class="copy">Copyright &copy; 2015 VortexCode </p>
	</footer>
 
</body>
</html>