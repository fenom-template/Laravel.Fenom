{extends 'app.tpl'}	
{* https://github.com/fenom-template/fenom/blob/master/docs/en/tags/extends.md *}

{block 'content'}
	{* https://github.com/fenom-template/fenom/blob/master/docs/en/tags/extends.md#block *}
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Home</div>

					<div class="panel-body">
						You are logged in!
					</div>
				</div>
			</div>
		</div>
	</div>
{/block}
