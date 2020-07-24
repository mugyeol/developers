<!DOCTYPE html>

<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


    <script type="text/javascript" src="../../developers/exif-js-master/exif.js"></script>

    <style type="text/css">

        #testimg {

            transform-origin: top left; /* IE 10+, Firefox, etc. */

            -webkit-transform-origin: top left; /* Chrome */

            -ms-transform-origin: top left; /* IE 9 */

        }

        .rotate90 {

            transform: rotate(90deg) translateY(-100%);

            -webkit-transform: rotate(90deg) translateY(-100%);

            -ms-transform: rotate(90deg) translateY(-100%);

        }

    </style>

</head>

<body>




<img id="testimg" exif="true" src="../../developers/user_images/644769.jpg" style="display: none;"  alt="" />

<script>

    $("#testimg").load(function(){

        setTimeout(function(){

            var testimg = $("#testimg");

            if (testimg.exif("Orientation") == 6) {

                testimg.addClass("rotate90");

            }

            testimg.show();

        }, 500);

    });

</script>

</body>

</html>
