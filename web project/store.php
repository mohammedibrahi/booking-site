<!DOCTYPE html>
<html>
<head>
    <style>
        body{
            background-color: #999;
            margin: 0;
            padding: 10px;
            
            

        }

    </style>



    <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = new PDO("mysql:host=$servername;dbname=Hotel", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stat=$conn->prepare("select room_number from Room");
    $stat->execute();
    $result = $stat->fetchall();
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<div class="container">
    <h2>booking form</h2>
    <form class="form-horizontal"  action="store.php" method="post">
        <div class="form-group">
            <label class="control-label col-sm-2" for="guestid">Guest id:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="guestid" name="gid" placeholder="Enter guestid" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="guestname">Guest name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="guestname" name="gname" placeholder="Enter guestname" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="age">Age:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="age" name="gage" placeholder="Enter age" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="sel1">Select room number:</label>
            <div class="col-sm-10">
                <select  class="form-control" id="sel1" name="roomnumber">
                    <?php
                    foreach ($result as $row) {
                        echo "<option>" . $row['room_number'] . "</option >" ;
                    }

                    ?>

                </select></div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">add new</button>
                <button type="button" class="btn btn-default"><a style="text-decoration: none" href="tow.php">book aplane</a></button>




            </div>
        </div>


    </form>
</div>
<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $stat1 = $GLOBALS['conn']->prepare("insert into Customer(id,customer_name,age)values (?,?,?)");
    $stat1->execute([$_POST['gid'], $_POST['gname'], $_POST['gage']]);
    $stat2 = $GLOBALS['conn']->prepare("insert into Reservation(customer_id,roomnumber,reservedtime)values (?,?,'CURRENT_TIMESTAMP')");
    $stat2->execute([$_POST['gid'], $_POST['roomnumber']]);

}
?>
</body>
</html>

