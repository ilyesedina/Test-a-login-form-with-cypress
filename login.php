
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PHP Form and If-else Exercise</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    </head>

    <body>
        <div class='container' style="max-width:500px">
            <form id='nameForm' method="POST" action="login.php">
                <br/>
                <br/>
                <br/>      
                <div class="input-field">
                    <label for="userName">Username:</label>
                    <input type="text" id='userName' name="userName" />
                </div>
                <div class="input-field">
                    <label for="password">Password:</label>
                    <input type="password" id='password' name="password"/>
                </div>
                <br/>
                <br/>
                <button class="waves-effect waves-light btn" name="submit">Submit</button>
            </form>

            <?php

               
                $fakeUsersDB = initializeFakeDB();
                handleLogin($fakeUsersDB);

                function handleLogin($db)
                {
                    //Check if user actually typed something into the textboxes AND pressed submit
                    if (isset($_POST["submit"]) &&
                        !empty($_POST["userName"]) &&
                        !empty($_POST["password"]))
                    {
                        //create helper variables
                        $inputUsername = $_POST["userName"];
                        $inputPassword = $_POST["password"];

                         //from
                        if ($inputUsername == "user" && $inputPassword == "1234")
                        {
                            echo "<br/>Welcome to the secret area.";
                            header("Location: secret.php");
                        }
                        else
                        {
                            echo "<br/><br/>Wrong username or password. Try again...";
                        }
                        //until 
                        

                        //create 

/* 
                         //we have a match and login - display success msg
                        if (validateUserFake($db, $inputUsername, $inputPassword) == true)
                        {
                            echo "<br/>Welcome to the secret area.";
                            header("Location: secret.php");
                        }
                        //failed login attempt
                        else
                        {
                            echo "<br/><br/>Wrong username or password. Try again...";
                        }  */
                    }
                }

                function validateUserFake($db, $inputUsername, $inputPassword)
                {
                    $loggedIn = false;
                   
                    //run through all users in fake db
                    foreach($db as $user)
                    {
                        //test each user if their username and password match
                        if ($user["username"] == $inputUsername &&
                            $user["password"] == $inputPassword)
                            $loggedIn = true; //we have a match :)
                    }               

                    return $loggedIn;
                }


                function validateUserDB($inputUsername, $inputPassword)
                {                    
                    $conn = new mysqli();
                    
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    } 

                    $sql = "SELECT * FROM user";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        
                        // output data of each row
                        while($user = $result->fetch_assoc()) {
                            if ($user["username"] == $inputUsername &&
                                $user["password"] == $inputPassword)
                                { 
                                    return true; //we have a match :)
                                }                            
                        }
                    }
                    return false;
                }


                function initializeFakeDB()
                {
                    //Fake users DB
                    $users = [
                        ["username" => "user1", "password" => "1234"],
                        ["username" => "user2", "password" => "god"],
                        ["username" => "bilbo", "password" => "qwerty"],
                        ["username" => "baggins", "password" => "ost"]
                    ];

                    return $users;
                }                
            ?>

        </div>    
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    </body>
</html>