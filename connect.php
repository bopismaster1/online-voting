<?php
ob_start();
error_reporting(E_ALL ^ E_DEPRECATED);

$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$BD_TABLE = 'sbo_voting';

// $DB_HOST = 'sql111.epizy.com';
// $DB_USER = 'epiz_30023994';
// $DB_PASS = 'BugkZwJJPt';
// $BD_TABLE = 'epiz_30023994_online_voting';

function insert_update_delete($query)
{
    // Create connection
    global $DB_HOST, $DB_USER, $DB_PASS, $BD_TABLE;
    $conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $BD_TABLE);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    if (mysqli_query($conn, $query)) {
        return "success";
    } else {
        return "Unable to execute query " . $query;
    }
    mysqli_close($conn);
}
function select_info_multiple_key($query)
{
    //echo $query;
    global $DB_HOST, $DB_USER, $DB_PASS, $BD_TABLE;
    $conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $BD_TABLE);

    //mysql_query($query);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    if ($res = mysqli_query($conn, $query)) {
        $retvalue = array();

        $ctr = 0;
        while ($r = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            $a_keys = array_keys($r);
            //in supplying the query string specify first the ID (PK) ex. select id, name etc..
            //$row_name = $r[0].$ctr;
            $retvalue[$ctr] = array();

            //(
            //'str_license'=>$r['str_license']
            //,'str_license_description'=>html_entity_decode(stripslashes($r['str_license_description']),ENT_QUOTES)
            //);

            for ($x = 0; $x < count($a_keys); $x++) {
                $retvalue[$ctr][$a_keys[$x]] = html_entity_decode(stripslashes($r[$a_keys[$x]]), ENT_QUOTES);
            }
            $ctr = $ctr + 1;
        }
        return $retvalue;
    } else {
        //addDebug('InfoMgmt_getLicense',sql);
        //addDebug('InfoMgmt_getLicense',mysql_error());
        return "No Data";
    }

    mysqli_close($conn);
}
