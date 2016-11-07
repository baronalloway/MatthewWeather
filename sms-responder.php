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
    <Message>CURR:
    Temp: <?php echo($temp);?>
    Windspeed: <?php echo($windspeed)?>mph Gusting <?php echo($wind_gust)?>mph.
    24h Rain: <?php echo($raingauge)?>inches.
    Rain Rate: <?php echo($rainrate)?>in/hr.
    Barometer: <?php echo($barometer)?>mmHg.
    Barometer Rate: <?php echo($barometer_rate)?>.
    Snapshot: <?php echo($webcam_url)?>
    </Message>
</Response>
