<?php
session_start();
$userid=$_SESSION["user_id"];
$studentid=$_SESSION["studentid"];
$con=mysqli_connect("localhost","root","","apoint");
		$sql1="select * from spoint where sid='$studentid'";
		$res=mysqli_query($con,$sql1);
        $value=mysqli_fetch_assoc($res);
// var_dump($value);die;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Points Distribution</title>
    <style>
    body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        /* Transparent header */
        .header {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000; /* Ensure header stays on top */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header a {
            margin-right: 20px;
            text-decoration: none;
            color: #333;
        }

        .container {
            margin-top: 100px; /* Add space below the transparent header */
            padding: 20px;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            border: 2px solid #fff; /* Thick border */
            padding: 8px;
            text-align: left;
            border-radius: 8px; /* Rounded corners */
        }

        .table caption {
            caption-side: top;
            font-weight: bold;
            font-size: 24px;
            margin-bottom: 10px;
        }

        /* Color alternate rows */
        .table tr:nth-child(even) td:first-child {
            background-color: #6699cc; /* Darker shade */
        }

        .table tr:nth-child(odd) td:first-child {
            background-color: #adc9e6; /* Lighter shade */
        }
        .header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header a {
            color: #fff;
            text-decoration: none;
            margin-left: 20px;
            margin-right: 20px;
        }

        
    </style>
</head>
<body>
        <div class="header">
            <h1>Points Distribution</h1>
            <div class="navbar">
                <a href="fhome.php">HOME</a>&nbsp;|&nbsp;
                <a href="certificateview.php">BACK</a>
            </div>
        </div>

<div class="container">
    <table class="table">
        <caption>Points Distribution</caption>
        <tr>
                <th>Sl. No</th>
                <th>Category</th>
                <th>Points</th>
            </tr>
            <?php 
            $count=1;
            foreach ($value as $key=>$data){
                if ($data !=0 and $key!='tpoint' and $key!='sid'){
                   echo('<tr><td>'.$count.'</td>');
                   echo('<td>'.$key.'</td>');
                   echo('<td>'.$data.'</td></tr>');
                   $count+=1;
                }
            }?>
            <tr>
                <th colspan="2">Total Points</th>
                <th><?php echo $value['tpoint'];?></th>
            </tr>
    </table>
    
</div>

</body>
</html>