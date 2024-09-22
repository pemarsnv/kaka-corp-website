<?php

    require("functions.php");
    $pdo = createConnection();

?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title> la meute </title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="images/wolfy.ico">
</head>

<header id="menu">
    <div id="logo_site"></div>
    <nav>
    <ul id="headings">
        <li> accueil </li>
        <li> chats </li>
        <li> gaming </li>
        <li> profil </li>
    </ul>
    </nav>
</header>

<body> 
    <div id="divMainContent">
    <div id="divPosts">    
        <p id="anyNews"> raconte ta vie un peu!! </p>
        <div id="divNewPost"> 
            <textarea id="textNewPost" maxlength=201 placeholder="mpreg gagged sigma skibidi"></textarea>
            <button id="btnNewPost"> *send twt* </button>
        </div>
        <div id="divTimeline">
            <p> ce que les autres ont à dire </p>

            <?php

            $reqPosts = 'SELECT post.username as username, post.content as content, user.pfp_name as pfp, COUNT(likes.idPost) as likes
                        FROM post, user, likes 
                        WHERE user.username=post.username AND post.idPost = likes.idPost
                        GROUP BY post.idPost';
            $stmt = $pdo->prepare($reqPosts);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                while ($dataPosts = $stmt->fetch()) {
                    echo "<div class='divPost'>";
                        echo "<div class='divPostPfp'>";
                            echo "<img src='images/pfp/".$dataPosts['pfp']."' alt='".$dataPosts['pfp']."'/>";
                        echo "</div>";
                        echo "<div class='divPostText' style='width:70% float:right'>";
                            echo "<p class='postUsername'>".$dataPosts['username']."</p>";
                        echo "<div class='divPostContent'>";
                            echo "<p>".$dataPosts['content']."</p>";
                        echo "</div>";
                    echo "<div class='divPostAwoos'>";
                        echo "<p> ".$dataPosts['likes']." awoos! </p>";
                        echo "<button><img class='awooImg' src='images/awoosnt.png'></button>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
                }
            } else {
                echo $stmt->rowCount();
            }

            ?>

         </div>
    </div>
    <div id="divMemories"> 
        <p> souvenirs </p>
    </div>
    <div id="divWeather"> 
         <p> météo </p>
    </div>
    <div id="divMusic"> 
         <p> musique </p>
    </div>
    </div>
</body>
</html>