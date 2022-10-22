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

    $sql = "SELECT email, dateTime, title, body FROM BLOGS";

    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);

    $data = array();
?>

<?php
    if ($numRows > 0) {

        for ($i = 0; $i < $numRows; $i++){
            $row = mysqli_fetch_assoc($result);
            $email = $row["email"];
            $dateTime = $row["dateTime"];

            $title = $row["title"];
            $body = $row["body"];

            $data[] = array("email" => $email, "dateTime"=> $dateTime, "title" => $title, "body" => $body);
        }

        function bubbleSort($array){
        	do{
                $swapped = false;
                for($i = 0; $i < count($array) - 1; $i++)
                {
                    if(strtotime($array[$i]['dateTime']) < strtotime($array[$i + 1]['dateTime']))
                    {
                        list($array[$i + 1], $array[$i]) = array( $array[$i], $array[$i + 1]);
                        $swapped = true;
                    }
                }
            }
            while($swapped);
            return $array;
        }
        $data = bubbleSort($data);
    }
?>

<div class="view-blog-main">
    <h2 class="view-blog-heading">View Blogs</h2>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="months">Choose month:</label>
        <select name="months" id="months">
            <option name="All">All</option>
            <option value="Jan">January</option>
            <option value="Feb">February</option>
            <option value="Mar">March</option>
            <option value="Apr">April</option>
            <option value="May">May</option>
            <option value="Jun">June</option>
            <option value="Jul">July</option>
            <option value="Aug">August</option>
            <option value="Sep">September</option>
            <option value="Oct">October</option>
            <option value="Nov">November</option>
            <option value="Dec">December</option>
        </select>
        <input class="dropDownSubmit" type="submit" name="Submit">
    </form>

    <div class="view-blogs-body">
        <?php

            if(isset($_POST['months'])){
                                    
                if ($_POST['months'] === "All"){
                    for ($i = 0; $i < $numRows; $i++){
                        echo "<div class='view-blog-element'>";
                            echo "<div class='blog-element-header'>";
                                echo "<ul>";
                                    echo "<li>".$data[$i]['dateTime']."</li>";
                                    echo "<li>".$data[$i]['email']."</li>";
                                echo "</ul>";
                            echo "</div>";
        
                            echo "<div class='blog-element-body'>";
                            echo "<ul>";
                                echo "<li>".$data[$i]['title']."</li>";
                                echo "<li>".$data[$i]['body']."</li>";
                        echo "</ul>";
                            echo "</div>";
                        echo "</div>";
                    }
                }else{
                    for ($i = 0; $i < $numRows; $i++){
                        $timestamp = strtotime($data[$i]['dateTime']);
                        $month = date("M", $timestamp);

                        if(isset($_POST['months'])){
                            if($_POST['months'] === $month){
                                $newData[] = $data[$i];
                            }
                        }
                    }
                    if(!empty($newData)){
                        foreach($newData as $i){
                            echo "<div class='view-blog-element'>";
                                echo "<div class='blog-element-header'>";
                                    echo "<ul>";
                                        echo "<li>".$i['dateTime']."</li>";
                                        echo "<li>".$i['email']."</li>";
                                    echo "</ul>";
                                echo "</div>";
            
                                echo "<div class='blog-element-body'>";
                                    echo "<ul>";
                                        echo "<li>".$i['title']."</li>";
                                        echo "<li>".$i['body']."</li>";
                                    echo "</ul>";
                                echo "</div>";
                            echo "</div>";
                        }                        
                    }
                }
            }
        ?>
    </div>
</div>

<?php
    include_once 'footer.php';
?>