<?php
include("connection.php");
// mysqli_select_db("gate_record",$con);

$tag_id = $_GET["tagid"];
$query = "select * from gate_details where tag_no='$tag_id'";
$result = mysqli_query($con, $query);
$data = mysqli_fetch_row($result);

$time = $_GET["time"];

$insertQuery = "insert into vehicle_record (tag_id, gate_id, vehicle_no, driver, license_no, customs_seal, vessel_id, date) 
                values('$tag_id', 1, '$data[3]', '$data[4]', '$data[5]', '$data[6]', '$data[7]', '$time')";

mysqli_query($con, $insertQuery);

$query = "select * from vehicle_record";
$result = mysqli_query($con, $query);

echo "<table border='1' >
<tr>
<td align=center> <b>Tag ID.</b></td>
<td align=center><b>Vehicle Reg No.</b></td>
<td align=center><b>Driver</b></td>
<td align=center><b>Licence No</b></td>
<td align=center><b>Custom's Seal</b></td>
<td align=center><b>Vessel ID</b></td>
<td align=center><b>Time</b></td></td>";

while($data = mysqli_fetch_row($result))
{   
    echo "<tr>";
    echo "<td align=center>$data[1]</td>";
    echo "<td align=center>$data[3]</td>";
    echo "<td align=center>$data[4]</td>";
    echo "<td align=center>$data[5]</td>";
    echo "<td align=center>$data[6]</td>";
    echo "<td align=center>$data[7]</td>";
    echo "<td align=center>$data[8]</td>";
    echo "</tr>";
}
echo "</table>";
?>