<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $fullname = $_POST['fullname'];
    $gender = $_POST['gender'];
    $hobbies = isset($_POST['hobbies']) ? implode(", ", $_POST['hobbies']) : "";
    $country = $_POST['country'];
    $subjects = implode(", ", $_POST['subjects']);

    echo "<h2>Student Registration Details</h2>";
    echo "Full Name: $fullname <br>";
    echo "Gender: $gender <br>";
    echo "Hobbies: $hobbies <br>";
    echo "Country: $country <br>";
    echo "Subjects: $subjects <br><hr>";
}
?>

<h3>Student Registration Form</h3>

<form method="POST">

Full Name: <input type="text" name="fullname" required>
<br><br>

Gender:
<input type="radio" name="gender" value="Male"> Male
<input type="radio" name="gender" value="Female"> Female
<input type="radio" name="gender" value="Other"> Other
<br><br>

Hobbies:
<input type="checkbox" name="hobbies[]" value="Reading"> Reading
<input type="checkbox" name="hobbies[]" value="Sports"> Sports
<input type="checkbox" name="hobbies[]" value="Music"> Music
<input type="checkbox" name="hobbies[]" value="Traveling"> Traveling
<br><br>

Country:
<select name="country">
    <option value="Nepal">Nepal</option>
    <option value="India">India</option>
    <option value="USA">USA</option>
    <option value="UK">UK</option>
</select>
<br><br>

Subjects: (Hold CTRL to select multiple)
<select name="subjects[]" multiple size="5">
    <option value="PHP">PHP</option>
    <option value="Java">Java</option>
    <option value="Database">Database</option>
    <option value="Networking">Networking</option>
    <option value="AI">AI</option>
</select>
<br><br>

<button type="submit">Register</button>
</form>?>
