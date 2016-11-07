<?php
$url = 'https://miamidade.weatherstem.com/api';
$vars = array(
	"stations"    => array("umiami"),
	"api_key"     =>""
);

$options = array(
	'http'    => array(
	'method'    => 'POST',
	'content'   => json_encode( $vars ),
	'header'    =>  "Content-Type: application/json\r\n" .
					"Accept: application/json\r\n"
		)
	);

$context  = stream_context_create( $options );
$result = file_get_contents( $url, false, $context );
$response = json_decode($result,true);

$temp = $response[0][record][readings][0][value];
$windspeed = $response[0][record][readings][4][value];
$wind_gust = $response[0][record][readings][14][value];
$rainrate = $response[0][record][readings][9][value];
$raingauge = $response[0][record][readings][10][value];
$barometer = $response[0][record][readings][11][value];
$barometer_rate = $response[0][record][readings][12][value];
$webcam_url = "https://miamidade.weatherstem.com/skycamera/miamidade/umiami/cumulus/snapshot.jpg";

    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>


<Response>
    <Say voice="alice">
        Current Conditions for University of Miami.
    </Say>
    <Pause length="1"/>
    <Say>
        Temperature: <?php echo($temp);?>
    </Say>
    <Pause length="1"/>
    <Say>
        Windspeed: <?php echo($windspeed)?>miles per hour Gusting <?php echo($wind_gust)?> miles per hour.
    </Say>
    <Pause length="1"/>
    <Say>
        Rain accumulation: <?php echo($raingauge)?> inches.
    </Say>
    <Pause length="1"/>
    <Say>
        Rain Rate: <?php echo($rainrate)?> inches per hour
    </Say>
    <Pause length="1"/>
    <Say>
        Barometer: <?php echo($barometer)?> milimeters of Mercury, and <?php echo($barometer_rate)?>.
    </Say>
    <Pause length="1"/>
    <Say>
        Thank-you for your call. Please be sure to be aware of your surroundings at all times and report emergencies by calling 9 1 1.
        Stay tuned to the U Miami E N N for emergency updates. Goodbye.
    </Say>
</Response>
