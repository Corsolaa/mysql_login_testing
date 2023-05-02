<?php
if (empty($_POST["username"])) {
    display_form("Please fill in username");
} elseif (empty($_POST["password"])) {
    display_form("Please fill in Password");
}


if (!empty($_POST["username"]) && !empty($_POST["password"])) {
    mysql_handler($_POST["username"], $_POST["password"]);
} else {
    display_form("");
}

function display_form($error): void
{
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>code injection</title>

        <link rel="stylesheet" href="main.css">
    </head>
    <body>
    <div class="content">
        <form class="login" method="POST">
            <h1>Login</h1>
            <?php echo $error?>
            <label for="username">
                <input type="text" name="username" id="username">
                <span>Username</span>
            </label>
            <label for="password">
                <input type="password" name="password" id="password">
                <span>Password</span>
            </label>
            <input type="submit" value="SUBMIT" class="submit_button">
            <?php var_dump($_POST); ?>
        </form>
    </div>
    </body>
    </html>
    <?php
}

function mysql_handler($username, $pass): void
{
    $con = make_connection("testing");
    try {
        $result = $con->query("SELECT * FROM users WHERE user_name='$username' AND password='$pass'");
    } catch (Exception) {
        display_form("Wrong username password combo.");
    }
    if ($result->num_rows > 0) {
        echo "you are in";
    } else {
        display_form("Wrong username password combo");
    }
}

function make_connection(string $db_name): false|mysqli|null
{
    $server_name = "localhost";
    $user_name = "root";
    $password = "";
    $con = mysqli_connect($server_name, $user_name, $password, $db_name);
    if (mysqli_connect_errno()) {
        return null;
    }
    return $con;
}

?>
