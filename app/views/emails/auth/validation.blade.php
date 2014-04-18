<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Email validation</h2>

<div>
    To validate you email, go to the following url: {{ URL::to('validation/'.$id.'/'.$token) }}.
</div>
</body>
</html>