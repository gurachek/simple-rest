<html>
<head>
    <title>Title </title>
    <link rel="stylesheet" type="text/css" href="web/css/main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <h1 style="text-align: center; margin-top: 20px;">Simple REST</h1>
    <div class="main">
        <div class="menu">
            <ul>
                <li><a href="/">Main</a></li>
                <li><a href="/search">Search</a></li>
                <li><a href="/update">Update</a></li>
                <li><a href="/delete">Delete</a></li>
            </ul>
        </div>
        <div class="content">
            <?php include __DIR__ .'/../'. $content .'.php'; ?>
        </div>
    </div>
</body>
</html>