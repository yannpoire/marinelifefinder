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

<div class="container">
	<div class="row">
		<h1>The listing of all fields</h1>
		<p>All the possible fields of forms</p>
	</div>
	<div class="row">
        <table class="table table-condensed table-striped" width="100%">
		<thead>
			<tr>
				<td width="10%">Name</td>
				<td width="10%">Alias</td>
				<td width="30%">Description</td>
				<td width="10%">Group</td>
				<td width="10%">Set</td>
				<td width="10%">Type</td>
				<td width="10%">Value Type</td>
				<td width="10%">Default Value</td>
			</tr>
		</thead>
		<tbody>
			<?php
				$fields = $fieldObj->fetchFields("all");
				var_dump($fields);
				foreach ($fields as $field) {
					echo "<tr><td>"
					."<a href=\"fieldeditor.php?id=".$field['fieldID']."\">".$field['fieldname']. "</a>"
					."</td><td>"
					.$field['fieldalias']."</td><td>"
					.$field['fielddescription']. "</td><td>"
					.$field['fieldgroup']."</td><td>"
					.$field['fieldset']."</td><td>"
					.$field['fieldtype']."</td><td>"
					.$field['fieldvaluetype']."</td><td>"
					.$field['fielddefaultvalue']."</td>"
					."</tr>";
				}
				
			?>
		</tbody>
		</table>
	</div>
</div>
	<?php include_once(ROOT_PATH."common/footer.php"); ?>
