<?php
include_once 'Death.php';
include_once 'DeathCollection.php';
include_once 'Accident.php';
include_once 'Killed.php';

$deaths = new DeathCollection();
if (($handle = fopen("vtmec-causes-of-death.csv", "r")) !== FALSE)
{
    $dataHeader = fgetcsv($handle, 1000);
    while (true) {
        $data = fgetcsv($handle, 1000);
        if (!$data){
            break;
        }
        if ($data[2] === "Nevardarbīga nāve") {
            $deaths->add
            (
                $data[0],
                new Accident
                (
                    $data[1],
                    $data[2],
                    explode(';', $data[3])
                )
            );
        } else if ($data[2] === "Nāves cēlonis nav noteikts") {
            $deaths->add
            (
                $data[0],
                new Death
                (
                    $data[1],
                    $data[2]
                )
            );
        } else {
            $data[4] = array_unique(explode(';',$data[4]));
            $data[4] = array_values($data[4]);
            $deaths->add
            (
                $data[0],
                new Killed
                (
                    $data[1],
                    $data[2],
                    $data[4],
                    explode(';', $data[5])
                )
            );
        }
    }
    fclose($handle);
}
foreach($deaths->filterDeaths('2022-01',null,null,'Mehāniskie') as $key=>$death){
    echo $key . ': ' . $death . PHP_EOL;
}
echo count($deaths->filterDeaths('2022-04','Nāve')) . PHP_EOL;

echo($deaths->getDeathsByKey('b19e5a524ae78f625d15dde6080b6a6faf67bd75') . PHP_EOL);

/*
foreach($deaths->getDeathsByDate('01') as $key=>$death){
    echo $key . ': ' . $death . PHP_EOL;
}
*/