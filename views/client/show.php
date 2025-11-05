{{ include('layouts/header.php', {title:'Client Show'})}}


<div class="grid" >
   <div style="max-width: 200px">
      <h3>Réservation de {{name}}</h3>
      <p>La durée de prêt est : <br> {{duration}} jours </p> 
   </div>        
                                  
    {% for book in books %}
      {% if book.id %}
        <div class="card">
            <img src="{{asset}}{{book.image}}" alt="img">
            <h3>{{book.titre}}</h3>
            <p style="max-width: 200px">{{book.description}}</p>
            <form method="POST">               
               <input type="hidden" name="client" value="{{id}}">  
               <input type="hidden" name="book" value="{{book.id}}">                  
               <input type="submit" value="Supprimer" class="btn" style="max-width: 200px">
            </form>              
        </div> 
      {% endif %}  
    {% endfor %}   
   
 </div>
{{ include('layouts/footer.php')}}