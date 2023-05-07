<link rel="stylesheet" type="text/css"
	href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/form.min.css">
<link rel="stylesheet" type="text/css"
	href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/table.min.css">
<h1>Salary slips</h1>
<?php
global $wpdb;
if (isset($_POST["add"])) {
	$result = $wpdb->insert(
		'salary_slips',
		array(
			'name' => $_POST["employee_name"],
			'code' => $_POST["code"],
			'role' => $_POST["role"],
			'pan' => $_POST["pan"],
			'bankac' => $_POST["bankac"],
			'ifsc' => $_POST["ifsc"],
			'date' => $_POST["date_paid"],
			'total_days' => $_POST["total_days"],
			'working_days' => $_POST["working_days"],
			'leaves' => $_POST["leaves"],
			'leaves_taken' => $_POST["leaves_taken"],
			'balance_leaves' => $_POST["balance_leaves"],
			'basic_salary' => $_POST["basic_salary"],
			'dearness' => $_POST["dearness"],
			'rent' => $_POST["rent"],
			'travel' => $_POST["travel"],
			'medical' => $_POST["medical"],
			'total_income' => $_POST["total_income"],
			'pf' => $_POST["pf"],
			'pt' => $_POST["pt"],
			'tds' => $_POST["tds"],
			'total_deductions' => $_POST["total_deductions"],
			'net_salary' => $_POST["net_salary"]
		)
	);
	if ($result) {
		echo 'Added successfully.';
	}
}
?>

<?php $fetchs = $wpdb->get_results("SELECT id,name FROM employees"); ?>
<form method="post">
	<select name="fetch_id" id="fetch_id">
		<?php foreach ($fetchs as $fetch) {
			if ($_POST["fetch_id"] == $fetch->id) {
				$emp = $fetch;
			}
			echo '<option value="' . $fetch->id . '">' . $fetch->name . '</option>';
		} ?>
	</select>
	<input type="submit" name="fetch" value="Fetch">
</form>
<script>
	document.getElementById("fetch_id").value = '<?php echo $_POST["fetch_id"]; ?>';
</script>
<form method="POST" id="myform">
	<table class="ui celled blue table">
		<thead>
			<tr>
				<th colspan="3">Salary slip</th>
				<th>Month</th>
			</tr>
		</thead>
		<tr>
			<td>Employee Name</td>
			<td><input type="text" name="employee_name"></td>
			<td>Date of payment</td>
			<td colspan="2"><input type="date" name="date_paid"></td>
		</tr>
		<tr>
			<td>Employee Code</td>
			<td><input type="text" name="code"></td>
			<td>Total working days</td>
			<td colspan="2"><input type="text" name="total_days"></td>
		</tr>
		<tr>
			<td>Designation</td>
			<td><input type="text" name="role"></td>
			<td>Number of working days attended</td>
			<td colspan="2"><input type="text" name="working_days"></td>
		</tr>
		<tr>
			<td>PAN</td>
			<td><input type="text" name="pan"></td>
			<td>Leaves</td>
			<td><input type="text" name="leaves"></td>
		</tr>
		<tr>
			<td>Bank account Number</td>
			<td><input type="text" name="bankac"></td>
			<td>Leaves taken</td>
			<td><input type="text" name="leaves_taken"></td>
		</tr>
		<tr>
			<td>IFSC code</td>
			<td><input type="text" name="ifsc"></td>
			<td>Balance Leaves</td>
			<td><input type="text" name="balance_leaves"></td>
		</tr>
	</table>

	<table class="ui celled table">
		<tr>
			<td colspan="2">Income</td>
			<td colspan="2">Deductions</td>
		</tr>
		<tr>
			<td>Description</td>
			<td>Amount(Rs.)</td>
			<td>Description</td>
			<td>Amount(Rs.)</td>
		</tr>
		<tr>
			<td>Basic Salary</td>
			<td><input type="text" name="basic_salary" value="0" onchange="income()"></td>
			<td>PF deducted</td>
			<td><input type="text" name="pf" value="0" onchange="deduction()">
			</td>
		</tr>
		<tr>
			<td>Dearness allowance</td>
			<td><input type="text" name="dearness" value="0" onchange="income()">
			</td>
			<td>Proffessional tax</td>
			<td><input type="text" name="pt" value="0" onchange="deduction()">
			</td>
		</tr>
		<tr>
			<td>Rent allowance</td>
			<td><input type="text" name="rent" value="0" onchange="income()">
			</td>
			<td>TDS</td>
			<td><input type="text" name="tds" value="0" onchange="deduction()">
			</td>
		</tr>

		<tr>
			<td>Travel allowance</td>
			<td><input type="text" name="travel" value="0" onchange="income()">
			</td>
			<td></td>
			<td></td>
		</tr>

		<tr>
			<td>Medical allowance
			</td>
			<td><input type="text" name="medical" value="0" onchange="income()">
			</td>
			<td>
			</td>
			<td>
			</td>
		</tr>
		<tr>
			<td>Total</td>
			<td><input type="text" name="total_income" value="0" readonly>
			</td>
			<td>Total</td>
			<td><input type="text" name="total_deductions" value="0" readonly>
			</td>
		</tr>
	</table>

	<br>
	<br>
	<br>

	<table class="ui celled table">
		<tr>
			<td style="text-align: center">Net Salary Payble</td>
			<td><input type="text" name="net_salary" value="0" readonly></td>
		</tr>
		<tr>
			<td>
				signature image
			</td>
			<td>
				signature image
			</td>
		</tr>
		<tr>
			<td>Employee signature</td>
			<td>Employer signature</td>
		</tr>
	</table>
	<input type="submit" name="add" value="Add" class="ui blue button">
</form>
<?php
$id = $_POST["fetch_id"];
$emp = $wpdb->get_row("SELECT * FROM employees WHERE id = $id");
?>
<script>
	function income() {
		var basic_salary = document.getElementById("myform").elements["basic_salary"].value;
		var dearness = document.getElementById("myform").elements["dearness"].value;
		var rent = document.getElementById("myform").elements["rent"].value;
		var travel = document.getElementById("myform").elements["travel"].value;
		var medical = document.getElementById("myform").elements["medical"].value;
		if (basic_salary == '') { basic_salary = 0; }
		if (dearness == '') { dearness = 0; }
		if (rent == '') { rent = 0; }
		if (travel == '') { travel = 0; }
		if (medical == '') { medical = 0; }
		document.getElementById("myform").elements["total_income"].value = parseInt(basic_salary) + parseInt(dearness) + parseInt(rent) + parseInt(travel) + parseInt(medical);
		net_salary();
	}
	function deduction() {

		var pf = document.getElementById("myform").elements["pf"].value;
		var pt = document.getElementById("myform").elements["pt"].value;
		var tds = document.getElementById("myform").elements["tds"].value;

		if (pf == '') { pf = 0; }
		if (pt == '') { pt = 0; }
		if (tds == '') { tds = 0; }

		document.getElementById("myform").elements["total_deductions"].value = parseInt(pf) + parseInt(pt) + parseInt(tds);
		net_salary();
	}
	function net_salary() {

		var income = document.getElementById("myform").elements["total_income"].value;
		var deduction = document.getElementById("myform").elements["total_deductions"].value;


		if (income == '') { income = 0; }
		if (deduction == '') { deduction = 0; }


		document.getElementById("myform").elements["net_salary"].value = parseInt(income) - parseInt(deduction);

	}

	var form = document.getElementById('myform');
	for (var i = 0; i < form.elements.length; i++) {
		if (1) {
			form.elements[i].required = 'yes';
			form.elements[i].setAttribute("onClick", "this.select()");
		}
	}

	<?php
	echo '
document.getElementById("myform").elements["employee_name"].value = "' . $emp->name . '";
document.getElementById("myform").elements["code"].value = "' . $emp->code . '";
document.getElementById("myform").elements["role"].value = "' . $emp->role . '";
document.getElementById("myform").elements["pan"].value = "' . $emp->pan . '";
document.getElementById("myform").elements["bankac"].value = "' . $emp->bankac . '";
document.getElementById("myform").elements["ifsc"].value = "' . $emp->ifsc . '";';

	?>
</script>