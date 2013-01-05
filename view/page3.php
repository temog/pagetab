<div id="content">

<h2>入力フォームとか</h2>

<form method="POST">
	<input type="hidden" name="page" value="page4">
	<input type="hidden" name="signed_request" value="<?php echo $param['signed_request']; ?>">
	id <input type="text" name="id" value="<?php echo $param['id']; ?>"><br>
	name <input type="text" name="name" value="<?php echo $param['name']; ?>"><br>
	birthday <input type="text" name="birthday" value="<?php echo $param['birthday']; ?>"><br>
	gender <input type="text" name="gender" value="<?php echo $param['gender']; ?>"><br>
	email <input type="text" name="email" value="<?php echo $param['email']; ?>"><br>
	message <textarea name="message">ウォールへの投稿メッセージ</textarea><br>
	<button>確認画面へ</button>

</form>


</div>

