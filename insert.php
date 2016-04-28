<?PHP
    include( "connect.php");
    
$sql="INSERT INTO Deelnemers (Voornaam, Tussenvoegsel, Achternaam, Postcode, Adres, Woonplaats)
VALUES
('$_POST[Voornaam]','$_POST[Tussenvoegsel]','$_POST[Achternaam]','$_POST[Postcode]','$_POST[Adres]','$_POST[Woonplaats]')";
if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
echo "1 record toegevoegd";
mysqli_close($con)
    
    
    
    
?>
