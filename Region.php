<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Region</title>
</head>
<body>

</body>
</html>
<?php

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

$sql = "
SELECT
  addressId,
  sum(salary) AS totalSalary
FROM employees
  WHERE addressId NOT in (3025,1001)
GROUP BY addressId
HAVING sum(salary) > 1000000;";

echo $sql;

$result = $conn->query($sql);
echo '<hr>';

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "address Id: " . $row["addressId"]
            . " - Salary: "
            . $row["totalSalary"]
            . "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>