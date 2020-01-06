<?php
namespace Anax\View;
$user = isset($user) ? $user : null;
if (empty($di->session->get("login"))) {
    $urlToLogin = url("user/login");
    $urlToRegister = url("user/create");
    ?>
    <div style="text-align:center;" class="buttt">
        <h1>You have to login to access this page</h1>
        <button  class="btn" name="button" onclick="window.location.href = '<?= $urlToLogin ?>';">Login</button>
        <button class="btn" name="button" onclick="window.location.href = '<?= $urlToRegister ?>';">Signup</button>
    </div>
    <?php
} else {
    ?>
<div class='hr'>

</div>
<div class="inf">

        <h2> User Information </h2>
         <img class="profileimg" style="width: 100px;" alt="<?= $user->acronym ?>" src="https://www.gravatar.com/avatar/0c4cfef9aae14fe22e081aa62234df88?s=100&d=identicon&r=PG<?=md5(strtolower(trim($di->session->get("user"))));?>"/></br></br>
         <a class="icons" href="<?="user/update/{$user->id}"?>" title="Edit this information"><i class="fas fa-user-edit"></i></a>
        <p><b>Acronym:</b> <?= $user->acronym ?></p>
        <p><b>First Name:</b> <?= $user->firstname ?></p>
        <p><b>Last Name:</b> <?= $user->lastname ?></p>
        <p><b>Email/UserName:</b> <?= $di->session->get("user") ?></p>

        <form class="" action="user/logout" method="post">
            <input class="btn red fullwidth" type="submit" name="" value="Logga ut">
        </form>
    </div>

    <div class="grid-item">
        <?php  $userQuestions = $questions->findAllWhere("userID = ?", $user->id) ?>
        <?php $userAnswers = $answers->findAllWhere("userID = ?", $user->id) ?>
        <?php $userComments = $comments->findAllWhere("userID = ?", $user->id) ?>
        <div class="inf">
            <h2> User Activites </h2>

        <h4>Questions:  <?= count($userQuestions) ?></h4>
        <?php foreach ($userQuestions as $userQuestions) : ?>
            <p><a href="<?= url("questions/view/{$userQuestions->id}"); ?>"><?=  $userQuestions->title ?></a></p>
        <?php endforeach; ?>
        <h4>Answers: <?= count($userAnswers) ?></h4>
        <?php foreach ($userAnswers as $userAnswers) : ?>
            <p><a href="<?= url("questions/view/{$userAnswers->question_id}"); ?>"><?=  $userAnswers->answer ?></a></p>

        <?php endforeach; ?>
        <h4>Comments: <?= count($userComments) ?></h4>
        <?php foreach ($userComments as $userComments) : ?>
            <?php $link = $userComments->questionID ?: $userComments->answerID; ?>
            <p><a href="<?= url("questions/view/{$link}"); ?>"><?= $userComments->comment ?></a></p>
        <?php endforeach; ?>
    </div>
</div>


</div>

    <?php
}
