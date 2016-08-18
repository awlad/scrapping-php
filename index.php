<?php
/**
 * Created by PhpStorm.
 * User: awlad
 * Date: 8/18/16
 * Time: 10:00 PM
 */

echo "------ start ";
include_once('simple_html_dom.php');

//End roll number
$ended = 854759;


//Start roll number
$start = 128887;

$search_name = "Your_Desire_Name";

$end = $start+30;
while($start < $end && $end < $ended ) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "http://hscresult.dinajpurboard.gov.bd/search/search_student.php");
    curl_setopt($ch, CURLOPT_POST, 1);

    curl_setopt($ch, CURLOPT_POSTFIELDS,
        http_build_query(array('roll_no' => "$start", 'submit' => '')));

    // receive server response
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);

    curl_close($ch);

    $doc = str_get_html($server_output);
    foreach ($doc->find('div.inst-info') as $full_info)
        if (preg_match("/$search_name/", (string)$full_info) > 0) {
            print_r($server_output);
        }

    $start++;
}

echo "<br/> ";
echo "ended: $end";
