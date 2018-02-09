<?php session_start();?>
<?php include("../includes/database.php");?>
<?php include("../includes/functions.php");?>
<head>
    <meta charset="UTF-8">
    <title>Categorie toevoegen</title>
    <link rel="stylesheet" type="text/css" href="../stylesheets/style.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="../includes/functions.js"></script>
    <script src="../jquery-3.3.1.min.js"></script>
</head>

<?php
$error = "";
if(isset($_POST['submitAddCategory'])) {
    $new_category = $_POST['new_category'];
    $sql = "SELECT * FROM category WHERE name = '$new_category'";
    $result = mysqli_query($connection, $sql);

    if ($result->num_rows < 1) {

            $sql = "INSERT INTO category(name) VALUES ('$new_category')";
            $result = mysqli_query($connection, $sql);
            $message = "New category is added.";
            echo "<script type='text/javascript'>alert('$message');
            function newDoc() {
             document.location.assign('http://localhost/blogw3/blog/read.php');
                }
                newDoc();
            </script>";
    }else{
        $error = "De gekozen categorie naam bestaat al.";
    }
} // end of if submitAddCategory
?>
<div class="container">
    <div class="col-md-5">
        <div class="form-area">
            <form method="post">
                <br style="clear:both">
                <h3 style="margin-bottom: 25px; text-align: center;">Voeg een category toe</h3>
                <div class="form-group">
                    <input type="text" maxlength="25" class="form-control" name="new_category" placeholder="Add Category name here..." required>
                </div>
                <div class="form-group">
                    <select name="category" id="category">
                        <option value="">Bestaande categorien</option>
                        <?php echo fill_category($connection); ?>
                    </select>
                </div>
                <button type="submit" name="submitAddCategory" class="btn btn-primary pull-right">Toevoegen</button>
            </form><div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?><br>
            <a href="../index.php">Ga terug!</a>
        </div>
    </div>
</div>