<p style="text-align: center">Il y a actuellement <?= $nombreUsers ?> users. En voici la liste :</p>

<table>
  <tr><th>Nom</th><th>Prenom</th><th>Date d'ajout</th><th>Type</th><th>Email</th><th>Action</th></tr>
<?php
foreach ($listeUsers as $users)
{
  echo '<tr><td>', $users['nom'], '</td><td>', $users['prenom'],'</td><td>', $users['dateAjout']->format('d/m/Y à H\hi'),'</td><td>',$users['type'],'</td><td>',$users['email'],'</td><td><a href="user-update-', $users['id'], '.html"><img src="/images/update.png" alt="Modifier" /></a> <a href="user-delete-', $users['id'], '.html"><img src="/images/delete.png" alt="Supprimer" /></a></td></tr>', "\n";
}

?>
</table>
