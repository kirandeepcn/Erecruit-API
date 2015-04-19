# Erecruit-API

Test URL: http://www.wellspringinfotech.com/erecruit/test.php

1> Add Location: 
   URL-> http://www.wellspringinfotech.com/erecruit/index.php
   Post parameters ->
   -- type (value will be add_loc)
   -- email
   -- lat
   -- long
   
   Response ->
   {
      "log":"Success"
   }

2> Get Location: 
   URL-> http://www.wellspringinfotech.com/erecruit/index.php
   Post parameters ->
   -- type (value will be get_loc)
   -- email
   
   Response ->
   {
      "lat":"5.25541646",
      "long":"4.44545"
   }
