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
            <h2>Se connecter</h2>
            <label>Nom
                <input type="text" name="nom" value="{{user.nom}}">
            </label>
           
            <label>Courriel
                <input type="email" name="courriel" value="{{user.courriel}}">
            </label>
                    
            <input type="submit" class="btn" value="Se connecter">
        </form>
    </div> 

</html>

{{ include('layouts/footer.php')}}