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
                height:170px;
                width:170px;
                display:inline-block;
                margin:20px;
            }
            #selected{
                border: 20px solid blue;
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
            if (isset($search_result)){
                echo $search_result;
            }
            foreach($colors as $color){
                $formatting = "";
                if(isset($results)) {
                echo $results;
                    if(in_array($color, $results)){
                        $formatting = ' id="selected" ';
                }   
                }
                
                echo '<span><img class="demo_img" '.$formatting.'src="beats/'.$color.'.jpg"></span>';
            }
            ?>
            </div>

        <div id="img_upload">
            <form action="beat_post" method="post" enctype="multipart/form-data">
                Select image to upload:
                <input type="file" name="image_request" id="image_request">

                <input type="submit" value="Upload Image" name="submit">
            </form>
        </div>
        </div>
    </body>
</html>
