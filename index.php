<?php
include 'assets/header.php';

//include all necessary resource files
include 'config/database.php';
include 'classes/registration.php';

//create a new object for accessing connection to the database
$database = new Database();
$db = $database->getConnection();

//create new object for accessing business layer logics
$reg = new Registration($db);

if(isset($_GET['page']) && !empty($_GET['page'])){
	$currentPage = $_GET['page'];
}else{
	$currentPage = 1;
}

//limits how many items can be seen on table
$limit = $reg->limit = 5;

//computes for the offset
$reg->offset = $start = ($currentPage * $limit) - $limit;

$results = ($reg->viewAll()->rowCount());

//variables for pages
$first = 1;								//initiates first page
$next = $currentPage + 1;				//computes the next page based from current
$next2 = $currentPage + 2;				//computes page 2 pages after current
$previous = $currentPage - 1;			//computes the previous page based from current
$previous2 = $currentPage - 2;			//computes page 2 pages before current
$last = ceil( $results / $limit);

//sql stmt for viewing on the table
$stmt = $reg->pagination();

?>

<div class="container-fluid content">
	<div class="row">
		<div class="col-md-12">
			<div class="content" id="content" name="content">
				<?php include 'bll/registration/regTable.php';?>
			</div>
		</div>
	</div>
</div>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~ modals ~~~~~~~~~~~~~~~~~~~~ -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<!-- Modal -->
<div class="modal fade" id="regModal" tabindex="-1" role="dialog" aria-labelledby="regModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form method="POST" id="regForm">
				<div class="modal-header">
					<h5 class="modal-title" id="regModalLabel">Registration Form</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="table table-borderless">
						<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
						<tr>
							<th>
								Firstname
							</th>
							<td>
								<input type="text" class="form-control" id="firstname" name="firstname" required>
							</td>
						</tr>
						<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
						<tr>
							<th>
								Lastname
							</th>
							<td>
								<input type="text" class="form-control" id="lastname" name="lastname" required>
							</td>
						</tr>
						<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
						<tr>
							<th>
								School
							</th>
							<td>
								<input type="text" class="form-control" id="school" name="school" required>
							</td>
						</tr>
						<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
						<tr>
							<th>
								Grade
							</th>
							<td>
								<select class="form-control" id="grade" name="grade" required>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
							</td>
						</tr>
						<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
						<tr>
							<th>
								Phone
							</th>
							<td>
								<input type="number" class="form-control" id="phone" name="phone" required>
							</td>
						</tr>
						<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
						<tr>
							<th>
								Email
							</th>
							<td>
								<input type="email" class="form-control" id="email" name="email" required>
							</td>
						</tr>
						<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
						<tr>
							<th>
								Registration Date
							</th>
							<td>
								<input type="date" class="form-control" id="regDate" name="regDate" value="<?php echo date('Y-m-d');?>" required>
								<input type="text" class="form-control" id="regID" name="regID" style="display: none;">
							</td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<input type="submit" name="add" id="add" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
</div>

<?php
include 'assets/footer.php';
?>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~ scripts ~~~~~~~~~~~~~~~~~~~~ -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<script>
	/* ---------------- specifically resets the form ---------------- */
    $(".addReg").click(function(){
    	$('#regForm')[0].reset();
    	$("#add").val("Register");
    });

	/* ---------------- Script for searching ---------------- */
	$("#search").on("submit", function(event){
		event.preventDefault();

		$.ajax({
			url:"bll/registration/search.php",
			method: "POST",
			data: $("#search").serialize(),

			success:function(data){
				$("#content").html(data);
			}
		});
	});

	/* ---------------- Script for adding ---------------- */
	$("#regForm").on("submit", function(event){
		event.preventDefault();

		$.ajax({
			url:"bll/registration/add.php",
			method: "POST",
			data: $("#regForm").serialize(),
			success:function(data){
				$("#regModal").modal('hide');
				$("#regForm")[0].reset();
				$("#content").html(data);
			},
		});
	});

	/* ---------------- Script for editing ---------------- */
      $(document).on('click', '.fillData', function(){  
           var id = $(this).attr("id");  
           $.ajax({  
                url:"bll/registration/fill.php",  
                method:"POST",  
                data:{id:id},  
                dataType:"json",
                success:function(data){  
                	$('#firstname').val(data.firstname);
                	$('#lastname').val(data.lastname);
                	$('#school').val(data.school);
                	$('#grade').val(data.grade);
                	$('#phone').val(data.phone);
                	$('#email').val(data.email);
                	$('#regDate').val(data.regDate);
                	$('#regID').val(data.regID);
                	$('#add').val("Update");
                    $('#regModal').modal('show');  
                }  
           });  
      });  
    
	/* -------------------- script for check all checkbox --------------------- */
	$(document).ready(function() {
		$('#checkBoxAll').click(function() {
			if ($(this).is(":checked"))
				$('.chkCheckBoxId').prop('checked', true);
			else
				$('.chkCheckBoxId').prop('checked', false);
		});
	});

    /* -------------------- script for delete checkbox --------------------- */
    $(document).ready(function(){
        $("#btnDelete").click(function(){
            if(confirm("Are you sure you want to delete this?")){
                var id = [];
                $(":checkbox:checked").each(function(i){
                    id[i] = $(this).val();
                });

                if(id.length === 0){ //tell you if the array is empty   
                    alert("Please Select atleast one checkbox");
                }
                else{
                    $.ajax({
                        url:"bll/registration/delete.php",
                        method:"POST",
                        data:{id:id},
                        success:function(data){
                            $("#content").html(data);
                        }
                    });
                }
            }
            else{
                return false;
            }
        });
    });

</script>