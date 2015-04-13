<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function()
    { 
        console.log("kikou");
        $('#retour').hide();
        $("#submit").click(function(){
            $.post(
                '/admin/confirm-news-insert.json', // Un script PHP que l'on va créer juste après
                {
                    titre : $("#titre").val(),  
                    contenu : $("#contenu").val()
                },

                function(data)
                {

                    console.log("CallBack");
                  $('#retour').html(
                        "NAME : "+data["titre"]+" </br> "+"CONTENU :"+data['contenu']+"</br>"
                    );
                    if(data.success == true)
                    {
                        console.log("Success");
                    } 
                    else
                    {
                        console.log("Error")
                    }
                },

                'json' 
             );
        return false; 
        });


    });


</script>

<h2>Ajouter une news </h2>
<form id="form" method="post">
  <p>
    <?= $form ?>
    
    <input type="submit" id="submit" value="Ajouter" />
  </p>
</form>

<div id="retour">
    <i>vide</i>
</div>

