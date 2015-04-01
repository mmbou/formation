<?php
if (empty($comments))
{
?>
<p>Aucun commentaire posté avec cet email!</p>
<?php
}

foreach ($comments as $comment)
{
?>
<fieldset>
  <legend>
    Posté par <a href="/commentauthor/<?= $comment['email'] ?>.html"><strong><?= htmlspecialchars($comment['auteur']) ?></strong></a> le <?= $comment['date']->format('d/m/Y à H\hi') ?>
    <?php if ($user->isAuthenticated() AND $user->getAttribute('type') == 1) { ?> -
      <a href="admin/comment-update-<?= $comment['id'] ?>.html">Modifier</a> |
      <a href="admin/comment-delete-<?= $comment['id'] ?>.html">Supprimer</a>
    <?php } ?>
  </legend>
  <p><?= nl2br(htmlspecialchars($comment['contenu'])) ?></p>
</fieldset>
<?php
}
?>

