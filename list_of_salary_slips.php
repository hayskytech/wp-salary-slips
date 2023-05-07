<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/button.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/table.min.css">

<h2>Salary Slips</h2>
<table class="ui striped table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Salary</th>
			<th>Month & Year</th>
			<th>Download</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
	</thead>
<?php
global $wpdb;
$slips = $wpdb->get_results("SELECT id,name,net_salary,date FROM salary_slips");
foreach($slips as $slip){
    echo '<tr>
	    <td>'.$slip->id.'</td>
		<td>'.$slip->name.'</td>
		<td>'.$slip->net_salary.'</td>
		<td>'.$slip->date.'</td>
	    <td><form method="post">
	            <input type="hidden" name="id" value="'.$slip->id.'">
				<input type="submit" name="view" value="View" class="ui green mini button"></td>
		<td><input type="submit" name="edit" value="Edit" class="ui blue mini button"></td>
		<td><input type="submit" name="delete" value="Delete" class="ui red mini button"></form></td>
	</tr>';

}
?>
</table>
