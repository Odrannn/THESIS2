<?php
sleep(1);
session_start();
date_default_timezone_set('Asia/Manila'); // SET TIMEZONE
include('../../../phpfiles/connection.php');
if(isset($_POST['request'])){
    $request = $_POST['request'];

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    } else {
        $_GET['page'] = 1;
        $page = $_GET['page'];
    }
    
    $start = ($page-1) * 10;
    $currentDate = date("Y-m-d");
    
    if($request == 'day'){
        $query = "SELECT * FROM suggestion_table WHERE suggestion_date = '$currentDate' LIMIT $start, 10;";
        $result = $conn -> query($query);
        $count = mysqli_num_rows($result);

        $query1 = "SELECT COUNT(suggestion_ID) AS Total, suggestion_nature FROM suggestion_table WHERE suggestion_date = '$currentDate' GROUP BY suggestion_nature;";
        $result1 = $conn -> query($query1);

        $_SESSION['filter'] = 'day';
    } else if($request == 'week'){
        $query = "SELECT * FROM suggestion_table WHERE WEEK(suggestion_date) = WEEK(now()) LIMIT $start, 10;";
        $result = $conn -> query($query);
        $count = mysqli_num_rows($result);

        $query1 = "SELECT COUNT(suggestion_ID) AS Total, suggestion_nature FROM suggestion_table WHERE WEEK(suggestion_date) = WEEK(now()) GROUP BY suggestion_nature;";
        $result1 = $conn -> query($query1);

        $_SESSION['filter'] = 'week';
    } else if($request == 'month'){
        $query = "SELECT * FROM suggestion_table WHERE MONTH(suggestion_date) = MONTH(now()) LIMIT $start, 10;";
        $result = $conn -> query($query);
        $count = mysqli_num_rows($result);

        $query1 = "SELECT COUNT(suggestion_ID) AS Total, suggestion_nature FROM suggestion_table WHERE MONTH(suggestion_date) = MONTH(now()) GROUP BY suggestion_nature;";
        $result1 = $conn -> query($query1);

        $_SESSION['filter'] = 'month';
    } else if($request == 'year'){
        $query = "SELECT * FROM suggestion_table WHERE YEAR(suggestion_date) = YEAR(now()) LIMIT $start, 10;";
        $result = $conn -> query($query);
        $count = mysqli_num_rows($result);

        $query1 = "SELECT COUNT(suggestion_ID) AS Total, suggestion_nature FROM suggestion_table WHERE YEAR(suggestion_date) = YEAR(now()) GROUP BY suggestion_nature;";
        $result1 = $conn -> query($query1);

        $_SESSION['filter'] = 'year';
    } else if($request == 'all'){
        $query = "SELECT * FROM suggestion_table LIMIT $start, 10;";
        $result = $conn -> query($query);
        $count = mysqli_num_rows($result);

        $query1 = "SELECT COUNT(suggestion_ID) AS Total, suggestion_nature FROM suggestion_table GROUP BY suggestion_nature;";
        $result1 = $conn -> query($query1);

        $_SESSION['filter'] = 'all';
    }

    
?>
<div class="table-responsive" style="width: 100%;">
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            <?php
            while($row1 = $result1 -> fetch_array()){
                ?>
                ['<?php echo $row1[1];?>',    <?php echo $row1[0];?>],
                <?php 
                } ?>
            ['none',    0]
            ]);

            var options = {
            pieHole: 0.4
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
    </script>
    <!--EDIT COMPLAINT-->
    <script>
        $(document).ready(function(){
            $('.editcomplaint').click(function(){
                var userid = $(this).data('id');
                $.ajax({
                url: "edit_complaint_form.php",
                method:'post',
                data: {userid:userid},
                    
                success: function(result){
                    $(".modal-dialog").html(result);
                }});
                $('#editModal').modal('show');
            });
        });
    </script>
    <table class="table table-striped">
        <?php

        if ($count){

        ?>
        <thead>
            <tr class="align-top">
                <th>Suggestion ID</th>
                <th>Official in Charge</th>
                <th>Sender ID</th>
                <th>Nature</th>
                <th>Description</th>
                <th>Date</th>
                <th>Feedback</th>
                <th>Action</th>
            </tr>
        <?php
        } else {
            echo "Sorry! no record Found $request";
        }
        ?>
        </thead>
        <?php 
        
        if(isset($_SESSION['filter'])){
            if($_SESSION['filter']=='day'){
                $currentDate = date("Y-m-d");
                $result1 = $conn -> query("SELECT count(suggestion_ID) as id FROM suggestion_table WHERE suggestion_date = '$currentDate';");
            } else if($_SESSION['filter']=='week'){
                $result1 = $conn -> query("SELECT count(suggestion_ID) as id FROM suggestion_table WHERE WEEK(suggestion_date) = WEEK(now()) LIMIT $start, 10;");
            } else if($_SESSION['filter']=='month'){
                $result1 = $conn -> query("SELECT count(suggestion_ID) as id FROM suggestion_table WHERE MONTH(suggestion_date) = MONTH(now()) LIMIT $start, 10;");
            } else if($_SESSION['filter']=='year'){
                $result1 = $conn -> query("SELECT count(suggestion_ID) as id FROM suggestion_table WHERE YEAR(suggestion_date) = YEAR(now()) LIMIT $start, 10;");
            } else if($_SESSION['filter']=='all'){
                $result1 = $conn -> query("SELECT count(suggestion_ID) as id FROM suggestion_table;");
            }
        } else {
            $result1 = $conn -> query("SELECT count(suggestion_ID) as id FROM suggestion_table;");
        }
        $resCount = $result1->fetch_assoc();
        $total = $resCount['id'];
        $pages = ceil($total / 10);
        
        if($page > 1){
            $previous = $page - 1;
        } else {
            $previous = $page;
        }

        if($page < $pages){
            $next = $page + 1;
        } else {
            $next = $page;
        }
        while($row = $result->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $row["suggestion_ID"]; ?></td>
            <td><?php echo $row["official_ID"]; ?></td>
            <td><?php echo $row["sender_ID"]; ?></td>
            <td><?php echo $row["suggestion_nature"]; ?></td>
            <td><?php echo $row["suggestion_desc"]; ?></td>
            <td><?php echo $row["suggestion_date"]; ?></td>
            <td><?php echo $row["suggestion_feedback"]; ?></td>
            <td><?php echo $row["suggestion_status"]; ?></td>
            <td><div class="btn-group" role="group" aria-label="Basic example">
                <button data-id="<?php echo $row['suggestion_ID']; ?>" class="sendfeedback btn btn-primary"><i class="fa-solid fa-reply"></i></button>
                </div>
            </td>
        </tr>
        <?php } ?>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link text-dark" href="suggestion_management.php?page=<?php echo $previous;?>">Previous</a></li>
            <?php for($i=1; $i<=$pages;$i++)
            {?>
                <li class="page-item"><a class="page-link text-dark" href="suggestion_management.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
            <?php 
            }?>
            <li class="page-item"><a class="page-link text-dark" href="suggestion_management.php?page=<?php echo $next;?>">Next</a></li>
        </ul>
    </nav>
</div>
<?php
} 
?>