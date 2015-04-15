<p>Par <a href="/author-<?=$news['auteur']?>/<?=$auteur['nom']?>.html"><em><?=$auteur['nom']?></em></a>, le <?= $news['dateAjout']->format('d/m/Y à H\hi') ?></p>
<h2><?= $news['titre'] ?></h2>
<p><?= nl2br($news['contenu']) ?></p>

<?php if ($news['dateAjout'] != $news['dateModif']) { ?>
  <p style="text-align: right;"><small><em>Modifiée le <?= $news['dateModif']->format('d/m/Y à H\hi') ?></em></small></p>
<?php } ?>


<?php
if (empty($comments))
{
?>
<p>Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
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
 
<div id="comments"></div> 

 <p><a id="a" href="commenter-<?= $news['id'] ?>.html" onclick="return false;">Ajouter un commentaire</a></p>


<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() 
    {   

       $("#form").hide();
       $("#add").hide();
    
       $("#a").click(function(event)
        {


            event.preventDefault();

           var $this = $('a');
           
           $.ajax({
                        url: "commenter-<?= $news['id'] ?>.html", 
                        type: 'POST',
                        //data: $this.serialize(),
                        datatype : 'json',
                        success: function(data)
                        {

                             console.log(data);
                        if(data.code == 200)
                        {
                            $("#retour").show();
                            $("#form").show();
       						$("#add").show();
                            $('#retour').html(data.data.formulaire); 
                            
                        }
                        if(data.code == 100)
                        {
                         	$('#retour').html("Error process");   
                        }

                        }
                });



        });
    });   




</script>
<script type="text/javascript">
    $(document).ready(function() 
    {   
       $("#submit").click(function(event)
        {
            event.preventDefault();

           var $this = $('form');
           
           $.ajax({
                        url: $this.attr('action'), 
                        type: $this.attr('method'),
                        data: $this.serialize(),
                        datatype : 'json',
                        success: function(data)
                        {
                        	
                        	$('#auteur').html('');
                        	$('#contenu').html('');
                        	$('#email').html('');

                             console.log(data);
                        if(data.code == 200)
                        {
                       		$('#comments').append(data.data.f);
                            
                        }
                        if(data.code == 100)
                        {
                            $("#retour").show();
                            
                            if(data.data.auteur == '')
                            {
	                            $('#auteur').html('Entrer un nom pour l\' auteur');

                            }
                           


                            if(data.data.contenu == '')
                            {
	                            
	                           $('#contenu').html('Entrer un contenu '); 
                            }
                            


                            if(data.data.email == '')
                            {

	                            $('#email').html('Entrer une adresse mail ');
                            }
                           

                        	else if(validateEmail(data.data.email) == false)
                        	{
	                        	$('#email').html('Entrer une adresse au format mail (ex: JeanDupont@outlook.com)');
                        	}
                            



                        }

                        }
                });



        });
    });   


</script>

<script>
	function validateEmail(sEmail)
				{
				    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
				    if (filter.test(sEmail)) {
				        return true;
				    }
				    else {
				        return false;
				    }
				}
				
</script>


<h2 id="add">Ajouter un commentaire </h2>
<form id="form" action="/confirm-comment-insert-<?=$news['id']?>.json" method="POST">
  <div id="retour">
  </div>
  <input type="submit" id="submit" value="Ajouter" />
  <input type="reset" id="reset" value="Réinitialiser" />
</form>
