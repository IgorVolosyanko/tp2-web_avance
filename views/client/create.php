{{ include('layouts/header.php', {title:'Nouveau Client'})}}
    
        
        {% if errors is defined %}
        <div class="error">
            <ul>
                {% for error in errors %}
                <li>{{ error }}</li>
                {% endfor %}
            </ul>
        </div>
        {% endif %}
    <div class="container">
        <form method="post">            
            <h2>Créer nouveau client</h2>
            <label>Nom
                <input type="text" name="nom" value="{{client.nom}}">
            </label>
            <label>Adresse
                <input type="text" name="adresse" value="{{client.adresse}}">
            </label>
            <label>Téléphon
                <input type="text" name="telephone" value="{{client.telephone}}">
            </label>
            <label>Courriel
                <input type="email" name="courriel" value="{{client.courriel}}">
            </label>
                    
            <input type="submit" class="btn" value="Sauvegarder">
        </form>
    </div> 

</html>

{{ include('layouts/footer.php')}}