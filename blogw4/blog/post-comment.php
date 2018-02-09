<?php session_start();?>
<?php include("../includes/database.php");?>
<?php include("../includes/functions.php");?>
<head>
    <meta charset="UTF-8">
    <title>Comments</title>
    <link rel="stylesheet" type="text/css" href="../stylesheets/style.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="../jquery-3.3.1.min.js"></script>
    <script src="../includes/functions.js"></script>
</head>

<?php
//submit new comment
if($_POST){
    $anonymous = $_POST['anonymous'];

    if($anonymous == 1){
        $user_id = "15";
    }else{
        $user_id = $_SESSION['current_user_id'];
    }

    $article_id = $_POST['article_id'];
    date_default_timezone_set("Europe/Amsterdam");
    $date = date("Y-m-d H:i:s");
    $comment = $_POST['comment'];
    var_dump($user_id,$anonymous,$article_id,$comment,$date);

    $sql = "INSERT INTO comment(comment, user_id, anonymous, article_id, date)
            VALUES ('$comment', '$user_id', '$anonymous', '$article_id', '$date')";
    $result = mysqli_query($connection,$sql);

}
