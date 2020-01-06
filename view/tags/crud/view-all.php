<?php
namespace Anax\View;
/**
 * View to display all books.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());
// Gather incoming variables and use default values if not set
$tags = isset($tags) ? $tags : null;
?>
<h1  id="tja" style="text-align: center; border-bottom: 1px solid black !important;">  All tags </h1>
<p style="text-align:center;">Here you can see all tags that used in the forum. Our forum is free and will always be free. Sign up with your e-mail if you want to ask, comment ot answer questions!</p>
<?php
if (!$tags) : ?>
    <p>There are no tags to show.</p>
    <?php
    return;
endif;
?>
<ul class="tags">
    <?php foreach ($tags as $tag) : ?>
        <?php $link=htmlentities($tag->tag) ?>
         <li style="text-align:center;"> <i style="color: #9d873f; padding: 4px;
      font-size: 20px;" class="fa fa-tags ml-5"><a href=<?= url("tags/questions/{$link}") ?> class="tag"><?= $tag->tag ?></a></li></i>
    <?php  endforeach; ?>
</ul>
