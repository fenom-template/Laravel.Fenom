{set $errors = $.errors}
	
{if $errors->any()}  
	{* https://github.com/fenom-template/fenom/blob/master/docs/en/mods/length.md *}
	<div class="alert alert-danger">
		<strong>Whoops!</strong> There were some problems with your input.<br><br>
		<ul>
			{foreach $errors->all() as $error} 
				{* https://github.com/fenom-template/fenom/blob/master/docs/en/tags/foreach.md *}
				<li>{$error}</li>
			{/foreach}
		</ul>
	</div>
{/if}