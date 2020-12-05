<?php
    
    // Credentials for DB
    $host = 'localhost';
    $db = 'webmap';
    $username= 'postgres';
    $password = 'postgres';
    
    // Connect to db
    $dsn = "pgsql:host=localhost;port=5432;dbname=webmap;user=postgres;password=postgres";
    $connection = new PDO($dsn);


    // Check if variable exists
    if (isset($_POST['query_box']))
        {
            $query_box = $_POST['query_box'];
        }


    // Execute Query using implode to seperate values
    $result = $connection->query("SELECT *, ST_AsGeoJSON(geom, 5) AS geojson FROM smaller_test WHERE geom @ ST_MakeEnvelope(" . implode(',', $query_box) . ",4326)");

    // Create GEOjson from query
    $features=[];
    foreach($result AS $row) {
        // Remove unreadable hash
        unset($row['geom']);
        $geometry = $row['geojson']=json_decode($row['geojson']);
        unset($row['geojson']);
        $feature=["type"=>"Feature", "geometry"=> $geometry, "properties"=>$row];
        array_push($features, $feature);
    }    
    
    # Add all features to a single file
    $feature_collection=['type'=>"FeatureCollection", 'features'=>$features];
    
    $myfile = fopen("./testfile.geojson", "w");
    $txt = json_encode($feature_collection);
    fwrite($myfile,$txt);
    fclose($myfile);

    # Encode all features as a json and send back from server
    echo json_encode($feature_collection);
    
?>