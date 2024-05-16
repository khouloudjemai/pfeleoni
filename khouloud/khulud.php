<?php
use MongoDB\Driver\Manager;
use MongoDB\Driver\Query;
use MongoDB\Driver\Exception\Exception as MongoDBException;

// Connexion à la base de données MongoDB (à adapter selon votre configuration)
$mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");

// Requête pour récupérer les données depuis la base de données MongoDB (à adapter selon votre structure de données)
$query = new MongoDB\Driver\Query([]);
$cursor = $mongo->executeQuery('database.esp32', $query);

echo "<table border='1'>";
    
// Iterate over the cursor
echo "<tr>";
foreach ($cursor as $document) {
    // Iterate over each document's keys
    foreach ($document as $key => $value) {
        // Output key as a table header
        echo "<th>$key</th>";
    }
    // Break the loop after the first document
    break;
}
echo "</tr>";

// Iterate over the cursor again to display the data
foreach ($cursor as $document) {
    // Begin table row
    echo "<tr>";
    
    // Iterate over each document's values
    foreach ($document as $value) {
        // Output value as a table cell
        echo "<td>$value</td>";
    }
    
    // End table row
    echo "</tr>";
}

// End table
echo "</table>";
} catch (MongoDBException $e) {
echo "Error: " . $e->getMessage();
}



?>