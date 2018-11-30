<!DOCTYPE html>
<html>
<head>
    <style>
        body{
            background-color: red;

        }

    </style>



    <?php

$servername = "localhost";
$username = "root";
$password = "";
$conn = new PDO("mysql:host=$servername;dbname=Hotel", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stat=$conn->prepare("select customer_name from Customer");
$stat->execute();
$result1 = $stat->fetchall();
$stat1=$conn->prepare("select plan_number from planetrip");
$stat1->execute();
$res = $stat1->fetchall();
?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<div class="container">
    <h2>booking form</h2>
    <form class="form-horizontal"  action="tow.php" method="post">



        <div class="form-group">
            <label class="control-label col-sm-2" for="sel1">Select customer name :</label>
            <div class="col-sm-10">
                <select  class="form-control" id="sel1" name="cname">
                    <?php
                    foreach ($result1 as $row) {
                        echo "<option>" . $row['customer_name'] . "</option >" ;
                    }

                    ?>

                </select></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="sel1">Select plane trip:</label>
            <div class="col-sm-10">
                <select  class="form-control" id="sel1" name="plannumber">
                    <?php
                    foreach ($res as $row) {
                        echo "<option>" . $row['plan_number'] . "</option >" ;
                    }

                    ?>

                </select></div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">add new</button>
                <button type="button" class="btn btn-default"><a style="text-decoration: none" href="store.php">back</a></button>




            </div>
        </div>


    </form>
</div>
<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{

    $stat2 = $GLOBALS['conn']->prepare("insert into booking(plannumber,customerid)values (?,?)");
    $stat3=$conn->prepare("select id from Customer where customer_name= ?");
    $stat3->execute([$_POST['cname']]);
    $ret=$stat3->fetch();
    $cname=$ret[0];

    $stat2->execute([$_POST['plannumber'],$cname]);

}
?>
</body>
</html>
