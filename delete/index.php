<?php 
    include "config.php";
?>
<!doctype html>
<html>
    <head>
        <title>Confirmation alert Before Delete record with jQuery AJAX</title>
        <link href='style.css' rel='stylesheet' type='text/css'>
        <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js'></script> 
		
		
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src='bootbox.min.js'></script>
        <script src='script.js' type='text/javascript'></script>
    </head>
    <body>
        
        <div class='container'>
            <table border='1' class='table' >
                <tr style='background: whitesmoke;'>
                    <th>S.no</th>
                    <th>Title</th>
                    <th>Operation</th>
                </tr>

                <?php 
                $query = "SELECT * FROM users";
                $result = mysqli_query($con,$query);

                $count = 1;
                while($row = mysqli_fetch_assoc($result) ){
                    $id = $row['id'];
                    $title = $row['last_name'];
                    $link = $row['first_name'];

                ?>
                    <tr>
                        <td align='center'><?= $count ?></td>
                        <td><a href='<?= $link ?>' target='_blank'><?= $title ?></a></td>
                        <td align='center'><button class='delete btn btn-danger' id='del_<?= $id ?>' data-id='<?= $id ?>'>Delete</button></td>
                    </tr>
                <?php
                    $count++;
                }
                ?>
            </table>
        </div>
    </body>
</html>