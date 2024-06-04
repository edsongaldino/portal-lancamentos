<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        html,
        body {
        background-color: #ccc;
        overflow: hidden;
        height: 100%;
        width: 100%;
        }

        #iframe_container {
        background-color: #ffffff;
        padding: 0;
        height: 100%;
        width: 100%;
        overflow: visible;
        }

        #myiframe {
        overflow: scroll;
        border: 0;
        width: 100%;
        height: 100%;
        transform: scale(1);
        -ms-transform-origin: 0 0;
        -moz-transform-origin: 0 0;
        -o-transform-origin: 0 0;
        -webkit-transform-origin: 0 0;
        transform-origin: 0 0;
        }

        button {
        display: inline-block;
        }
    </style>
</head>
<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <button type="button" onclick="zoom(1)">- ZOOM OUT</button>
    <button type="button" onclick="zoom(-1)">+ ZOOM IN</button>
    <br>

    <iframe id="myiframe" src="http://localhost:8000/empreendimento/227/37/visualizar-mapa/mobile"></iframe>

</body>
<script>
    var w = $(window).width();
    var h = $(window).height();
    var scale = 1;

    function zoom(x) {
    if (x === -1) {
        scale = scale * 1.1;
        w = w * 0.9;
        h = h * 0.9;
        $("#myiframe").width(w + "px");
        $("#myiframe").height(h + "px")
    } else {
        scale = scale * 0.9;
        w = w * 1.1;
        h = h * 1.1;
        $("#myiframe").width(w + "px");
        $("#myiframe").height(h + "px")
    }

    $('#myiframe').css('transform', `scale(${scale})`);
    }
</script>
</html>