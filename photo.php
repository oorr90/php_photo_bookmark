<?php

$image_url = $_POST['url'];
$image_title = $_POST['title'];
$image_alt = $_POST['alt'];

//The text below is JUST text to php, but SQL knows it has special meaning
    //surround it with quotes so php knows its just text
    //save it as a variable so you can use it again and again

$insert_query = "INSERT INTO `photo_bookmark`(`image_url`, `image_title`, `image_alt`) VALUES ('$image_url', '$image_title', '$image_alt')";


    //so HOW does php send this text to SQL?
    //see below...

// 1. Connect to the database using the same login information as for phpMyAdmin
    //store the connection in a variable ($conn)
    //you MUST send the information in this order:
        // "server name", "user name", "password", "DATABASE!! (for some reason I needed this extra part...)"

        //WHEN USING LOCALHOST
            $server_name = "your_server_name";
            $user_name = "user_root_here";
            $user_pass = "user_pass_here";
            $db = "db_here";


$conn = mysqli_connect($server_name, $user_name, $user_pass, $db);

//WITHOUT VARIABLES: (another way to write)
    //$conn = mysqli_connect("localhost:3308", "root", "root", "mysql");

// 2. Test the connection to make sure it was successful. If it wasn't, stop running the php page and print an error message!
    //if $conn did not succeed...then die with a helpful error message

if (!$conn) {
    die("Couldn't connect to database");
}

// 3. Select the database (mysqli_select_db) you are using (your own database or the shared database we are using for this class)
    //pass the connection ($conn) and your username (root)
    //its the same username as before!

mysqli_select_db($conn, $db);

// 4. Send the query to the database
    //you MUST send the information in this order:
        //connectionVariableName, "query text"
    //this hands us a result back, so store it in a variable

$insert_result = mysqli_query($conn, $insert_query);

// 5. Test to see if it the query was successful. If it wasn't print an error message
    //don't want to DIE here, because otherwise the connection will close

if (!$insert_result) {
    echo ("Couldn't insert into table");
}

// 6. Close the database connection
mysqli_close($conn);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, intial=scale=1.0">
    <title>My Favorite Image</title>
    <link rel="stylesheet" type="text/css" href="normalize.css">
    <link href="https://fonts.googleapis.com/css?family=Overpass" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="wrapper">
    <section>
    <h1>Your image URL has been bookmarked!</h1>
        <p>Thank you for adding the image
            <?php
                echo "\"" . $image_title . "\"";
            ?>
            with the alt text of
            <?php
                echo "\"" . $image_alt . ".\"";
            ?>
            Your image is pictured below:
        </p>
        <p id="image">
            <img src="<?php echo $image_url; ?>" alt="<?php echo $image_alt ?>">
        </p>
        <p>
            <a href="index.html">Add another image...</a>
        </p>
    </section>
</div>
</body>
</html>
