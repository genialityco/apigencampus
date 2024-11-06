<html>
<!--    Keep this page lean as possible.-->

<head>
    <title>
        Certificado
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <link href="//cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet" />
    <style>

    </style>

    <style>
        @page {
            margin: 0px 0px 0px 0px !important;
            padding: 0px 0px 0px 0px !important;
        }

        @font-face {
            font-family: 'Rock Sans Bold';
            src: url('{{ storage_path("fonts/Rock Sans Bold.ttf") }}');
            font-weight: 400;
            font-style: normal;
        }

        body {

            background-size: contain;
            height: 100%;
            width: 100%;
            margin: 0;
            padding: 0;
            font-family: "Rock Sans Bold", "Verdana", "Geneva", "Sans serif", "Open Sans", "Titillium", "Oswald";
            /*font-family: Arial, Helvetica, sans-serif;*/
            font-size: 100px;
            color: #666;
        }

        .imagen {
            width: 3300px;
            height: 2550px;
            /*width: 1920px;
        height: 1080px;*/
            position: fixed;
            top: 0px;
            bottom: 0px;
            z-index: -100;
        }


        .containing-table {
            display: table;
            width: 97%;
            height: 70%;
        }

        .centre-align {
            display: table-cell;
            text-align: center;
            vertical-align: middle;
            width: 60%;
            font-size: 1em;
            padding-left: 7%;
        }

        .content {
            width: 60%;
            height: 70%;
            background-color: blue;
            display: inline-block;
            vertical-align: middle;
        }

        .ql-align-center {
            text-align: center !important;
        }

        .ql-align-right {
            text-align: right !important;
        }

        .ql-align-justify {
            text-align: justify !important;
        }

        .ql-size-huge {
            font-size: 2.5em !important;
        }

        .ql-size-large {
            font-size: 1.5em !important;
        }

        .ql-size-small {
            font-size: 0.75em !important;
        }

        a {
            text-decoration: underline;
        }

        p {
            font-size: 1.3rem;
        }

        h1 {
            font-size: 2em;
        }

        h2 {
            font-size: 1.5em;
        }

        h3 {
            font-size: 1.17em;
        }

        h4 {
            font-size: 1em;
        }

        h5 {
            font-size: 0.83em;
        }
    </style>
</head>

<body style="background-color: #FFFFFF; font-family: Rock Sans Bold, Arial, Helvetica, sans-serif;">

    <img class="imagen" src="{{ $image }}" />

    <div class="">
        <!--containing-table-->

        <div class="">{!! $content !!}
            <!--centre-align-->
        </div>
    </div>
</body>

</html>
