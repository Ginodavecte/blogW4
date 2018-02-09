<?php session_start();?>
<?php include("../includes/database.php");?>
<?php include("../includes/functions.php");?>
    <head>
        <meta charset="UTF-8">
        <title>Blog-plaatsen</title>
        <link rel="stylesheet" type="text/css" href="../stylesheets/style.css">
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="../includes/functions.js"></script>
        <script src="../jquery-3.3.1.min.js"></script>
<!--        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>-->
<!--        <link href="../editor.css" type="text/css" rel="stylesheet"/>-->
<!--        <script src="../editor.js"></script>-->
<!--        <link rel="stylesheet" type="text/css" href="../editor.css">-->
    </head>

<?php
$error = "";

if(isset($_SESSION['current_user_id'])){

    if(isset($_POST['submitPost'])){
        $img = $_FILES['image'];
        if($img['size'] == 0) {     //check if there is no img set
            $img_data = null;
            $user_id = $_SESSION['current_user_id'];
            $article = htmlentities($_POST['article']);
            $title = htmlentities($_POST['title']);
            $category_id = htmlentities($_POST['category']);
            date_default_timezone_set("Europe/Amsterdam");
            $date = date("Y-m-d H:i:s");
            $sql = "INSERT INTO article (user_id, article_title, article, article_img, category_id, date)
                    VALUES ('$user_id', '$title', '$article', '$img_data', '$category_id', '$date')";
            $result = mysqli_query($connection, $sql);

            echo "<script type='text/javascript'>alert('Uw artikel is succesvol geplaatst.')";
        } else{
            // Allow certain file formats
            $img = $_FILES['image']; //get file from html form
            if ($img['type'] != "image/png") {
                $error = "Sorry, only .PNG files are allowed.";
            } else {
                // Check file size
                if ($img['size'] > 2000000) {
                    $error = "Sorry, your file is too large. Max is 2 MB";
                } else {
                    $temp_img_name = $img['tmp_name']; //get temp filename and put it in temp variable
                    $img_data = mysqli_real_escape_string($connection, fread(fopen($temp_img_name,'rb'),$img['size'])); //get the raw data of the image in a variable to put in in database with blob value
                    $user_id = $_SESSION['current_user_id'];
                    $article = htmlentities($_POST['article']);
                    $title = htmlentities($_POST['title']);
                    $category_id = htmlentities($_POST['category']);
                    date_default_timezone_set("Europe/Amsterdam");
                    $date = date("Y-m-d H:i:s");
                    $sql = "INSERT INTO article (user_id, article_title, article, article_img, category_id, date)
                    VALUES ('$user_id', '$title', '$article', '$img_data', '$category_id', '$date')";
                    $result = mysqli_query($connection, $sql);

                    echo "Uw artikel is succesvol geplaats!";
                }   // end of else
            }   // end of else
        }// end of if statement image is set or not
    }   // end of if statement submit form
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="well well-sm">
                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                        <fieldset>
                            <legend class="text-center">Post Article</legend>

                            <!-- Name input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="name">Title : </label>
                                <div class="col-md-9">
                                    <input type="text" name="title" placeholder="Type here your article title..." class="form-control" required>
                                </div>
                            </div>

                            <!-- Image input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="image">Image : </label>
                                <div class="col-md-9">
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>

                            <!-- Category input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="name">Category : </label>
                                <div class="col-md-9">
                                    <?php
                                    $sql = "SELECT * FROM category ORDER BY id";
                                    $result = mysqli_query($connection,$sql);
                                    $selected_venue_id = "";
                                    echo "<select name = 'category' class=\"form-control\" required>";
                                    ?>
                                    <option selected disabled value="">Choose your category</option>
                                    <?php
                                    while (($row = mysqli_fetch_array($result)) != null)
                                    {
                                        echo "<option value = '{$row['id']}'";
                                        if ($selected_venue_id == $row['id'])
                                            echo "selected = 'selected'";
                                        echo ">{$row['name']}</option>";
                                    }
                                    echo "</select required>";?>
                                </div>
                            </div>

<!--                             Message body -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Article</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" rows="10" cols="30" maxlength="250" name="article" placeholder="Type here your article..." required></textarea>
                                </div>
                            </div>
                            <!-- Message texteditor test -->
<!--                            <div class="form-group">-->
<!--                                <label class="col-md-3 control-label">Article</label>-->
<!--                                <div class="col-md-9">-->
<!--                                    <textarea id="txtEditor" name="txtEditor" required></textarea>-->
<!--                                    <textarea id="txtEditorContent" name="article" maxlength="250" hidden="" required></textarea>-->
<!--                                </div>-->
<!--                            </div>-->
                            <!-- Form actions -->
                            <div class="form-group">
                                <div class="col-md-6 text-left">
                                    <?php if(!empty($error)){echo '<p class="alert alert-danger">'. $error. '</p>';} ;?>
                                </div>
                                <div class="col-md-6 text-right">
                                    <input type="submit" class="btn btn-success btn-sm" name="submitPost" value="Post">
                                </div>
                            </div>
                            <div>
                                <div class="col-md-12">
                                    <a href="../index.php">Ga terug</a>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php


}else{  //else van eerste if. if session user isset
    redirect_to("../login/login.php");
}

?>
<script type="text/javascript" src="../jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../editor.js"></script>

<script language="javascript" type="text/javascript">

    $(document).ready( function() {
        $("#txtEditor").Editor();

        $("input:submit").click(function(){
            $('#txtEditorContent').text($('#txtEditor').Editor("getText"));

        });

    });
</script>
