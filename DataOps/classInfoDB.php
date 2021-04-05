<?php
function get_ClassInfo($crn) {
    global $db;
    $query = 'SELECT * FROM ClassInfo
              WHERE CRN = :crn';
    $statement = $db->prepare($query);
    $statement->bindValue(':crn', $crn);
    $statement->execute();
    $statement->closeCursor();
    echo $statement;
    return $statement;    
}


function getProf($crn) {
    global $db;
    $query = 'SELECT Professor FROM ClassInfo
              WHERE CRN = :crn';
    $statement = $db->prepare($query);
    $statement ->bindValue(':crn', $crn);
    $statement->execute();
    $statement->closeCursor();
    return $statement;
}


/*
function get_category_name($category_id) {
    global $db;
    $query = 'SELECT * FROM categories
              WHERE categoryID = :category_id';    
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();    
    $category = $statement->fetch();
    $statement->closeCursor();    
    $category_name = $category['categoryName'];
    return $category_name;
}
*/
?>
