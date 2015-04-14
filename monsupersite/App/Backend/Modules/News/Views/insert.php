<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>


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


                             console.log(data);
                        if(data.code == 200)
                        {
                            $("#retour").show();
                            $("#retour").append('<b>Vous avez ajouté une nouvelle news :</b></br>');
                            $("#retour").append('<b>Titre :</b></br>'+data.data.titre+'</br>');
                            $("#retour").append('<b>Contenu :</b></br><i>'+data.data.contenu+'</i></br>');
                        }
                        if(data.code == 100)
                        {
                            $("#retour").show();
                            
                            if(data.data.titre == '')
                            $("#retour").append('<b>Entrer un titre </b></br>'); 


                            if(data.data.contenu == '')
                            $("#retour").append('<b>Entrer un contenu </b></br>');                           
                        }


                        }
                });
        });
    });   


</script>