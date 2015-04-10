<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function()
    { 
        console.log("kikou");
        $('#retour').hide();
        $("#submit").click(function(){
        
         $.post(
            '/admin/news-insert.json', // Un script PHP que l'on va créer juste après
            {
                titre : $("#titre").val(),  
                contenu : $("#contenu").val()
            },

                 function(data){


                     console.log('News add' );
                        $('#retour').html('')
                        .append('<b>Vous avez ajouter une news avec succès</b><br/>')
                        .append('<b>Titre</b> : '+data.titre+'<br/>')
                        .append('<b>Contenu</b> : '+data.contenu+'<br/>');
                        $('#retour').fadeIn();

    
                     // La news n'a pas été ajouté. (data vaut ici "failed")
                    console.log('News not add:'+ data);
                     $("#retour").html("<p>Erreur lors de l'ajout d'une news...</p>");

        
            },

            'text' // Nous souhaitons recevoir "Success" ou "Failed", donc on indique text !
         );
       
   
       return false; });


    });


</script>

<h2>Ajouter une news Ajax</h2>
<form id="form" method="post">
  <p>
    <?= $form ?>
    
    <input type="submit" id="submit" value="Ajouter" />
  </p>
</form>

<div id="retour">
    <i>vide</i>
</div>