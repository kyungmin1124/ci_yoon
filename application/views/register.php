<div class="pre_container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign up!</h3>
			</div>
			<div class="card-body">
				<?php echo validation_errors(); ?>
				<form action="/index.php/auth/register" method="post">

          <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="email" class="form-control" id="email" value="<?php echo set_value('email'); ?>" name="email" placeholder="E-mail">
					</div>

					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" id="password" name="password" placeholder="비밀번호">
					</div>
          <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="password" class="form-control" id="re_password" name="re_password" placeholder="비밀번호 확인">
					</div>

					<div class="form-group">
						<input type="submit" value="Register" class="btn float-right login_btn">
					</div>
				</form>
			</div>

		</div>
	</div>
</div>
