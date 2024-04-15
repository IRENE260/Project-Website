<?php
session_start();
$userid=$_SESSION["user_id"];
$studentid=$_SESSION["studentid"];
$con=mysqli_connect("localhost","root","","apoint");
		$sql1="select * from spoint where sid='$studentid'";
		$res=mysqli_query($con,$sql1);
        $value=mysqli_fetch_array($res);

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
                <a href="fhome.php">HOME</a>
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
            <tr>
                <td>1</td>
                <td>N C C </td>
                <td><?php echo $value[1];?></td>
            </tr>
            <tr>
                <td>2</td>
                <td>N S S </td>
                <td><?php echo $value[2];?></td>
            </tr>
            <tr>
                <td>3</td>
                <td>Sports</td>
                <td><?php echo $value[3];?></td>
            </tr>
            <tr>
                <td>4</td>
                <td>ARTS</td>
                <td><?php echo $value[4];?></td>
            </tr>
            <tr>
                <td>5</td>
                <td>TECH FEST,TECH QUIZ</td>
                <td><?php echo $value[5];?></td>
            </tr>
            <tr>
                <td>6</td>
                <td>MOOC</td>
                <td><?php echo $value[6];?></td>
            </tr>
            <tr>
                <td>7</td>
                <td>COMPETITIONS</td>
                <td><?php echo $value[7];?></td>
            </tr>
            <tr>
                <td>8</td>
                <td>WORKSHOP</td>
                <td><?php echo $value[8];?></td>
            </tr>
            <tr>
                <td>9</td>
                <td>PAPER PRESENTATION/PUBLICATION</td>
                <td><?php echo $value[9];?></td>
            </tr>
            <tr>
                <td>10</td>
                <td>POSTER PRESENTATION</td>
                <td><?php echo $value[10];?></td>
            </tr>
            <tr>
                <td>11</td>
                <td>IV/EXHIBITION</td>
                <td><?php echo $value[11];?></td>
            </tr>
            <tr>
                <td>12</td>
                <td>INTERNSHIP</td>
                <td><?php echo $value[12];?></td>
            </tr>
            <tr>
                <td>13</td>
                <td>FOREIGN LANGUAGE SKILL</td>
                <td><?php echo $value[13];?></td>
            </tr>
            <tr>
                <td>14</td>
                <td>START UP</td>
                <td><?php echo $value[14];?></td>
            </tr>
            <tr>
                <td>15</td>
                <td>PATENT FILED</td>
                <td><?php echo $value[15];?></td>
            </tr>
            <tr>
                <td>16</td>
                <td>PATENT PUBLISHED</td>
                <td><?php echo $value[16];?></td>
            </tr>
            <tr>
                <td>17</td>
                <td>PATENT APPROVED</td>
                <td><?php echo $value[17];?></td>
            </tr>
            <tr>
                <td>18</td>
                <td>PATENT LICENSED</td>
                <td><?php echo $value[18];?></td>
            </tr>
            <tr>
                <td>19</td>
                <td>PROTOTYPE DEVELOPED AND TESTED</td>
                <td><?php echo $value[19];?></td>
            </tr>
            <tr>
                <td>20</td>
                <td>AWARDS FOR PRODUCTS DEVELOPED</td>
                <td><?php echo $value[20];?></td>
            </tr>
            <tr>
                <td>21</td>
                <td>INNOVATIVE TECHNOLOGIES</td>
                <td><?php echo $value[21];?></td>
            </tr>
            <tr>
                <td>22</td>
                <td>INNOVATIVE IDEAS/PRODUCTS</td>
                <td><?php echo $value[22];?></td>
            </tr>
            <tr>
                <td>23</td>
                <td>STARTUP EMPLOYEMENT</td>
                <td><?php echo $value[23];?></td>
            </tr>
            <tr>
                <td>24</td>
                <td>SOCIETAL INNOVATIONS</td>
                <td><?php echo $value[24];?></td>
            </tr>
            <tr>
                <td>25</td>
                <td>CORE COORDINATOR</td>
                <td><?php echo $value[25];?></td>
            </tr>
            <tr>
                <td>26</td>
                <td>SUB COORDINATOR</td>
                <td><?php echo $value[26];?></td>
            </tr>
            <tr>
                <td>27</td>
                <td>CHAIRMAN</td>
                <td><?php echo $value[27];?></td>
            </tr>
            <tr>
                <td>28</td>
                <td>SECRETARY</td>
                <td><?php echo $value[28];?></td>
            </tr>
            <tr>
                <td>29</td>
                <td>COUNCIL MEMBERS</td>
                <td><?php echo $value[29];?></td>
            </tr>
            <tr>
                <td>30</td>
                <td>VOLUNTEER</td>
                <td><?php echo $value[30];?></td>
            </tr>
            <tr>
                <th colspan="2">Total Points</th>
                <th><?php echo $value[31];?></th>
            </tr>
    </table>
    
</div>

</body>
</html>