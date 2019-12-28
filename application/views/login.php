<div class="pre_container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>LOG IN</h3>
			</div>
			<div class="card-body">

				<form action="/index.php/auth/authentication<?=empty($returnURL)?'':'?returnURL='.rawurlencode($returnURL)?>" method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" id="email" value="<?php echo set_value('email')?>" name="email" placeholder="E-mail">
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" id="password" name="password" placeholder="password">
					</div>

					<div class="form-group">
						<input type="submit" value="Login" class="btn float-right login_btn">
					</div>
				</form>

			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="/index.php/auth/register">Sign Up</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="/index.php/auth/pre_find">Forgot your password?</a>
				</div>
			</div>
		</div>
	</div>
</div>
