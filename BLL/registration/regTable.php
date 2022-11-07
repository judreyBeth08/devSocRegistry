<?php
echo '
	<table class="table table-striped bg-dark text-light mt-3" >
		<thead>
			<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
			<tr>
				<th colspan="4">
					<h4>
						Registration List
                		<input type="button" class="btn btn-primary addReg" data-toggle="modal" data-target="#regModal" value="Register">
						<input type="button" class="btn btn-danger" name="btnDelete" id="btnDelete" value="Delete"/>
					</h4>
				</th>
				<th colspan="3">
		            <form method="POST" id="search" name="search" class="row">
		                <h5 class="mr-2 form-inline">Search</h5>
		                <input type="text" name="keyword" id="keyword" class="form-control col-sm-7 mr-2 form-inline">
		                <input type="submit" name="search" id="search" value="Search" class="form-control btn btn-primary col-sm-2 form-inline">
		            </form>
				</th>
			</tr>
			<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
			<tr>
				<th width="1%">
					<input type="checkbox" id="checkBoxAll" />
				</th>
				<th width="24%">Name</th>
				<th width="15%">School & Yr</th>
				<th width="15%">Phone</th>
				<th width="15%">Email</th>
				<th width="15%">Registration Date</th>
				<th width="15%">Action</th>
			</tr>
		</thead>
		<tbody>';

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		echo'
			<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
			<tr>
				<td>
					<input type="checkbox" class="chkCheckBoxId" value="'.$row['regID'].'" />
				</td>
				<td>
					'.$row['lastname'].', '.$row['firstname'].'
				</td>
				<td>
					'.$row['school'].' - '.$row['grade'].'
				</td>
				<td>
					'.$row['phone'].'
				</td>
				<td>
					'.$row['email'].'
				</td>
				<td>
					'.$row['regDate'].'
				</td>
				<td>
            		<input class="btn btn-info fillData" type="button" name="edit" id="'.$row['regID'].'" value="Edit">
				</td>
			</tr>';
		}


			echo'
		</tbody>
	</table>
';

if ($results >= $limit) {
    echo'
    <nav aria-label="Page navigation">
        <ul class="pagination">';

            //if current page is not equal to first 
            if($currentPage != $first) { 
                //then print pagination for jump to first
                echo'
                <li class="page-item">
                    <a class="page-link" href="?page='.$first.'" tabindex="-1" aria-label="Previous">
                        <span aria-hidden="true"> << </span>
                    </a>
                </li>';
            } 

            //if current page is more than 2
            if ($currentPage >= 2) {
                //if the previous page is not equal first page 
                if ($previous != $first) {
                    //then print pagination for page 2 pages before current
                    echo'
                    <li class="page-item">
                        <a class="page-link" href="?page='.$previous2.'">
                            '.$previous2.'
                        </a>
                    </li>';
                }
                //then print pagination for page before current
                echo'
                <li class="page-item">
                    <a class="page-link" href="?page='.$previous.'">
                        '.$previous.'
                    </a>
                </li>';
            }

            //print pagination for current page
            echo'
            <li class="page-item active">
                <a class="page-link" href="?page='.$currentPage.'">
                    '.$currentPage.'
                </a>
            </li>';

            //if current page is not equal to last page
            if($currentPage != $last) { 
            //then print pagination for the next page
            echo'
            <li class="page-item">
                <a class="page-link" href="?page='.$next.'">
                    '.$next.'
                </a>
            </li>';

            //if next page is not equal to last page
            if ($next != $last) { 
            //then print pagination for page 2 pages after current
            echo'
            <li class="page-item">
                <a class="page-link" href="?page='.$next2.'">
                    '.$next2.'
                </a>
            </li>';
            } 

            //then print pagination for jumping to last  page
            echo'
            <li class="page-item">
                <a class="page-link" href="?page='.$last.'" aria-label="Next">
                    <span aria-hidden="true"> >> </span>
                </a>
            </li>';
            }

        echo'
        </ul>
    </nav>
    ';
}
?>
