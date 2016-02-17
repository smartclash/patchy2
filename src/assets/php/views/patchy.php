<div id="navigation">
	<?php @include("navigation.php"); ?>
</div>
	
<div id="content">
	<div id="future">
		<h2>Site version goals</h2>
		<table class="table">
			<thead>
				<tr>
					<th>Feature</th>
					<th>Next update</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody id="table_body">
				
			</tbody>
		</table>
	</div>
	<div id="patchy">
		<!--<h2><a href="http://patchy-a.co.nf/" title="Patchy Other">Patchy Global Server</a></h2>-->
		<script type="text/javascript">
		$('#table_body').html('<h2>Please wait...</h2>');
		$(document).ready(function(){
			var url = 'http://patchy-a.co.nf/update_list.php';
			$.get(url, function(response) {
				$('#table_body').html(response);
			});
		});
		</script>
	</div>
</div>