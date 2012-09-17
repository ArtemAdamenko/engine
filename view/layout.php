<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta charset=”UTF-8?>
    <script src=”http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js”></script>
    <link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css">
    <title>Junior Engine</title>
</head>
<body>
<?php include_once('header.php')?>
<div class='container-fluid'>
    <div class="topbar-inner">
        <div class="container">
            <h3><a href="/about">Junior Engine</a></h3>
            <ul class="nav">
                <li class="active"><a href="/home">Home</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/page">Pages</a></li>
            </ul>
        </div>
    </div>
    <div id="content"><div class="hero-unit">
    <?=$page?>
    </div></div>

<?php include_once('footer.php')?>
</div>
</body>
</html>