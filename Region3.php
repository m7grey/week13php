<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        li.highlight {
            color: green;
        }
    </style>
    <title>Region</title>
</head>
<body>

<?php
include "function-library.php";

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "employeedb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$excludeId= getOption("excludeId", 0);
//http://week13:8888/region2.php?excludeId=1002

$sql = "
SELECT
  addressId,
  sum(salary) AS totalSalary
FROM employees
  WHERE addressId NOT in ( $excludeId)
GROUP BY addressId
HAVING sum(salary) > 2000000;";

echo $sql;

$result = $conn->query($sql);

echo "<h1> Region Report</h1>";
echo '<ol>';

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<li class='highlight'>Address Id: " . $row["addressId"]
            . " - Salary: "
            . $row["totalSalary"]
            . "</li>";
    }
} else {
    echo "0 results";
}
echo '<ol>';
$conn->close();
?>

</body>
</html>
