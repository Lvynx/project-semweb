<?php
function executeSparqlQueryAndGetResults($endpoint, $query) {
    // Initialize cURL
    $ch = curl_init();
    
    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $endpoint);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "query=" . urlencode($query));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/x-www-form-urlencoded"
    ));
    curl_setopt($ch, CURLOPT_HEADER, true); // Get headers

    // Execute cURL request
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
        curl_close($ch);
        return false;
    }

    // Get HTTP response status code
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    // Close cURL
    curl_close($ch);

    if ($httpCode == 200) {
        // Successful response
        list($header, $body) = explode("\r\n\r\n", $response, 2);
        return json_decode($body, true);
    } else {
        // Error response
        echo 'Error: Failed to connect to SPARQL endpoint. HTTP status code: ' . $httpCode;
        return false;
    }
}

function searchRdfData($searchTerm) {
    // Define the SPARQL endpoint URL
    $sparqlEndpoint = "http://localhost:3030/libs/query";

    // Construct the SPARQL query based on the search term
    $sparqlQuery = "
    PREFIX ex: <http://libs.com/>
    PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>

    SELECT ?author ?title ?publisher ?year ?pages ?language
    WHERE {
      ?sub ex:Author ?author .
      ?sub ex:Title ?title .
      ?sub ex:Publisher ?publisher .
      ?sub ex:Year ?year .
      ?sub ex:Pages ?pages .
      ?sub ex:Language ?language .
      FILTER(CONTAINS(LCASE(?author), LCASE('$searchTerm')) || CONTAINS(LCASE(?title), LCASE('$searchTerm'))).
    }
    limit 10
    ";

    // Call the function to execute the SPARQL query
    $result = executeSparqlQueryAndGetResults($sparqlEndpoint, $sparqlQuery);

    // Return search results
    return $result;

}
?>
