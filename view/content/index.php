<?php
namespace Anax\View;
$filter = new \Anax\TextFilter\TextFilter;
?>

<div class="outer-wrap outer-wrap-flash">
    <div class="inner-wrap inner-wrap-flash">
        <div class="row">
            <div class="region-flash">
                <img class="" src="image/theme/movie.jpg?width=1000&height=300&crop-to-fit&area=0,0,0,0">
            </div>
        </div>
    </div>
</div>




<h1 id="tja" style="text-align: center;">  Movie questions and answers </h1>
<p style="text-align:center;">Welcome to the forum of the Ask4Movie. We recommend you to look after the questions before making one.

Thank you for joining and enjoy!</p>

<h2 style="text-align: center;">What topics can I ask about here?</h2>
<p style="text-align:center;">Movies & TV Stack Exchange is for Movie & TV enthusiasts and experts alike!

If your question generally covers...</p>
<ul style="text-align: center;">
    <li>Questions about a movie or TV show's production</li>
    <li>Questions relating to the film and TV industry</li>
    <li>The works of a director/actor/writer related to movies & TV</li>
</ul>




<h2 style="text-align: center;">Latest questions</h2>
<?php foreach ($questions as $question) : ?>
    <?php $answer = $answers->findAllWhere("question_id = ?", $question->id); ?>
    <?php $comments = $comment->findAllWhere("questionID = ?", $question->id); ?>

        <div class="grid-item rank">
        </div>
        <div class="product-container">
            <a href="<?= url("questions/view/{$question->id}"); ?>">
                    <h3><?= $question->title ?></h3>
                    <p class="author">Posted at: <?= $question->created ?> </p>



            </a>
            <p style="margin-bottom:0;">Answers:
            <b style="color:#26df26;"><?= count($answer) ?></b></p>
            <?php $userComments = $comment->findAll() ?>
            <p>Comments: <b style="color:#26df26;"><?= count($userComments) ?></b></p>


            <div class="tags">
                <?php $tagsQuestion = explode(" ", $question->tags); ?>
                <?php foreach ($tagsQuestion as $tag) : ?>
                    <?php $link=htmlentities($tag) ?>
                     <p class="tags4">Tags: <a href=<?= url("tags/questions/{$link}") ?> class="tag"><i class="fa fa-tags ml-5"> <?= $tag ?></a></i></p>
                 </div>


                <?php endforeach; ?>

        </div>
<?php endforeach; ?>
<h2 style="text-align: center;">Most popular tags</h2>
<ul style="text-align: center;" class="tags">
<?php foreach ($tags as $tag) : ?>
    <?php $link=htmlentities($tag->tag) ?>
    <i style="color: #db1d1d; padding: 4px;
font-size: 23px;" class="fa fa-tags ml-5"> <a href=<?= url("tags/questions/{$link}") ?> class="tag"><?= $tag->tag ?></a></i>
<?php endforeach; ?>
</ul>

<h2 style="text-align: center;">Most active users</h2>

<div style="text-align: center;" class="grid-container">
<?php foreach ($users as $user) : ?>
    <div style="display: inline-block; text-align: center;" >
        <a href="<?= url("user/view/{$user->id}"); ?>">
        <img style="width:50px" alt="<?=$user->firstname ?>" src="https://www.gravatar.com/avatar/0c4cfef9aae14fe22e081aa62234df88?s=100&d=identicon&r=PG<?=md5(strtolower(trim($user->acronym)));?>"/>
        </a>
        <figcaption style="margin:5px;"><?= $user->firstname?><br> <?=$user->lastname?><br></figcaption>
        <br>




    </div>
<?php endforeach; ?>
</div>
</div>
</div>
</div>

<div class="grid-container">
    <!-- <div style="display: inline-block"> -->

<div class="borderdown">
    <?php $answer = $answers->findAll(); ?>
    <p style="margin:10px;">Answers: <?= count($answer) ?></p>
<?php $userComments = $comment->findAll() ?>
    <p style="margin:10px;">Comments: <?= count($userComments) ?></p>
<?php $userQues = $question3->findAll() ?>
    <p style="margin:10px;">Questions: <?= count($userQues) ?></p>



<!-- </div> -->
</div>
</div>
