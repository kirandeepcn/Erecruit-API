<html>
    <title>
        Erecruit testing
    </title>
    <body>
        <form action="erecruit.php" method="post">
        Email: <input type="text" name="email" /> 
        Password: <input type="text" name="password" /> 
        <input type="submit" />
        </form>
        
        <form action="index.php" method="post">
        Email: <input type="text" name="email" /> 
        Latitude: <input type="text" name="lat" /> 
        Longitude: <input type="text" name="long" /> 
        <input type="hidden" name="type" value="add_loc" />
        <input type="submit" />
        </form>
        
        <form action="index.php" method="post">
        Email: <input type="text" name="email" />          
        <input type="hidden" name="type" value="get_loc" />
        <input type="submit" />
        </form>
        
    </body>
</html>