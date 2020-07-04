<?php
    $slug = $_REQUEST['slug'];
    $json = substr(file_get_contents('js/list.js'), 13);
    $json = substr($json, 0,  -1);
    $list = json_decode($json, true);
    foreach($list as $v){
        if($v['slug'] == $slug){
            $t = $v;
            if(strlen($t['quote']) > 255){
                $t['quote'] = substr($t['quote'], 0, 255);
            }
            break;
        }else{
            $t['quote'] = "I think you'll find that I'm a pretty sweet deal.";
            $t['slug'] = "sweet-deal";
            $t['title'] = "Pretty Sweet Deal";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head prefix="og: http://ogp.me/ns#">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?=$t['title']?></title>
        <meta name="description" content="<?=$t['quote']?>">
        <meta property="og:type" content="website" />
        <meta property="og:title" content="<?=$t['title']?>" />
        <meta property="og:description" content="<?=$t['quote']?>" />
        <meta property="og:url" content="https://birdlaw.herokuapp.com/<?=$t['slug']?>" />
        <meta property="og:image" content="https://birdlaw.herokuapp.com/<?=$t['slug']?>.jpg" />
        <meta property="og:audio" content="https://birdlaw.herokuapp.com/<?=$t['slug']?>.ogg" />
        <meta name="theme-color" content="#000000">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
        <link rel="icon" type="image/png" href="/favicon-32x32.png?" sizes="32x32" />
        <link rel="icon" type="image/png" href="/favicon-16x16.png?" sizes="16x16" />
        <link rel="shortcut icon" href="/favicon.ico" />
        <link rel="alternate" hreflang="en" href="http://birdlaw.buzzell.me" />
        <link rel="canonical" href="https://birdlaw.herokuapp.com/<?=$t['slug']?>" />
        <link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Oswald:700,400' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/style.css">
        <!--[if lt IE 9]><script src="js/respond.js"></script><script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv-printshiv.min.js"></script><![endif]-->
    </head>
    <body>
        <audio class="clip" onPlaying="playState(1)" onpause="playState(2)" onended="playState(3)"></audio>
        <div class="menu">
            <div class="pp btn play">
                <div class="ring"></div>
            </div>
            <div class="random btn">
                <img alt="Random Quote" src="img/random.png" />
            </div>
            <div style="clear:both;"></div>
        </div>
        <div class="quoteBox center"></div>
        <div class="snapBG">
            <div class="snap"></div>
            <div class="overlay"></div>
        </div>
        <script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');ga('create', 'UA-40856113-4', 'auto');ga('send', 'pageview');</script>
        <!--[if lt IE 9]><script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script><![endif]-->
        <!--[if gte IE 9]><!--><script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script><!--<![endif]-->
        <script src="js/jm.js"></script>
        <script src="js/list.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>
