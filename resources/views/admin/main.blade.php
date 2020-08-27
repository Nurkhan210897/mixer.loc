<html>

<head>
    <title>Админка</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <script src="{{asset('js/app.js')}}" defer></script>
</head>

<body>
    <div id='adminPanel'>
        <layout-component :directory-types="{{$directoryTypes}}"></layout-component>
    </div>
</body>

</html>