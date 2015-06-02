{extends 'app.tpl'}	
{* https://github.com/fenom-template/fenom/blob/master/docs/en/tags/extends.md *}

{block 'content'}
	{* https://github.com/fenom-template/fenom/blob/master/docs/en/tags/extends.md#block *}
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Reset Password</div>
					<div class="panel-body">
						{insert 'auth/errors.tpl'}
								{* https://github.com/fenom-template/fenom/blob/master/docs/en/tags/include.md#insert *}

						<form class="form-horizontal" role="form" method="POST" action="{url('/password/reset')}">
							<input type="hidden" name="_token" value="{csrf_token()}">
							<input type="hidden" name="token" value="{$token}">

							<div class="form-group">
								<label class="col-md-4 control-label">E-Mail Address</label>
								<div class="col-md-6">
									<input type="email" class="form-control" name="email" value="{old('email')}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Password</label>
								<div class="col-md-6">
									<input type="password" class="form-control" name="password">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Confirm Password</label>
								<div class="col-md-6">
									<input type="password" class="form-control" name="password_confirmation">
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										Reset Password
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
{/block}

