<?php
namespace Anax\View;
$filter = new \Anax\TextFilter\TextFilter;
/**
 * View to display all books.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());
// Gather incoming variables and use default values if not set
$questions = isset($questions) ? $questions : null;
// Create urls for navigation
$urlToCreate = url("questions/create");
$urlToDelete = url("questions/delete");
$urlToLogin = url("user/login");
$urlToRegister = url("user/create");
?>


<?php if (empty($di->session->get("login"))) : ?>
    <p>
        <p>You have to login to access this page.</p>
        <a href="<?= $urlToLogin ?>">Login</a> |
        <a href="<?= $urlToRegister ?>">Signup</a>
    </p>
    <hr>
<?php else : ?>
    <p>
        <button class="btn fullwidth" name="button" onclick="window.location.href = '<?= $urlToCreate ?>';">New Question</button>
    </p>
<?php endif; ?>
<?php foreach ($questions as $question) : ?>
    <?php $answer = $answers->findAllWhere("question_id = ?", $question->id); ?>
    <div style="max-width:98%" class="card question grid-container-question">
        <div class="grid-item rank">


        </div>
        <div class="grid-item question">
            <div class="product-container" style="text-align:center;">


            <a href="<?= url("questions/view/{$question->id}"); ?>">
            <h1><?= $question->title ?></h1>
            <p style="border-bottom:unset;" class="author">Posted at: <?= $question->created ?> </p>

            </a>
            <p>Answers: <?= count($answer) ?></p>

            <div class="tags">
                <?php $tags = explode(" ", $question->tags); ?>

                <?php foreach ($tags as $tag) : ?>
                    <?php $link=htmlentities($tag) ?>
                     <i style="color: #9d873f; padding: 4px;
                  font-size: 20px;" class="fa fa-tags ml-5"><a href=<?= url("tags/questions/{$link}") ?> class="tag"><?= $tag?></a></i>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>



<?php endforeach; ?>
