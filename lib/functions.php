<?php
echo "<main>";

$articles = file_get_contents( './data/posts.json' );
$articlesArray = json_decode($articles, true);

function cmp($a, $b)
{

    //https://stackoverflow.com/questions/8456029/how-does-usort-work
    if ($a["post_date"] == $b["post_date"]) 
    {
       return 0;
    }
    return ($a["post_date"] > $b["post_date"]) ? -1 : 1;
}

usort($articlesArray, "cmp");

foreach ($articlesArray as $singleArticle){
    echo "<div>";
    echo "<h1>$singleArticle[title]</h1>" 
    ."<p><em>". date('F j, y', $singleArticle['post_date']) ."</em></p>" 
    . "<p>by " .$singleArticle['author'] . '</p>'
    .$singleArticle['content'] . '<br/>'
    ."<strong> Categorized in: </strong>";

    
    echo ucwords(implode(", ", $singleArticle['category']));

    echo "</div>";
}

echo "</main>";
?>