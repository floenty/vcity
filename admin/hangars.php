<?php
require("core.php");
head();


if (isset($_GET['delete-id'])) {
    $id    = (int) $_GET["delete-id"];
    $query = mysqli_query($connect, "DELETE FROM `hangars` WHERE id='$id'");
}
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div id="content-container">
				
				<section class="content-header">
    			  <h1><i class="fas fa-plane"></i> Hangars</h1>
    			  <ol class="breadcrumb">
   			         <li><a href="dashboard.php"><i class="fas fa-Hangar"></i> Admin Panel</a></li>
    			     <li class="active">Hangars</li>
    			  </ol>
    			</section>


				<!--Page content-->
				<!--===================================================-->
				<section class="content">

<?php
if (isset($_POST['add'])) {
    $image    = $_POST['image'];
    $money    = $_POST['money'];
    $gold     = $_POST['gold'];
	$diamond  = $_POST['diamond'];
    $respect  = $_POST['respect'];
    $minlevel = $_POST['minlevel'];
    $vip      = $_POST['vip'];
    $max      = $_POST['max'];
    
    $query = mysqli_query($connect, "INSERT INTO `hangars` (image, money, gold, diamond, respect, min_level, vip, max_vehicles) VALUES ('$image', '$money', '$gold', '$diamond', '$respect', '$minlevel', '$vip', '$max')");
}
?>
                    
                <div class="row">
				<div class="col-md-8">
				
				<?php
if (isset($_GET['edit-id'])) {
    $id  = (int) $_GET["edit-id"];
    $sql = mysqli_query($connect, "SELECT * FROM `hangars` WHERE id = '$id'");
    $row = mysqli_fetch_assoc($sql);
    if (empty($id)) {
        echo '<meta http-equiv="refresh" content="0; url=hangars.php">';
    }
    if (mysqli_num_rows($sql) == 0) {
        echo '<meta http-equiv="refresh" content="0; url=hangars.php">';
    }
    
    if (isset($_POST['edit'])) {
        $image    = $_POST['image'];
        $money    = $_POST['money'];
        $gold     = $_POST['gold'];
		$diamond  = $_POST['diamond'];
        $respect  = $_POST['respect'];
        $minlevel = $_POST['minlevel'];
        $vip      = $_POST['vip'];
        $max      = $_POST['max'];
        
        $query = mysqli_query($connect, "UPDATE `hangars` SET `image`='$image', `money`='$money', `gold`='$gold', `diamond`='$diamond', `respect`='$respect', `min_level`='$minlevel', `vip`='$vip', `max_vehicles`='$max' WHERE id='$id'");
        echo '<meta http-equiv="refresh" content="0; url=hangars.php">';
        
    }
?>
<form class="form-horizontal" action="" method="post">
                     <div class="box">
						<div class="box-header">
							<h3 class="box-title">Edit Hangar</h3>
						</div>
				        <div class="box-body">
								<div class="form-group">
											<label class="col-sm-3 control-label">Image: </label>
											<div class="col-sm-9">
												<input type="text" name="image" class="form-control" value="<?php
    echo $row['image'];
?>" required>
											</div>
								</div>
								<div class="form-group">
											<label class="col-sm-3 control-label">Money Price: </label>
											<div class="col-sm-9">
												<input type="number" name="money" min="0" class="form-control" value="<?php
    echo $row['money'];
?>" required>
											</div>
								</div>
								<div class="form-group">
											<label class="col-sm-3 control-label">Gold Price: </label>
											<div class="col-sm-9">
												<input type="number" name="gold" min="0" class="form-control" value="<?php
    echo $row['gold'];
?>" required>
											</div>
								</div>
								<div class="form-group">
											<label class="col-sm-3 control-label">Diamond Price: </label>
											<div class="col-sm-9">
												<input type="number" name="diamond" min="0" class="form-control" value="<?php
    echo $row['diamond'];
?>" required>
											</div>
								</div>
								<div class="form-group">
											<label class="col-sm-3 control-label">Respect Bonus: </label>
											<div class="col-sm-9">
												<input type="number" name="respect" min="0" class="form-control" value="<?php
    echo $row['respect'];
?>" required>
											</div>
								</div>
								<div class="form-group">
											<label class="col-sm-3 control-label">Maximum Vehicles: </label>
											<div class="col-sm-9">
												<input type="number" name="max" min="0" class="form-control" value="<?php
    echo $row['max_vehicles'];
?>" required>
											</div>
								</div>
								<div class="form-group">
											<label class="col-sm-3 control-label">Minimum Level: </label>
											<div class="col-sm-9">
												<input type="number" name="minlevel" min="0" class="form-control" value="<?php
    echo $row['min_level'];
?>" required>
											</div>
								</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">VIP Only: </label>
											<div class="col-sm-9">
	<select name="vip" class="form-control" required>
        <option value="No" <?php
    if ($row['vip'] == 'No') {
        echo 'selected';
    }
?>>No</option>
        <option value="Yes" <?php
    if ($row['vip'] == 'Yes') {
        echo 'selected';
    }
?>>Yes</option>
    </select>
	                                         </div>
										</div>
                        </div>
                        <div class="panel-footer">
							<button class="btn btn-flat btn-success" name="edit" type="submit">Save</button>
				            <button type="reset" class="btn btn-flat btn-default">Reset</button>
				        </div>
				     </div>
</form>
<?php
}
?>
				
				    <div class="box">
						<div class="box-header">
							<h3 class="box-title">Hangars</h3>
						</div>
						<div class="box-body">
<table id="dt-basic" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>ID</th>
											<th>Hangar</th>
											<th>Money Price</th>
											<th>Gold Price</th>
											<th>Diamond Price</th>
											<th>Minimum Level</th>
                                            <th>Respect Bonus</th>
                                            <th>Maximum Vehicles</th>								
											<th>VIP Only</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
<?php
$query = mysqli_query($connect, "SELECT * FROM `hangars`");
while ($row = mysqli_fetch_assoc($query)) {
    echo '
										<tr>
											<td>' . $row['id'] . '</td>
                                            <td><center><img src="../' . $row['image'] . '" width="80px" height="50px"></center></td>
											<td>' . $row['money'] . '</td>
											<td>' . $row['gold'] . '</td>
											<td>' . $row['diamond'] . '</td>
											<td>' . $row['min_level'] . '</td>
											<td>' . $row['respect'] . '</td>
											<td>' . $row['max_vehicles'] . '</td>
											<td>' . $row['vip'] . '</td>
											<td>
                                            <a href="?edit-id=' . $row['id'] . '" class="btn btn-flat btn-flat btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="?delete-id=' . $row['id'] . '" class="btn btn-flat btn-flat btn-danger"><i class="fas fa-trash"></i> Delete</a>
											</td>
										</tr>
';
}
?>
									</tbody>
								</table>
                        </div>
                     </div>
                </div>
                    
				<div class="col-md-4">
<form class="form-horizontal" action="" method="post">
				     <div class="box">
						<div class="box-header">
							<h3 class="box-title">Add Hangar</h3>
						</div>
				        <div class="box-body">
								<div class="form-group">
											<label class="col-sm-4 control-label">Image: </label>
											<div class="col-sm-8">
												<input type="text" name="image" class="form-control" placeholder="images/backgrounds/hangars/" required>
											</div>
								</div>
								<div class="form-group">
											<label class="col-sm-4 control-label">Money Price: </label>
											<div class="col-sm-8">
												<input type="number" name="money" min="0" class="form-control" value="" required>
											</div>
								</div>
								<div class="form-group">
											<label class="col-sm-4 control-label">Gold Price: </label>
											<div class="col-sm-8">
												<input type="number" name="gold" min="0" class="form-control" value="" required>
											</div>
								</div>
								<div class="form-group">
											<label class="col-sm-4 control-label">Diamond Price: </label>
											<div class="col-sm-8">
												<input type="number" name="diamond" min="0" class="form-control" value="" required>
											</div>
								</div>
								<div class="form-group">
											<label class="col-sm-4 control-label">Minimum Level: </label>
											<div class="col-sm-8">
												<input type="number" name="minlevel" min="0" class="form-control" value="" required>
											</div>
								</div>
								<div class="form-group">
											<label class="col-sm-4 control-label">Respect Bonus: </label>
											<div class="col-sm-8">
												<input type="number" name="respect" min="0" class="form-control" value="" required>
											</div>
								</div>
								<div class="form-group">
											<label class="col-sm-4 control-label">Maximum Vehicles: </label>
											<div class="col-sm-8">
												<input type="number" name="max" min="0" class="form-control" value="" required>
											</div>
								</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">VIP Only: </label>
											<div class="col-sm-8">
	<select name="vip" class="form-control" required>
        <option value="No" selected>No</option>
        <option value="Yes">Yes</option>
    </select>
											</div>
										</div>
                        </div>
                        <div class="panel-footer">
							<button class="btn btn-flat btn-primary" name="add" type="submit">Add</button>
							<button type="reset" class="btn btn-flat btn-default">Reset</button>
				        </div>
				     </div>
</form>

				</div>
				</div>
                    
				</div>
				<!--===================================================-->
				<!--End page content-->


			</div>
			<!--===================================================-->
			<!--END CONTENT CONTAINER-->

<script>
$(document).ready(function() {

	$('#dt-basic').dataTable( {
		"responsive": true,
		"language": {
			"paginate": {
			  "previous": '<i class="fas fa-angle-left"></i>',
			  "next": '<i class="fas fa-angle-right"></i>'
			}
		}
	} );
} );
</script>
<?php
footer();
?>