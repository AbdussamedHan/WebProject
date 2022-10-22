<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <?php
            if (isset($_SESSION['login'])){
                echo '<a class="login" href="logout.php">Log out</a>';
            }else{
                echo '<a class="login" href="login.php">Login</a>';
            }
        ?>
        <a class="home" href="main.php">Home</a>
        <nav>
            <ul>
                <a href="aboutme.php"><li>About Me</li></a>|

                <?php
                    if (isset($_SESSION['login'])){
                        echo '<a href="experience.php"><li>Experience</li></a>|';
                        echo '<a href="blog.php"><li>Blog</li></a>|';
                        echo '<a href="viewBlog.php"><li>View Blogs</li></a>';
                    }else{
                        echo '<a href="experience.php"><li>Experience</li></a>|';
                        echo '<a href="viewBlog.php"><li>View Blogs</li></a>';
                    }
                ?>
            </ul>
        </nav>
    </header>
    
    <div class = "wrapper">