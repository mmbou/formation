<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>


<h2>Ajouter un commentaire </h2>
<form id="form" action="/confirm-comment-insert-<?=$news?>.json" method="POST">
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
                        	$('#auteur').html('');
                        	$('#contenu').html('');
                        	$('#email').html('');

                             console.log(data);
                        if(data.code == 200)
                        {
                            $("#retour").show();
                            
                            if(data.data.checkbox == "on")
                            {
	                           	$('#retour').html('')
	                            .append('<b>Vous avez ajouté un nouveau commentaire :</b></br>')
	                            .append('<b>Auteur :</b></br>'+data.data.auteur+'</br>')
	                            .append('<b>Contenu :</b></br><i>'+data.data.contenu+'</i></br>')
	                        	.append('<b>Email :</b></br>'+data.data.email+'</br>')
	                            .append('<b>Option :</b></br><i>Recevoir email </i></br>');	
                            }
                            if(data.data.checkbox == null)
                            {
	                            $('#retour').html('')
	                            .append('<b>Vous avez ajouté un nouveau commentaire :</b></br>')
	                            .append('<b>Auteur :</b></br>'+data.data.auteur+'</br>')
	                            .append('<b>Contenu :</b></br><i>'+data.data.contenu+'</i></br>')
	                        	.append('<b>Email :</b></br>'+data.data.email+'</br>')
	                            .append('<b>Option :</b></br><i>Ne pas recevoir d\' email </i></br>');	
                            }
                            
                            
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