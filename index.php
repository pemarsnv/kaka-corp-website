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

<header>
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

 
    <div id="main-content">

    <div id="posts">

        <p id="any-news"> raconte ta vie un peu!! </p>
        <div id="new-post"> 
            <textarea id="text-new-post" maxlength=201 placeholder="mpreg gagged sigma skibidi"></textarea>
            <button id="btn-new-post"> *send twt* </button>
        </div>
        <div id="timeline">
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
                    echo "<div class='post'>";
                        echo "<div class='post-pfp'>";
                            echo "<img src='images/pfp/".$dataPosts['pfp']."' alt='".$dataPosts['pfp']."'/>";
                        echo "</div>";
                        echo "<div class='post-text' style='width:70% float:right'>";
                            echo "<p class='post-username'>".$dataPosts['username']."</p>";
                        echo "<div class='post-content'>";
                            echo "<p>".$dataPosts['content']."</p>";
                        echo "</div>";
                    echo "<div class='post-awoos'>";
                        echo "<p> ".$dataPosts['likes']." awoos! </p>";
                        echo "<button><img class='awoo-img' src='images/awoosnt.png'></button>";
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
    <div id="memories"> 
        <p> souvenirs </p>
    </div>
    <div id="weather"> 
         <p> météo </p>
    </div>
    <div id="music"> 
         <p> musique </p>
    </div>
    </div>
</body>
</html>