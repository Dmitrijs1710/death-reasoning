<?php
include_once '../src/Death.php';
include_once '../src/Accident.php';
include_once '../src/Killed.php';
include_once '../src/DeathCollection.php';

$collection = new DeathCollection();

// Our selection Url
$api_url = 'https://data.gov.lv/dati/lv/api/3/action/datastore_search?resource_id=d662c2a3-19f0-4843-a431-b92dc69d40c2&limit=';

// Number of records to retrieve
// We can input number greater than the number of records and won't get an error
$limit = 1000;

// Read JSON file
$json_data = file_get_contents($api_url . $limit);

// Decode JSON data into PHP object
$response_data = json_decode($json_data);

// Get records from PHP array
$allData = $response_data->result->records;

// Copy the data from the object to the class
foreach ($allData as $data){
    if ($data->naves_celonis === DeathCollection::ACCIDENT) {
        $collection->add
        (
            new Accident
            (
                $data->identifikators,
                $data->datums,
                $data->naves_celonis,
                explode(';', $data->nevardarbigas_naves_celonis)
            )
        );
    } else if ($data->naves_celonis === DeathCollection::UNKNOWN) {
        $collection->add
        (
            new Death
            (
                $data->identifikators,
                $data->datums,
                $data->naves_celonis
            )
        );
    } else {
        $data->vardarbigas_naves_lietas_apstakli = array_unique(explode(';',$data->vardarbigas_naves_lietas_apstakli));
        $data->vardarbigas_naves_lietas_apstakli = array_values($data->vardarbigas_naves_lietas_apstakli);
        $collection->add
        (
            new Killed
            (
                $data->identifikators,
                $data->datums,
                $data->naves_celonis,
                $data->vardarbigas_naves_lietas_apstakli,
                explode(';', $data->vardarbigas_naves_veids)
            )
        );
    }
}
// output from our collection
foreach ($collection->getAllDeaths() as $key=>$death){
    echo $key . ': ' . $death . PHP_EOL;
}
echo 'Number of deaths from collection: ' . count($collection->getAllDeaths()) . PHP_EOL;
echo PHP_EOL;
foreach ($collection->getDeathsByReason(DeathCollection::KILLED) as $key=>$death){
    echo $key . ': ' . $death . PHP_EOL;
}


