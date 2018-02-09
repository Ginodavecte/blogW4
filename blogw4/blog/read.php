<?php session_start();?>
<?php include("../includes/database.php");?>
<?php include("../includes/functions.php");?>

<head>
    <meta charset="UTF-8">
    <title>Blog-lezen</title>
    <link rel="stylesheet" type="text/css" href="../stylesheets/style.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="../jquery-3.3.1.min.js"></script>
    <script src="../includes/functions.js"></script>
</head>
<body>
<?php
if(isset($_SESSION['current_user_id'])) {
?>
    <div class="container">
        <h1>Extra! Extra! Read All About It!</h1>
        <h3>
            <select name="category" id="category">
                <option value="">Show All Articles</option>
                <?php echo fill_category($connection); ?>
            </select>
            <br /><br />
            <div class="row" id="show_articles">

            </div>
        </h3>
        <a href="../index.php">Ga terug</a>
    </div> <!--eind div container -->
    <?php
    }else{  //else van eerste if. if session user isset
        redirect_to("../login/login.php");
    }
    ?>

</body>
<script>
    function loadData(select){
        var category_id = select.val();
        $.ajax({
            url:"post-read.php",
            method:"POST",
            data:{category_id:category_id},
            success:function(data){
                $('#show_articles').html(data);
            }
        });
    }
    $(document).ready(function(){
        $('#category').change(function(){
            loadData($(this));
        });

        loadData($("#category"));
    });
</script>
