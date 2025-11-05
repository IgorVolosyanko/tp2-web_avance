{{ include('layouts/header.php', {title:'Selection'})}}
    <h1>Bibliothèque municipale</h1>
    <h3 style="color: green">Bienvenue {{nom}}. Veillez choisir vos livres pour emprunter.</h3>
    <main>
    <div class="contener-card">
        <aside class="filter" data-filtre>
          <a href="#" data-categorie="Tous">Tous</a>
          <a href="#" data-categorie="Nouveautés">Nouveautés</a>
          <a href="#" data-categorie="Littérature">Littérature</a>
          <a href="#" data-categorie="Art de vivre">Art de vivre</a>
          <a href="#" data-categorie="BD, Jeunesse, Humour"
            >BD, Jeunesse, Humour</a
          >
          <a href="#" data-categorie="Culture et société">Culture et société</a>
          <a href="#" data-categorie="Loisirs, Tourisme, Nature"
            >Loisirs, Tourisme, Nature</a
          >
          <a href="#" data-categorie="Savoir et science">Savoir et science</a>
        </aside>
        
        <div class="grid" data-conteneur-livres>
            
            {% for book in books %}
             
            <div class="card">
                <img src="{{asset}}{{book.image}}" alt="">
                <p>{{book.titre}}</p>               
                <form method="POST">
                    <input type="hidden" name="id" value="{{id}}">
                    <input type="hidden" name="titre" value="{{book.titre}}">
                    <input type="submit" value="Ajouter" class="btn">
                </form>                 
            </div>    
            
            {% endfor %}
            
        </div>
    </div>
        </main>
    <br><br>
    
    
{{ include('layouts/footer.php')}}