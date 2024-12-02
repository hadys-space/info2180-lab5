<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);



$country = isset($_GET['country'])? trim($_GET['country']): '';

$lookup = isset($_GET['lookup'])? trim($_GET['lookup']): '';

if($lookup == 'cities' && !empty($country)){
  $stmt = $conn->prepare("SELECT cities.name AS city_name, cities.district, cities.population FROM cities 
  JOIN countries ON cities.country_code = countries.code WHERE countries.name LIKE :country");
   $stmt->execute([':country' => "%$country%"]);

   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   echo "<table>
          <thead>
              <tr>
                <th>City Name</th>
                <th>District</th>
                <th>Population</th>      
              </tr>
          </thead>
          <tbody>";

          foreach ($results as $city){
              echo "<tr>
                      <td>{$city['city_name']}</td>
                      <td>{$city['district']}</td>
                      <td>{$city['population']}</td>
                    </tr>";

          }

          echo "</tbody></table>";
  
}else{

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
  }

?>

