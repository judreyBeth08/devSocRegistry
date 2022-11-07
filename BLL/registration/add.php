<?php

//include all necessary resource files
include '../../config/database.php';
include '../../classes/registration.php';

//create a new object for accessing connection to the database
$database = new Database();
$db = $database->getConnection();

//create new object for accessing business layer logics
$reg = new Registration($db);

if ($_POST) {

	/* -------------------------  code for creating new entry ------------------------- */
	if (empty($_POST['regID'])) {
		$reg->firstname = ucwords(trim(preg_replace('/\s+/', ' ', $_POST['firstname'])));
		$reg->lastname = ucwords(trim(preg_replace('/\s+/', ' ', $_POST['lastname'])));
		$reg->school = trim(ucwords($_POST['school']));
		$reg->grade = trim(ucwords($_POST['grade']));
		$reg->phone = ltrim($_POST['phone']);
		$reg->email = strtolower(trim($_POST['email']));
		$reg->regDate = $_POST['regDate'];
		if ($reg->nameCheck()->rowCount() < 1) {
			$reg->add();
			echo '<script type="text/javascript">alert("You have been successfully added into our database");</script>';
		}else{
			echo '<script type="text/javascript">alert("Name Duplicate is found in our database");</script>';
			echo '<script type="text/javascript">alert("Name not added");</script>';
		}
	}
	/* -------------------------  code for updating existing entry ------------------------- */
	else{
		$reg->regID = $_POST['regID'];
		$reg->firstname = ucwords(trim(preg_replace('/\s+/', ' ', $_POST['firstname'])));
		$reg->lastname = ucwords(trim(preg_replace('/\s+/', ' ', $_POST['lastname'])));
		$reg->school = trim(ucwords($_POST['school']));
		$reg->grade = trim(ucwords($_POST['grade']));
		$reg->phone = ltrim($_POST['phone']);
		$reg->email = strtolower(trim($_POST['email']));
		$reg->regDate = $_POST['regDate'];
		$reg->update();
		echo '<script type="text/javascript">alert("Registrant information has been successfully updated");</script>';
	}

	if(isset($_GET['page']) && !empty($_GET['page'])){
		$currentPage = $_GET['page'];
	}else{
		$currentPage = 1;
	}

	//limits how many items can be seen on table
	$limit = $reg->limit = 5;

	//computes for the offset
	$reg->offset = $start = ($currentPage * $limit) - $limit;

	//variables for pages
	$first = 1;								//initiates first page
	$next = $currentPage + 1;				//computes the next page based from current
	$next2 = $currentPage + 2;				//computes page 2 pages after current
	$previous = $currentPage - 1;			//computes the previous page based from current
	$previous2 = $currentPage - 2;			//computes page 2 pages before current
	$last = ceil( ($reg->viewAll()->rowCount()) / $limit);

	$stmt = $reg->pagination();
	$results = $stmt->rowCount();
	include 'regTable.php';
	echo '
<script type="text/javascript">

	/* ---------------- Script for searching parent ---------------- */
	$("#search").on("submit", function(event){
		event.preventDefault();

		$.ajax({
			url:"bll/system/search.php",
			method: "POST",
			data: $("#search").serialize(),

			success:function(data){
				$("#content").html(data);
			}
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
                        url:"bll/system/delete.php",
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
	';

}
?>