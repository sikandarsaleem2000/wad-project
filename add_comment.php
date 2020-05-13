<?php
    include_once "includes/connection.php";
    $pid = $_POST["pid"];
    $comment = $_POST["comment"];
    $commenter_name = $_POST["senderName"];
    $flag= 0;

    $sql = "SELECT *FROM words";
    $res = $conn->query($sql);
    if($res->num_rows > 0) {
        while($col = $res->fetch_assoc()){
            $word = $col["word"];
            if(stripos($comment, $word) !== false){
                echo "Negative word found in comment";
                $flag = 1;
                break;
            }
        }
    }

    if($flag == 0){
        $sql = "INSERT INTO comments (pid, comment, sender_name) VALUES('$pid', '$comment', '$commenter_name')";
        if($conn->query($sql) === true){
          //  echo "Comment Posted";
        }
        else{
            echo "error";
        }
    }
?>