<div id="content">

<h2>確認ページ</h2>

<form method="POST">
	<input type="hidden" name="page" value="page5">
	<input type="hidden" name="signed_request" value="<?php echo $param['signed_request']; ?>">
	id <input type="text" name="id" value="<?php echo $param['id']; ?>" readonly><br>
	name <input type="text" name="name" value="<?php echo $param['name']; ?>" readonly><br>
	birthday <input type="text" name="birthday" value="<?php echo $param['birthday']; ?>" readonly><br>
	gender <input type="text" name="gender" value="<?php echo $param['gender']; ?>" readonly><br>
	email <input type="text" name="email" value="<?php echo $param['email']; ?>" readonly><br>
	message <textarea name="message" readonly><?php echo $param['message']; ?></textarea><br>
	<button>申し込み</button>

</form>


</div>

