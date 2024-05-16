<?php

use MongoDB\Driver\Manager;
use MongoDB\Driver\Query;
use MongoDB\Driver\Exception\Exception as MongoDBException;

// Replace the placeholder with your MongoDB connection string
$uri ='mongodb://localhost:27017';
try {
    // Create a new MongoDB driver manager instance
    $manager = new Manager($uri);
$
    // Specify  n 
    // Build the query to fetch all documents
    $query = new Query([]);

    // Execute the query
    $cursor = $manager->executeQuery("$database.$collection", $query);

    // Begin table
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