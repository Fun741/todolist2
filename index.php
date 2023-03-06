<?php
    require('model/database.php');
    require('model/category_db.php');
    require('model/item_db.php');

    $itemNum = filter_input(INPUT_POST, 'itemNum', FILTER_VALIDATE_INT);
    $Title = filter_input(INPUT_POST, 'Title', FILTER_UNSAFE_RAW);
    $description = filter_input(INPUT_POST, 'description', FILTER_UNSAFE_RAW);

    $category_name = filter_input(INPUT_POST, 'description', FILTER_UNSAFE_RAW);

    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

    if(!$category_id)
    {
        $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);        
    }

    $action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);
    if(!$action)
    {
        $action = filter_input(INPUT_GET, 'action', FILTER_UNSAFE_RAW);
        if(!$action)
        {
            $action = 'item_list';
        }
    }

    switch($action){
        case "list_categories":
            $category = get_categories();
            include('view/category_list.php');
            break;

        case "add_category":
            add_category($category_name);
            header("Location: .?action=list_categories");
            break;

        case "add_item":
            if($category_id && $description && $Title)
            {
                add_item($Title, $description, $category_id);
                header("Location: .?category_id=$category_id");
                break;
            }
            else
            {
                $error = "invalid item data. Check all fields.";
                include('view/error.php');
                exit();
            }
            break;

        case "delete_category":
            if($category_id)
            {
                try{
                    delete_category($category_id);
                }catch(PDOExeption){
                    $error = "you cannot delete a category if items exist in category.";
                    include('view/error.php');
                    exit();
                }
                header("Location: .?action=list_categories");
                break;
            }
            break;

        case "delete_item":
            if($itemNum){
                delete_item($itemNum);
                header("Location; .?category_id=$category_id");
                break;
            }
            break;
            
        default:
            $categoryName = get_category_name($category_id);
            $categories = get_categories();
            $items = get_item_by_catagory($category_id);
            include('view/item_list.php');
            break;
    }

?>