<?

$citiesId = array(618426, 618605, 618577, 617094, 618365, 618456, 617638, 617486, 617239);
$currentTime = time();

$savedData = "data\data.json";
$parsedLocalData = json_decode(file_get_contents($savedData), true);
$baseTime = $parsedLocalData[1];
$cityWeWant = $parsedLocalData[2];

if (($currentTime - 610) > $baseTime) {
	$requestUrl = 'http://api.openweathermap.org/data/2.5/forecast/city?id=' . $citiesId[$cityWeWant] . '&units=metric&APPID=077dd80b15fedc5b0d726ad229710dca';
	// $requestUrl = 'data\fake.json';
	$parsedWebData = json_decode(file_get_contents($requestUrl), true);

	$parsedLocalData[0][$cityWeWant] = $parsedWebData;
	$parsedLocalData[1] = $currentTime;

	
	if ($parsedLocalData[2] < (count($citiesId) - 1)) {$parsedLocalData[2] = $parsedLocalData[2] + 1;} else {$parsedLocalData[2] = 0;}
	

	$weWillChangeIt = fopen($savedData, "w");
	fwrite($weWillChangeIt, json_encode($parsedLocalData));
	fclose($weWillChangeIt);

	echo $parsedLocalData[2];
} else {echo 'rano';}

?>