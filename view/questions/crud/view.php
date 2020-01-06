<?php
namespace Anax\View;
$filter = new \Anax\TextFilter\TextFilter;
$answers = isset($answers) ? $answers : null;
$urlToAnswer = url("answer/create");
$urlToLogin = url("user/login");
$urlToRegister = url("user/create");
$urlToComment = url("comment/create")
?>


<div style="max-width:98%" class="card">
    <div class="title">
        <div class="product-container" >

        <h1><?= $question->title ?></h1>


    <!-- </div> -->
    <div class="question">


        <p><?= $filter->doFilter($question->question, ["markdown"]); ?></p>
        <p style="border-bottom: unset;" class="author">Posted at: <?= $question->created ?> </p>
        <p style="border-bottom: unset;" class="author">By: <a href="<?= url("user/"); ?>"><?= $user->acronym?></a></p>
    </div>

    <?php if (empty($di->session->get("login"))) : ?>
        <p>
            <p>You have to login to access this page.</p>
            <a href="<?= $urlToLogin ?>">Login</a> |
            <a href="<?= $urlToRegister ?>">Signup</a>
        </p>
    <?php else : ?>
        <p><button style="float:right" class="btn orange" name="button" onclick="window.location.href = '<?=$urlToComment."/".$question->id. "/". "question_id"?>';">Comment</button></p>
        <p><button style="float:right" class="btn orange" name="button" onclick="window.location.href = '<?=$urlToAnswer."/".$question->id?>';">Answer</button></p><br><br>

    </div>
</div>

<?php foreach ($questionComment as $questionComment) : ?>
    <div style="float:right; max-width:70%; min-width:70%" class="cardscomment">

        <p><?= $filter->doFilter($questionComment->comment, ["markdown"]); ?></p>
        <p class="author">Comment By: <a href="<?= url("user/"); ?>"><?= $questionComment->username ?></a></p>
    </div>
<?php endforeach; ?>

<h1 style = "clear:both;">Answer: <?= count($answers) ?></h1>
<?php foreach ($answers as $answer) : ?>

<div style="max-width:98%" class="card green">
    <div class="product-container" style="text-align:unset;">

    <div style="" class="answer">
        <p><?= $filter->doFilter($answer->answer, ["markdown"]); ?></p>

        <p class="author" >Answered By:  <a href="<?= url("user/"); ?>"><?= $answer->username ?></a><?php if ($di->session->get("user")) : ?><img width="20px" style="margin-left:10px; border-radius: 30px;" class="round" alt="" src="https://www.gravatar.com/avatar/0c4cfef9aae14fe22e081aa62234df88?s=100&d=identicon&r=PG<?=md5(strtolower(trim($di->session->get("user"))));?>"/></p>
        <?php endif; ?>
    <button   class="btn orange" name="button" onclick="window.location.href = '<?=$urlToComment."/".$answer->id. "/". "answerID"?>';">Comment</button>
</div>

</div>





<div  class="cardscomment">

    <?php  $comments = $comment->findAllWhere("answerID = ?", $answer->id) ?>

    <?php foreach ($comments as $comments) : ?>

        <p><?= $filter->doFilter($comments->comment, ["markdown"]); ?></p>
        <p class="author">Comment By: <a href="<?= url("user/"); ?>"><?= $comments->username ?></a></p>

    <?php endforeach; ?>
</div>
<?php endforeach; ?>
<?php endif; ?>
