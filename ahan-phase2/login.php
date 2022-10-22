<?php
    include_once 'header.php';
?>

    <?php
        $servername = "127.0.0.1:8889";
        $username = "root";
        $password = "root";
        $dbname = "ecs417";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
           }
           
        $userEmail = $userPass = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $userEmail = $_POST["email"];
            $userPass = $_POST["password"];

            $sql = "SELECT email, password FROM USERS WHERE email='$userEmail'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {

                $row = mysqli_fetch_assoc($result);
                $email = $row["email"];
                $pass = $row["password"];
                
                if($userEmail === $email && $userPass === $pass){
                    session_start();
                    $_SESSION["email"] = $email;
                    $_SESSION["password"] = $pass;
                    $_SESSION["login"] = true;
                    header("Location: blog.php");
                    exit();
                } else {
                    echo "inputs do not match";
                }
            
            } else {
                echo "0 results";
            }
        }
    ?>

    <div class="login-main">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <fieldset>
                <section>
                    <h2 class="login-heading">Login</h2>
                    <p>
                        <input type="email" name="email" placeholder="Email" value="" required>
                    </p>
                    <p>
                        <input type="password" name="password" placeholder="Password" value="" required>
                    </p>
                    <section class="login-buttons">
                        <button type="submit">
                            Submit
                        </button>
                    </section>
                </section>
            </fieldset>
        </form>
    </div>

<?php
    include_once 'footer.php';
?>