<!--
Author: W3layouts
Author URL: http://w3layouts.com
-->
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Произошла ошибка</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords"
          content="Fog error web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <!-- //Meta tag Keywords -->

    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Sofia+Sans+Semi+Condensed:wght@400;700&display=swap" rel="stylesheet">

    <!-- //google fonts -->

    <!--/Style-CSS -->
    <link rel="stylesheet" href="/errors/css/style.css" type="text/css" media="all" />
    <!--//Style-CSS -->

    <!--/fontAwesome-CSS -->
    <link rel="stylesheet" href="/errors/css/fontAwesome.css" type="text/css" media="all" />
    <!--/fontAwesome-CSS -->
</head>

<body>
<div class="w3l-error-block">

    <div class="page">
        <div class="content">
            <div class="logo">
                <a class="brand-logo" href="new.html">Fog Error</a>
                <!--if logo is image enable this
           <a class="brand-logo" href="#new.html">
               <img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
           </a>
       -->
            </div>
            <div class="w3l-error-grid">
                <h1>404</h1>
                <h2>Произошла ошибка</h2>
                <!--<p><b>Номер ошибки:</b> <?= $errno ?></p>
                <p><b>Текст ошибки:</b> <?= $errstr ?></p>
                <p><b>Файл с ошибкой:</b> <?= $errfile ?></p>
                <p><b>Строка, в которой произошла ошибка:</b> <?= $errline ?></p>-->
                <!--<p>I tried to catch some fog, but i missed it</p>-->
                <a href="new.html" class="home">На главную</a>
            </div>

            <div class="copy-right text-center">
                <p>© 2020 Fog error. All rights reserved | Design by
                    <a href="http://w3layouts.com/" target="_blank">W3layouts</a></p>
            </div>
        </div>
        <img src="/errors/images/bg.jpg" class="img-responsive" alt="error image" />
    </div>

    <script src="/errors/js/jquery-3.3.1.min.js"></script>
    <script>
        var lFollowX = 0,
            lFollowY = 0,
            x = 0,
            y = 0,
            friction = 1 / 30;

        function animate() {
            x += (lFollowX - x) * friction;
            y += (lFollowY - y) * friction;

            translate = 'translate(' + x + 'px, ' + y + 'px) scale(1.1)';

            $('img').css({
                '-webit-transform': translate,
                '-moz-transform': translate,
                'transform': translate
            });

            window.requestAnimationFrame(animate);
        }

        $(window).on('mousemove click', function (e) {

            var lMouseX = Math.max(-100, Math.min(100, $(window).width() / 2 - e.clientX));
            var lMouseY = Math.max(-100, Math.min(100, $(window).height() / 2 - e.clientY));
            lFollowX = (20 * lMouseX) / 100; // 100 : 12 = lMouxeX : lFollow
            lFollowY = (10 * lMouseY) / 100;

        });

        animate();
    </script>
</div>
</body>

</html>