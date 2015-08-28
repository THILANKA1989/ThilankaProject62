 <?php

 $term=$_GET["title"];
 
 $query=mysqli_query($connection,"SELECT title FROM books where title like '%".$term."%' order by title ");
 $json=array();
 
    while($books=mysql_fetch_array($query)){
         $json[]=array(
                    'value'=> $books["title"],
                    'label'=> $books["title"]
                        );
    }
 
 echo json_encode($json);

 ?>