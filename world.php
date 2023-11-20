<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Check if 'country' parameter is set
if(isset($_GET['country'])) {
    // Sanitize the input to prevent SQL injection
    $country = filter_input(INPUT_GET, 'country', FILTER_SANITIZE_STRING);
    

    if (isset($_GET['lookup']) && $_GET['lookup'] === 'cities') {
      $stmt = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code = countries.code WHERE countries.name LIKE '%$country%'");
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // var_dump($results);
      $html_results = '<table>';
      $html_results .= '<tr>';
    
        $html_results .='<th>Name</th>';
        $html_results .='<th >District</th>';
        $html_results .='<th >Population</th>';
      $html_results .= '</tr>';

     foreach ($results as $row){


      $html_results .= '<tr>';
      $html_results .= '<td>' . $row['name'] . '</td>';
      $html_results .= '<td>' . $row['district'] . '</td>';
      $html_results .= '<td>' . $row['population'] . '</td>';
      $html_results .= '</tr>';
     }
     $html_results .= '</table>';
     echo json_encode($html_results);
    }
    else
{
$stmt1 = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%';");
$results = $stmt1->fetchAll(PDO::FETCH_ASSOC);
// Fetch data for the specified country
// Generate HTML table
$html_results = '<table>';
    $html_results .= '<tr>';
        $html_results .= '<th>Country Name</th>';
        $html_results .= '<th>Continent</th>';
        $html_results .= '<th>Independence Year</th>';
        $html_results .= '<th>Head of State</th>';
        $html_results .= '</tr>';

    foreach ($results as $row) {
    $html_results .= '<tr>';
        $html_results .= '<td>' . $row['name'] . '</td>';
        $html_results .= '<td>' . $row['continent'] . '</td>';
        $html_results .= '<td>' . $row['independence_year'] . '</td>';
        $html_results .= '<td>' . $row['head_of_state'] . '</td>';
        $html_results .= '</tr>';
    }

    $html_results .= '</table>';

// Output JSON response and stop further execution
echo json_encode($html_results);

}






exit;
}
?>