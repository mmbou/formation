<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>


<h2>Ajouter une news </h2>
<form id="form" action="/admin/confirm-news-insert.json" method="POST">
  <p>
    <?= $form ?>
    
    <input type="submit" id="submit" value="Ajouter" />
  </p>
</form>

<div id="retour">
    <i></i>
</div>

<script type="text/javascript">
    $(document).ready(function() 
    {   
       $("#retour").hide();
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
                            $('#retour').html('');
                            $('#titre').html('');
                            $('#contenu').html('');

                             console.log(data);
                        if(data.code == 200)
                        {
                            $("#retour").show();
                            $('#retour').html('')
                            .append('<b>Vous avez ajouté une nouvelle news :</b></br>')
                            .append('<b>Titre :</b></br>'+data.data.titre+'</br>')
                            .append('<b>Contenu :</b></br><i>'+data.data.contenu+'</i></br>');
                        }
                        if(data.code == 100)
                        {

                            $("#retour").show();
                            
                            if(data.data.titre == '')
                            $("#titre").html('Entrer un titre'); 


                            if(data.data.contenu == '')
                            $("#contenu").html('Entrer un contenu'); 

                           
                            if(data.data.error == 'Error') 
                            {
                             $('#retour').html('')
                            .append('<b>Vous n\'êtes pas connecté </b></br>')  ; 

                            } 
                                               
                        }


                        }
                });
        });
    });   


</script>