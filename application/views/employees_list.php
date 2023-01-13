<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2>Employees List</h2>
    <!-- <p>Type something in the input field to search the table for first names, last names or emails:</p>   -->
    <div class="row">
        <div class="col-md-3">
            <input class="form-control" id="myInput" type="text" placeholder="Search by EmpId or Emp Name">
        </div>
    </div>
    <div  class="row">
        <div class="col-md-3">
            <label>Filter</label>
            <select class="form-control role">
                <?php foreach($roles as $key => $role): ?>
                    <option>--Select--</option>
                    <optgroup label="<?php echo ($key == 'team_leader') ? 'TEAM LEADER': strtoupper($key); ?>"></optgroup>
                    <?php foreach($role as $key => $row): ?>
                        <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped" id="myTable">
            <thead>
                <tr>
                    <th>Emp Id</th>
                    <th>Emp Name</th>
                    <th>Emp Role</th>
                    <th>Added Date</th>
                    <th>Emp Status</th>
                </tr>
            </thead>
            <tbody id="myRows">
                <?php foreach($employees as $row): ?>
                    <tr>
                        <td><?php echo $row->id ?></td>
                        <td><?php echo $row->name ?></td>
                        <td><?php echo $row->role ?></td>
                        <td><?php echo $row->date ?></td>
                        <td><button style="cursor: pointer;" class="change_status" data-id="<?php echo $row->id ?>" data-status="<?php echo $row->status ?>"><?php echo ($row->status == 1) ? 'Active' : 'In-Active' ?></button></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
        </div>
    </div>
  <!-- <p>Note that we start the search in tbody, to prevent filtering the table headers.</p> -->
</div>

<script>
// $(document).ready(function(){
//   $("#myInput").on("keyup", function() {
//     var value = $(this).val().toLowerCase();
//     $("#myTable tr").filter(function() {
//       $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
//     });
//   });
// });

// function myFunction() {
//   // Declare variables 
//   var input, filter, table, tr, td, i;
//   input = document.getElementById("myInput");
//   filter = input.value.toUpperCase();
//   table = document.getElementById("myTable");
//   tr = table.getElementsByTagName("tr");

//   // Loop through all table rows, and hide those who don't match the search query
//   for (i = 0; i < tr.length; i++) {
//     tdname = tr[i].getElementsByTagName("td")[0];
//     tdrole = tr[i].getElementsByTagName("td")[1];
//     if (tdname || tdrole) {
//       if ((tdname.innerHTML.toUpperCase().indexOf(filter) > -1) || (tdrole.innerHTML.toUpperCase().indexOf(filter) > -1)) {
//         tr[i].style.display = "";
//       } else {
//         tr[i].style.display = "none";
//       }
//     } 
//   }
// }

$(document).ready(function(){
    baseUrl = "<?php echo base_url(); ?>";
    $("#myInput").on("keyup", function() {
        var value = $(this).val();
        //console.log(baseUrl);
        $.ajax({
        url: baseUrl+"index.php/Welcome/get_filter",
        type : "POST",
        data : {value:value},
        cache: true,
        beforeSend: function() {
            // setting a timeout
            $("#myRows").html('loading...');
        },
        success: function(html){
            html = JSON.parse(html);
            $("#myRows").html(html);
        }
        });
    });

    $(".role").on("change", function() {
        var value = $(this).val();
        console.log(value);
        $.ajax({
        url: baseUrl+"index.php/Welcome/get_rep_emp",
        type : "POST",
        data : {value:value},
        cache: true,
        beforeSend: function() {
            // setting a timeout
            $("#myRows").html('loading...');
        },
        success: function(html){
            html = JSON.parse(html);
            $("#myRows").html(html);
        }
        });
    });
    
    $(".change_status").on("click", function() {
        var value = $(this).attr('data-id');
        var status = $(this).attr('data-status');
        //console.log(value);
        $.ajax({
        url: baseUrl+"index.php/Welcome/change_status",
        type : "POST",
        data : {value:value, status:status},
        cache: true,
        beforeSend: function() {
            // setting a timeout
            //$("#myRows").html('loading...');
        },
        success: function(html){
            // html = JSON.parse(html);
            // $("#myRows").html(html);
            location.reload();
        }
        });
    });
});
</script>

</body>
</html>
