<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);



$country = isset($_GET['country'])? trim($_GET['country']): '';

if(!empty($country)){
  $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
  $stmt->execute([':country' => "%$country%"]);
}
else{
  $stmt = $conn->query("SELECT * FROM countries");
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<table>
        <thead>
            <tr>
              <th>Country Name</th>
              <th>Continent</th>
              <th>Independence Year</th>
              <th>Head of State</th>      
            </tr>
        </thead>
        <tbody>";

        foreach ($results as $row){
            echo "<tr>
                    <td>{$row['name']}</td>
                    <td>{$row['continent']}</td>
                    <td>{$row['independence_year']}</td>
                    <td>{$row['head_of_state']}</td>
                  </tr>";

        }

        echo "</tbody></table>";


?>

