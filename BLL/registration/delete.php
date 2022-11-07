<?php

//include all necessary resource files
include '../../config/database.php';
include '../../classes/registration.php';

//create a new object for accessing connection to the database
$database = new Database();
$db = $database->getConnection();

//create new object for accessing business layer logics
$reg = new Registration($db);
$stmt = $reg->viewAll();


if (isset($_POST['id'])) {
	foreach($_POST["id"] as $id){
		$reg->regID = $id;
		$reg->delete();
 	}
    echo '<script type="text/javascript">alert("Registrant has been successfully deleted from our database");</script>';


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
  $first = 1;               //initiates first page
  $next = $currentPage + 1;       //computes the next page based from current
  $next2 = $currentPage + 2;        //computes page 2 pages after current
  $previous = $currentPage - 1;     //computes the previous page based from current
  $previous2 = $currentPage - 2;      //computes page 2 pages before current
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
      url:"bll/registration/search.php",
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
  ';

}
?>