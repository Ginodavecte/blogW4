<head>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link href="../editor.css" type="text/css" rel="stylesheet"/>
    <script src="../editor.js"></script>
    <link rel="stylesheet" type="text/css" href="../editor.css">

</head>

<html lang="en">
<body>

<form id="form" name="form" method="post">
    <div class="col-lg-12 nopadding">
        <textarea id="txtEditor" name="txtEditor"></textarea>
        <textarea id="txtEditorContent" name="txtEditorContent" hidden=""></textarea>
    </div>
    <input type="submit" value="Go">
</form>

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
</body>
</html>
