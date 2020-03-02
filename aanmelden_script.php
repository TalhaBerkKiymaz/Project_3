<?php
    
    // var_dump($_POST);

    if ( empty($_POST["email"])) {
        header("Location: ./index.php?content=message&alert=no-email");
    } else {
        // Eerst contact maken met de mysql-server
        include("./connect_db.php");
        include("./sanitize.php");

        // De $_POST["email"] waarde schoonmaken
        $email = sanitize($_POST["email"]);

        // Maak de selectie query... 
        $sql = "SELECT * FROM `users` WHERE `email` = '{$email}'";
        // echo $sql; exit();
        // Vuur de query af op de database...
        $result = mysqli_query($conn, $sql);
        // $record = mysqli_fetch_assoc($result);
        // var_dump($record); exit();
        // echo mysqli_num_rows($result);
        // Hoeveel records zijn er gevonden?
        if (mysqli_num_rows($result)) {
            header("Location: ./index.php?content=message&alert=emailexists");
        } else {
            $username = sanitize($_POST["username"]);
            $email = sanitize($_POST["email"]);
            $password = sanitize($_POST["password"]);
            $handteken = sanitize($_POST["handteken"]);
            $nationaliteit = sanitize($_POST["nationaliteit"]);
    

$query = "INSERT INTO `users` (`id`,
                               `username`, 
                               `email`, 
                               `password`,
                               `nationaliteit`,
                               `handteken`)
                      values (NULL,
                              '$username',
                              '$email',
                              '$password',
                              '$nationaliteit',
                              '$handteken')";
// echo $query; exit();
mysqli_query($conn, $query);                            

// Met de header functie kan je de browser naar een andere pagina laten gaan.
header("Refresh: 3; index.php?content=users");
            // header("Refresh: 3; index.php?content=create_users");
        }
        

    }   

?>