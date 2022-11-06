<!---
create table Entries(
   order_id INT NOT NULL AUTO_INCREMENT,
   person_name VARCHAR(100) NOT NULL,
   birthday_date DATE,
   PRIMARY KEY ( order_id )
);
--->

<HTML>

<TITLE>Birthdays At A Glance</TITLE>

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
$username = "dbuser";
$password = "dbpasswd";
$dbname = "birthdaysdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "<P>Connected successfully</P>";

$sqlCreateTableIfNotExists = "create table if not exists Entries(order_id INT NOT NULL AUTO_INCREMENT, person_name VARCHAR(100) NOT NULL, birthday_date DATE, PRIMARY KEY ( order_id ));";
mysqli_query($conn, $sqlCreateTableIfNotExists);

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

		$AgeVenusDays = $ageDiff / (60*60*24)/243.0;
                $AgeVenusYears = $AgeEarthDays / 224.7;
                $EarthDaysOldNextVenusBDay = (floor($AgeVenusYears)+1) * 224.7;
		$NextVenusBDay = $birthday + ($EarthDaysOldNextVenusBDay*(60*60*24));

		$AgeMarsDays = $ageDiff / (60*60*24)/1.03;
                $AgeMarsYears = $AgeEarthDays / (686.98);
                $EarthDaysOldNextMarsBDay = (floor($AgeMarsYears)+1) * (686.98);
		$NextMarsBDay = $birthday + ($EarthDaysOldNextMarsBDay*(60*60*24));

		$AgeJupiterDays = $ageDiff / (60*60*24)/.41;
                $AgeJupiterYears = $AgeEarthDays / (11.86*365.25);
                $EarthDaysOldNextJupiterBDay = (floor($AgeJupiterYears)+1) * (11.86*365.25);
                $NextJupiterBDay = $birthday + ($EarthDaysOldNextJupiterBDay*(60*60*24));

		$AgeSaturnDays = $ageDiff / (60*60*24)/.44;
                $AgeSaturnYears = $AgeEarthDays / (29.46*365.25);
                $EarthDaysOldNextSaturnBDay = (floor($AgeSaturnYears)+1) * (29.46*365.25);
		$NextSaturnBDay = $birthday + ($EarthDaysOldNextSaturnBDay*(60*60*24));

		$AgeUranusDays = $ageDiff / (60*60*24)/.72;
                $AgeUranusYears = $AgeEarthDays / (30685);
                $EarthDaysOldNextUranusBDay = (floor($AgeUranusYears)+1) * (30685);
		$NextUranusBDay = $birthday + ($EarthDaysOldNextUranusBDay*(60*60*24));

		$AgeNeptuneDays = $ageDiff / (60*60*24)/.67;
                $AgeNeptuneYears = $AgeEarthDays / (60190);
                $EarthDaysOldNextNeptuneBDay = (floor($AgeNeptuneYears)+1) * (60190);
		$NextNeptuneBDay = $birthday + ($EarthDaysOldNextNeptuneBDay*(60*60*24));

		$AgePlutoDays = $ageDiff / (60*60*24)/6.39;
                $AgePlutoYears = $AgeEarthDays / (247.92*365.25);
                $EarthDaysOldNextPlutoBDay = (floor($AgePlutoYears)+1) * (247.92*365.25);
                $NextPlutoBDay = $birthday + ($EarthDaysOldNextPlutoBDay*(60*60*24));

echo "<table>
  <tr>
    <th>Planet</th>
    <th>Age Days</th>
    <th>Age Years</th>
    <th>Next Birthday</th>
  </tr>
  <tr>
    <td>Mercury <img src=\"images/mercury.gif\" width=\"30\" height=\"30\" alt=\"Mercury\"></td>
    <td>". round($AgeMercuryDays,1) . "</td>
    <td>". round($AgeMercuryYears, 2) . "</td>
    <td>". date("D M j Y", $NextMercuryBDay) . "</td>
  </tr>
  <td>Venus <img src=\"images/venus.gif\" width=\"30\" height=\"30\" alt=\"Venus\"></td>
    <td>". round($AgeVenusDays,1) . "</td>
    <td>". round($AgeVenusYears, 2) . "</td>
    <td>". date("D M j Y", $NextVenusBDay) . "</td>
  </tr>
  <tr>
    <td>Earth <img src=\"images/earth.gif\" width=\"30\" height=\"30\" alt=\"Earth\"></td>
    <td>". number_format($AgeEarthDays) . "</td>
    <td>". round($AgeEarthYears, 2) . "</td>
    <td>". date("D M j Y", $nextbday) . "</td>
  </tr>
  <tr>
    <td>Mars <img src=\"images/mars.gif\" width=\"30\" height=\"30\" alt=\"Mars\"></td>
    <td>". number_format(round($AgeMarsDays,1)) . "</td>
    <td>". round($AgeMarsYears, 2) . "</td>
    <td>". date("D M j Y", $NextMarsBDay) . "</td>
  </tr>
  <tr>
    <td>Jupiter <img src=\"images/jupiter.gif\" width=\"30\" height=\"30\" alt=\"Jupiter\"></td>
    <td>". number_format(round($AgeJupiterDays,1)) . "</td>
    <td>". round($AgeJupiterYears, 2) . "</td>
    <td>". date("D M j Y", $NextJupiterBDay) . "</td>
  </tr>
  <tr>
    <td>Saturn <img src=\"images/saturn.gif\" width=\"30\" height=\"30\" alt=\"Saturn\"></td>
    <td>". number_format(round($AgeSaturnDays,1)) . "</td>
    <td>". round($AgeSaturnYears, 2) . "</td>
    <td>". date("D M j Y", $NextSaturnBDay) . "</td>
  </tr>
  <tr>
    <td>Uranus <img src=\"images/uranus.gif\" width=\"30\" height=\"30\" alt=\"Uranus\"></td>
    <td>". number_format(round($AgeUranusDays,1)) . "</td>
    <td>". round($AgeUranusYears, 2) . "</td>
    <td>". date("D M j Y", $NextUranusBDay) . "</td>
  </tr>
  <tr>
    <td>Neptune <img src=\"images/neptune.gif\" width=\"30\" height=\"30\" alt=\"Neptune\"></td>
    <td>". number_format(round($AgeNeptuneDays,1)) . "</td>
    <td>". round($AgeNeptuneYears, 2) . "</td>
    <td>". date("D M j Y", $NextNeptuneBDay) . "</td>
  </tr>
  <tr>
    <td>Pluto <img src=\"images/pluto.gif\" width=\"30\" height=\"30\" alt=\"Pluto\"></td>
    <td>". number_format(round($AgePlutoDays,1)) . "</td>
    <td>". round($AgePlutoYears, 2) . "</td>
    <td>". date("D M j Y", $NextPlutoBDay) . "</td>
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
