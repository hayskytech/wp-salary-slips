<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/form.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/table.min.css">

<?php
global $wpdb;
$code       = $_POST["code"];
$username    = $_POST["username"];
$phone       = $_POST["phone"];
$email       = $_POST["email"];
$father      = $_POST["father"];
$address     = $_POST["address"];
$gender      = $_POST["gender"];
$salary      = $_POST["salary"];
$role        = $_POST["role"];
$pan         = $_POST["pan"];
$bankac      = $_POST["bankac"];
$ifsc        = $_POST["ifsc"];
$start_date  = $_POST["start_date"];
if(isset($_POST["add"])){
    $result = $wpdb->insert( 'employees', 
                	array( 
                		'code'      => $code,
                        'name'      => $username,
                        'phone'     => $phone,
                        'email'     => $email,
                        'father'    => $father,
                        'address'   => $address,
                        'gender'    => $gender,
                        'salary'    => $salary,
                        'role'      => $role,
                        'pan'       => $pan,
                        'bankac'    => $bankac,
                        'ifsc'      => $ifsc,
                        'start_date'=> $start_date
                	)
                );
                
    //$wpdb->show_errors();
    //$wpdb->print_error();
}
if(isset($_POST["save"])){
    $result = $wpdb->update( 'employees', 
                	array( 
                        'code'      => $code,
                        'name'      => $username,
                        'phone'     => $phone,
                        'email'     => $email,
                        'father'    => $father,
                        'address'   => $address,
                        'gender'    => $gender,
                        'salary'    => $salary,
                        'role'      => $role,
                        'pan'       => $pan,
                        'bankac'    => $bankac,
                        'ifsc'      => $ifsc,
                		'start_date'=> $start_date ),
                	array('id' => $_POST["save_id"])
                );
}
$employees = $wpdb->get_results("SELECT * FROM employees ORDER BY code ASC");

?>


<h1 style="text-align: center;">List of employees</h1>
<table class="ui celled table">
	<thead>
	<tr>
		<th>Code</th>
		<th>Name</th>
		<th>Salary</th>
        <th>Designation</th>
        <th>PAN & Bank Acc</th>
        <th>Data of joining</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	</thead>
<?php
foreach($employees as $employee){
    echo '<tr>
    		<td>'.$employee->code.'</td>
    		<td>'.$employee->name.'<br>
    		    '.$employee->phone.'<br>
                '.$employee->email.'</td>
    		<td>'.$employee->salary.'</td>
            <td>'.$employee->role.'</td>
            <td>'.$employee->pan.'<br>
                '.$employee->bankac.'<br>
                '.$employee->ifsc.'</td>
    		<td>'.$employee->start_date.'</td>
    		<td><form method="POST" action="">
    		        <input type="hidden" name="edit_id" value="'.$employee->id.'">
    		        <input type="submit" name="edit" value="Edit">
    		    </form>
    		</td>
    		<td><form method="post">
    		        <input type="hidden" name="delete_id" value="'.$employee->id.'">
    		        <input type="submit" name="delete" value="Delete">
    		    </form>
    		</td>
    	</tr>';
}
?>
</table>
<hr>
<?php
if($result){
    echo 'Employee added successfully';
}
$edit_id = $_POST['edit_id'];

$edit = $wpdb->get_row( "SELECT * FROM employees WHERE id = $edit_id" );

?>
<form action="" method="POST">
    <input type="hidden" name="save_id" value="<?php echo $edit_id; ?>">
    <table>
        	<tr>
        		<th>Code</th><th><input type="text" name="code" value="<?php echo $edit->code; ?>"></th>
        		<th>Username</th><th><input type="text" name="username" value="<?php echo $edit->name; ?>"></th>
        	</tr>
            <tr>
                <th>Phone</th><th><input type="text" name="phone" value="<?php echo $edit->phone; ?>"></th>
                <th>Email</th><th><input type="email" name="email" value="<?php echo $edit->email; ?>"></th>
            </tr>
            <tr>
                <th>Father</th><th><input type="text" name="father" value="<?php echo $edit->father; ?>"></th>
                <th>Address</th><th><input type="text" name="address" value="<?php echo $edit->address; ?>"></th>
            </tr>
            <tr>
                <th>Gender</th><th><input type="text" name="gender" value="<?php echo $edit->gender; ?>"></th>
        	</tr>
            <tr>
                <th>Salary</th><th><input type="text" name="salary" value="<?php echo $edit->salary; ?>"></th>
                <th>Role</th><th><input type="text" name="role" value="<?php echo $edit->role; ?>"></th>
            </tr>
            <tr>
                <th>PAN</th><th><input type="text" name="pan" value="<?php echo $edit->pan; ?>"></th>
                <th>Bank Acc</th><th><input type="text" name="bankac" value="<?php echo $edit->bankac; ?>"></th>
            </tr>
            <tr>
                <th>IFSC</th><th><input type="text" name="ifsc" value="<?php echo $edit->ifsc; ?>"></th>
            	<th>Start Date</th><th><input type="date" name="start_date" value="<?php echo $edit->start_date; ?>"></th>
        	</tr>
        	<tr>
        		<th></th>
        		<th>
        		    <?php
    		        if($_POST["edit_id"]){
    		            echo '<input type="submit" name="save" value="Save">';
    		        } else {
    		            echo '<input type="submit" name="add" value="Add">';
    		        }
        		    ?>
        		</th>
        	</tr>
    </table>
</form>
<?php 
?>