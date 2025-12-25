<?php
$size = $_POST['size'] ?? "";
$toppings = $_POST['toppings'] ?? [];
$crust = $_POST['crust'] ?? "";
$error = "";

// Validation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($size == "" || empty($toppings)) {
        $error = "Please select size and at least one topping.";
    }
}
?>

<form method="post">

<h3>Pizza Size:</h3>
<input type="radio" name="size" value="Small"  <?php if($size=="Small") echo "checked"; ?>> Small<br>
<input type="radio" name="size" value="Medium" <?php if($size=="Medium") echo "checked"; ?>> Medium<br>
<input type="radio" name="size" value="Large"  <?php if($size=="Large") echo "checked"; ?>> Large<br><br>

<h3>Toppings:</h3>
<input type="checkbox" name="toppings[]" value="Cheese"   <?php if(in_array("Cheese",$toppings)) echo "checked"; ?>> Cheese<br>
<input type="checkbox" name="toppings[]" value="Mushroom" <?php if(in_array("Mushroom",$toppings)) echo "checked"; ?>> Mushroom<br>
<input type="checkbox" name="toppings[]" value="Onion"    <?php if(in_array("Onion",$toppings)) echo "checked"; ?>> Onion<br>
<input type="checkbox" name="toppings[]" value="Olive"    <?php if(in_array("Olive",$toppings)) echo "checked"; ?>> Olive<br><br>

<h3>Crust Type:</h3>
<select name="crust">
    <option value="">--Select--</option>
    <option value="Thin"    <?php if($crust=="Thin") echo "selected"; ?>>Thin</option>
    <option value="Regular" <?php if($crust=="Regular") echo "selected"; ?>>Regular</option>
    <option value="Thick"   <?php if($crust=="Thick") echo "selected"; ?>>Thick</option>
</select>

<br><br>

<button type="submit">Order</button>
</form>

<!-- Show error -->
<?php
if ($error != "") {
    echo "<p style='color:red;'>$error</p>";
}
?>
