<?php
	include_once "../common/base.php";
	$pageTitle = "View and manage Fields in the database";
	include_once ROOT_PATH."admin/values.php";
	include_once ROOT_PATH."inc/class.fields.inc.php";
	include_once ROOT_PATH."common/header.php";
	$fieldObj = new MLFFields($db);
?>
</head>
<body>
<?php
	include_once ROOT_PATH."common/mainnav.php";
	include_once ROOT_PATH."admin/adminnav.php";
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h1>The listing of all fields</h1>
			<p>All the possible fields of forms</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
	        <table class="table table-condensed table-striped" width="100%">
			<thead>
				<tr>
					<td width="10%">Name</td>
					<td width="8%">Alias</td>
					<td width="22%">Description</td>
					<td width="6%">Group</td>
					<td width="10%">Set</td>
					<td width="8%">Type</td>
					<td width="8%">Value Type</td>
					<td width="12%">Default Value</td>
					<td width="8%">Set CSS Class</td>
					<td width="8%">CSS Class</td>
				</tr>
			</thead>
			<tbody>
				<?php
					$fields = $fieldObj->fetchFields("all");
					
					foreach ($fields as $field) {
						
						$description = $field['fielddescription'];
						if (strlen($description) > 150) {
							$description = substr($description, 0, 150)."...";
						}
						
						echo "<tr><td>"
						."<a href=\"fieldeditor.php?id=".$field['fieldID']."\">".$field['fieldname']. "</a>"
						."</td><td>"
						.$field['fieldalias']."</td><td><span class=\"field-description\">"
						.$description."</span></td><td>"
						.$field['fieldgroup']."</td><td>"
						.$field['fieldset']."</td><td>"
						.$field['fieldtype']."</td><td>"
						.$field['fieldvaluetype']."</td><td>"
						.$field['fielddefaultvalue']."</td><td>"
						.$field['fieldsetclass']."</td><td>"
						.$field['fieldclass']."</td>"
						."</tr>";
					}
					
				?>
			</tbody>
			</table>
		</div>
	</div>
</div>
	<?php include_once(ROOT_PATH."common/footer.php"); ?>
