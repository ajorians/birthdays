<!---
create table Entries(
   order_id INT NOT NULL AUTO_INCREMENT,
   person_name VARCHAR(100) NOT NULL,
   birthday_date DATE,
   PRIMARY KEY ( order_id )
);
--->

<HTML>

<TITLE>Birthdays At A Glace</TITLE>

<HEAD>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</HEAD>

<BODY>

<H1>Birthdays At A Glace</H1>

<?php
$servername = "localhost";
$username = "<USERHERE>";
$password = "<PASSHERE>";
$dbname = "birthdaysdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "<P>Connected successfully</P>";

if ( isset($_REQUEST) )
{
	$added_name = $_REQUEST['person_name'];
	$added_date = $_REQUEST['birthday_date'];

	if( isset($added_name) && isset($added_date) )
	{
		$sqlInsert = "INSERT INTO Entries (person_name, birthday_date) VALUES (
	           '$added_name','$added_date')";

	        if(mysqli_query($conn, $sqlInsert)){
	            echo "<h3>data stored in a database successfully."
	                . " Please browse your localhost php my admin"
	                . " to view the updated data</h3>";

	        } else{
	            echo "ERROR: Hush! Sorry $sqlInsert. "
			    . mysqli_error($conn);
		}
	}
}

date_default_timezone_set("America/New_York");

$today = time();
echo "<H1>Today is " . date("Y/m/d", $today) . "</H1>";

$sql = "SELECT order_id, person_name, birthday_date FROM Entries";
$result = $conn->query($sql);

if ($result->num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{
		echo "<H2>" . $row["person_name"]. "</H2>";
		$birthday = strtotime($row["birthday_date"]);
		echo "<P>Birthday: " . date("Y/m/d", $birthday). "</P>";

		$ageDiff = $today - $birthday;
		
		$nextbday = mktime(0, 0, 0, date("m", $birthday),   date("d",$birthday), date("Y",$today) );
		$daysUntilNextBDay = ceil(($nextbday-time())/60/60/24);
		if(  $daysUntilNextBDay <= 0 )
		{
			$nextbday = mktime(0, 0, 0, date("m", $birthday),   date("d",$birthday), date("Y",$today)+1 );
		}

		$AgeEarthDays = round($ageDiff / (60*60*24));
		$AgeEarthYears = $AgeEarthDays / 365.25;

		$AgeMercuryDays = $ageDiff / (60*60*24)/58.6;
		$AgeMercuryYears = $AgeEarthDays / 87.97;
		$EarthDaysOldNextMercuryBDay = (floor($AgeMercuryYears)+1) * 87.97;
		$NextMercuryBDay = $birthday + ($EarthDaysOldNextMercuryBDay*(60*60*24));

		$AgeVenusDays = $ageDiff / (60*60*24)/243;
                $AgeVenusYears = $AgeEarthDays / 224.7;
                $EarthDaysOldNextVenusBDay = (floor($AgeVenusYears)+1) * 224.7;
                $NextVenusBDay = $birthday + ($EarthDaysOldNextVenusBDay*(60*60*24));


echo "<table>
  <tr>
    <th>Planet</th>
    <th>Age Days</th>
    <th>Age Years</th>
    <th>Next Birthday</th>
  </tr>
  <tr>
    <td>Mercury <img src=\"https://www.exploratorium.edu/ronh/age/images/mercury.gif\" width=\"30\" height=\"30\" alt=\"Mercury\"></td>
    <td>". round($AgeMercuryDays,1) . "</td>
    <td>". round($AgeMercuryYears, 2) . "</td>
    <td>". date("D M j Y", $NextMercuryBDay) . "</td>
  </tr>
  <td>Venus <img src=\"https://www.exploratorium.edu/ronh/age/images/venus.gif\" width=\"30\" height=\"30\" alt=\"Venus\"></td>
    <td>". round($AgeVenusDays,1) . "</td>
    <td>". round($AgeVenusYears, 2) . "</td>
    <td>". date("D M j Y", $NextVenusBDay) . "</td>
  </tr>
  <tr>
    <td>Earth <img src=\"https://www.exploratorium.edu/ronh/age/images/earth.gif\" width=\"30\" height=\"30\" alt=\"Earth\"></td>
    <td>". number_format($AgeEarthDays) . "</td>
    <td>". round($AgeEarthYears, 1) . "</td>
    <td>". date("D M j Y", $nextbday) . "</td>
  </tr>
</table>";

		$daysUntilNextBDay = ceil(($nextbday-time())/60/60/24);

		echo "<P>Next birthday: " . date("D M j Y", $nextbday) . " - Days until next birthday " . $daysUntilNextBDay. "</P><br>";
	}
}
else
{
	echo "0 results";
}

$conn->close();
?>


<form action="index.php" method="post">
<p>
                <label for="person_name">Name:</label>
                <input type="text" name="person_name" id="personName">
</p>

<p>
                <label for="birthday_date">Birthday (YYYY-MM-DD):</label>
                <input type="text" name="birthday_date" id="birthdayDate">
</p>

            <input type="submit" value="Submit">
        </form>

</BODY>
</HTML>
