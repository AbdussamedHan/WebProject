<?php
    include_once 'header.php';
?>
<?php
    echo '<script src="blogScript.js" defer></script>';
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

    $inputTitle = $inputBody = "";
    $userEmail = $_SESSION["email"];

    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        $inputTitle = $_POST["title"];
        $inputBody = $_POST["body"];
        $dateTime = date('Y/m/d H:i:s');

        $sql = "INSERT INTO BLOGS (email, dateTime, title, body) VALUES ('$userEmail', '$dateTime', '$inputTitle', '$inputBody')";

        if ($conn->query($sql) === TRUE) {
            header("Location: viewBlog.php");
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>

    <div class="blog-main">
        <form id="blog-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <fieldset>
                <section class="blog-section">
                    <h2 class="blog-heading">Add Blog</h2>
                    <p>
                        <input class="blog-title" type="text" name="title" placeholder="Title" value="" />
                    </p>
                    <p>
                        <textarea class="blog-text" name="body" placeholder="Enter your text here" cols="90" rows="15" ></textarea>
                    </p>
                    <section class="blog-buttons">
                        <button id="post" type="submit">
                            Post
                        </button>
                        <button id="clear" type="reset">
                            Clear
                        </button>
                    </section>
                </section>
            </fieldset>
        </form>
    </div>

<?php
    include_once 'footer.php';
?>