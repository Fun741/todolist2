<?php
//3 functions crud

function get_item_by_catagory($category_id)
{
    global $db;
    if($category_id)
    {
        
        $query = 'SELECT i.itemNum, i.Title, i.Description, c.categoryName FROM todoitems i
                    LEFT JOIN categories c ON i.categoryID = c.categoryID
                    WHERE i.categoryID = :category_id ORDER BY i.itemNum';
        
    }
    else
    {
        
        $query = 'SELECT i.Title, i.Description, c.categoryName FROM todoitems i
                    LEFT JOIN categories c ON i.categoryID = c.categoryID
                    ORDER BY categoryID';
        
    }

    //$query = 'SELECT * FROM categories';

    $statement = $db->prepare($query);
    if($category_id) 
    {
        $statement->bindValue(':category_id', $category_id);
    }
    $statement->execute();
    $items = $statement->fetchAll();
    $statement->closeCursor();
    return $items;
}

//same as get_item_by_catagory exept use itemNum insed of categoryID
//function get_item($itemNum) 

function delete_item($itemNum)
{
    global $db;
    $query = 'DELETE FROM todoitems WHERE itemNum = :itemNum';


    $statement = $db->prepare($query);
    $statement->bindValue(':itemNum', $itemNum);
    $statement->execute();
    $statement->closeCursor();
}

function add_item($title, $description, $category_id)
{
    global $db;

    $query = 'INSERT INTO todoitems (Title, Description, categoryID)
                VALUES (:Title, :description, :categoryID)';


    $statement = $db->prepare($query);

    $statement->bindValue(':Title', $title);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':categoryID', $category_id);

    $statement->execute();
    $statement->closeCursor();    
}

?>