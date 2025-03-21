<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SkillsHUB</title>
    <style>
        body{
            padding:20px;
        }
        address{
            color:gray;
        }
    </style>
</head>

<body>
    <p>dear {{$name}},</p>
    <p>we glad to inform you that we received your email and we want to thank you for your feedback</p>
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">{{ $title }}</h1>
        </div>
        <div class="card-body p-0">
            <h6>{{ $body }}</h6>
        </div>
    </div>
    <address>
        Written by <a href="https://skillshub.epic-techs.com/">SkillsHUB</a>.<br>
        Visit us at:<br>
        skillshub.epic-techs.com<br>
        New Damietta, Damietta<br>
        EGYPT
    </address>
</body>

</html>
