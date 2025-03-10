<?php
        session_start();
        if (isset($_POST["ok"])) {
            $error = handlelogin();
        }

        
        $_SESSION["logtrue"] = false;
        // $_SESSION["accounts"] = ["admin@gmail.com" => "gmail.com"];
        

    //logic
    function handlelogin() {
        $email = strtoupper($_POST["email"]);
        $pass = strtoupper($_POST["pass"]);
        $epass = substr($email, strpos($email, "@")+1, strlen($email)-1);

        if ($_POST["email"]=="") {
            return "kolom email kosong";
        }
        elseif ($_POST["pass"]=="") {
            return "kolom password kosong";
        }
        elseif($pass == $epass){
            $_SESSION["logtrue"] = true;
            $_SESSION["biodata"]["email"] = $_POST["email"];
            header("Location: form.php");
            exit;
        }
        else{
            return "password atau email salah";
        }
    }

?>

<html>
    
<title>tugas 4</title>

<head>
    <link rel="stylesheet" href="css/loginpage.css">
</head>

<body>
    <div class="login">
        <h2>Login</h2>
        <form action="" method="POST">
            Email<br>
            <input type="text" name="email" 
                <?php
                    // menyimpan value email dalam text setelah refresh
                    echo isset($_POST["email"]) ? 'value="'.$_POST["email"].'"' : "";
                ?>>
                <br><br>

            Password<br>
            <input type="text" name="pass" 
                <?php
                    // menyimpan value password dalam text setelah refresh
                    echo isset($_POST["pass"]) ? 'value="'.$_POST["pass"].'"' : "";
                ?>>
                <br><br>

            <input type="submit" name="ok" value="ok"><br><br>
        </form>

        <h3>
        <?php
            echo isset($error) ? $error : "";
        ?>
        </h3>
    </div>    
</body>

</html>
