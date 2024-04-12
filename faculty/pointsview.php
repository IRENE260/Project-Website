<?php
$userid=$_GET["userid"];
$studentid=$_GET["studentid"];
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
    </style>
</head>
<body>

<div class="header">
    <h2>Points Distribution</h2>
    <div>
        <a href="fhome.php?userid=<?php echo $userid; ?>" class="nav-item nav-link active">Home</a>
        <a href="flogin.php" class="nav-item nav-link">Logout</a>
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
                <td>Games</td>
                <td><?php echo $value[4];?></td>
            </tr>
            <tr>
                <td>5</td>
                <td>Music</td>
                <td><?php echo $value[5];?></td>
            </tr>
            <tr>
                <td>6</td>
                <td>Performing arts</td>
                <td><?php echo $value[6];?></td>
            </tr>
            <tr>
                <td>7</td>
                <td>Literary arts</td>
                <td><?php echo $value[7];?></td>
            </tr>
            <tr>
                <td>8</td>
                <td>Tech Fest, Tech Quiz</td>
                <td><?php echo $value[8];?></td>
            </tr>
            <tr>
                <td>9</td>
                <td>MOOC</td>
                <td><?php echo $value[9];?></td>
            </tr>
            <tr>
                <td>10</td>
                <td>Competitions conducted by Professional Societies - (IEEE, IET, ASME, SAE, NASA etc.) </td>
                <td><?php echo $value[10];?></td>
            </tr>
            <tr>
                <td>11</td>
                <td>Attending Full time Conference/Seminars/Exhibitions/Workshop/STTP conducted at IITs/NITs </td>
                <td><?php echo $value[11];?></td>
            </tr>
            <tr>
                <td>12</td>
                <td>Paper presentation/publication at IITs/NITs </td>
                <td><?php echo $value[12];?></td>
            </tr>
            <tr>
                <td>13</td>
                <td>Poster Presentation at IITs /NITs </td>
                <td><?php echo $value[13];?></td>
            </tr>
            <tr>
                <td>14</td>
                <td>Industrial Training/ Internship</td>
                <td><?php echo $value[14];?></td>
            </tr>
            <tr>
                <td>15</td>
                <td>Industrial/Exhibition visits </td>
                <td><?php echo $value[15];?></td>
            </tr>
            <tr>
                <td>16</td>
                <td>Foreign Language Skill (TOFEL/IELTS/BEC exams etc.) </td>
                <td><?php echo $value[16];?></td>
            </tr>
            <tr>
                <td>17</td>
                <td>Start-up Company Registered legally </td>
                <td><?php echo $value[17];?></td>
            </tr>
            <tr>
                <td>18</td>
                <td>Patent-Filed </td>
                <td><?php echo $value[18];?></td>
            </tr>
            <tr>
                <td>19</td>
                <td>Patent - Published </td>
                <td><?php echo $value[19];?></td>
            </tr>
            <tr>
                <td>20</td>
                <td>Patent- Approved </td>
                <td><?php echo $value[20];?></td>
            </tr>
            <tr>
                <td>21</td>
                <td>Patent- Licensed</td>
                <td><?php echo $value[21];?></td>
            </tr>
            <tr>
                <td>22</td>
                <td>Prototype developed and tested </td>
                <td><?php echo $value[22];?></td>
            </tr>
            <tr>
                <td>23</td>
                <td>Awards for Products developed</td>
                <td><?php echo $value[23];?></td>
            </tr>
            <tr>
                <td>24</td>
                <td>Innovative technologies developed and used by industries/users</td>
                <td><?php echo $value[24];?></td>
            </tr>
            <tr>
                <td>25</td>
                <td>Got venture capital funding for innovative ideas/products. </td>
                <td><?php echo $value[25];?></td>
            </tr>
            <tr>
                <td>26</td>
                <td>Startup Employment </td>
                <td><?php echo $value[26];?></td>
            </tr>
            <tr>
                <td>27</td>
                <td>Societal innovations</td>
                <td><?php echo $value[27];?></td>
            </tr>
            <tr>
                <td>28</td>
                <td>Student Professional Societies (IEEE,IET,ASME,SAE,NASA etc.) </td>
                <td><?php echo $value[28];?></td>
            </tr>
            <tr>
                <td>29</td>
                <td>College Association Chapters </td>
                <td><?php echo $value[29];?></td>
            </tr>
            <tr>
                <td>30</td>
                <td>Festival & Technical Events (College approved) </td>
                <td><?php echo $value[30];?></td>
            </tr>
            <tr>
                <td>31</td>
                <td>Hobby Clubs </td>
                <td><?php echo $value[31];?></td>
            </tr>
            <tr>
                <td>32</td>
                <td>Special Initiatives (Approval from College and University is mandatory) </td>
                <td><?php echo $value[32];?></td>
            </tr>
            <tr>
                <td>33</td>
                <td>Elected student representatives </td>
                <td><?php echo $value[33];?></td>
            </tr>
            <tr>
                <th colspan="2">Total Points</th>
                <th><?php echo $value[34];?></th>
            </tr>
    </table>
    
</div>

</body>
</html>
