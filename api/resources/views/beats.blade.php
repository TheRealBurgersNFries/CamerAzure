<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }

            .demo_img{
                height:100px;
                width:100px;
                display:inline-block;
            }
        </style>
    </head>
    <body>
        <div class="container">
@if(Session::has('success'))
    <div class="alert-box success">
        <h2>{{ Session::get('success') }}</h2>
    </div>
@endif
<?php
    $colors = array("black", "blue", "gold", "green", "pink", "red");
?>
            <div class="content">
            <?php
            foreach($colors as $color){
                echo '<span><img class="demo_img" src="beats/'.$color.'.jpg"></span>';
            }
            ?>
            </div>
        </div>
    </body>
</html>
