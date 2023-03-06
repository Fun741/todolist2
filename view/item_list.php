<?php include('view/header.php'); ?>

<?php //section to display item to screen ?>
<section id="list" class="list">
    <header class="list_row_header">
        <h1>Item List</h1>
        <form action="." method="get" id="list_header_select" class="list_header_select">
            <input type="hidden" name="action" value="list_items">
            <select name="category_id" required>
                <option value="0">View All</option>
                <?php foreach($categories as $category) : ?>
                    <?php if($category_id == $category['categoryID']) { ?>
                        <option value="<?= $category['categoryID']; ?>" selected>
                    <?php } else { ?>
                        <option value="<?= $category['categoryID']; ?>">
                    <?php } ?>
                </option>
                <?php endforeach; ?>
            </select>
            <button class="add_button_bold">GO</button>
        </form>
    </header>
    <?php if($items) { ?>
        <?php foreach($items as $item) : ?>
            <div class="list_row">
                <div class="list_item">
                    <p class="bold"><?=$item['Title']; ?></p>
                    <p><?= $item['description']; ?></p>
                </div>
                <div class="list_removeItem">
                    <form action="." method="post">
                        <input type="hidden" name="action" value="delete_item">
                        <input type="hidden" name="itemNum" value="<?=$item['itemNum'] ?>">
                        <button class="remove_button">Remove</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php } else { ?>
        <br>
        <?php if($itemNum) { ?>
            <p>No tasks for this category.</p>
        <?php } else { ?>
            <p>No tasks currently.</p>
        <?php } ?>
        <br>
    <?php } ?>    
</section>
<br>
<?php //section to add item to db ?>

<section>
    <form action="." method="post" id="add_form" class="add_form">
        <input type="hidden" name="action" value="add_item">
        <div class="add_input">
            <label>Item:</label>
            <select name="item_id" required>
                <option value="">Please Select</option>
                <?php foreach ($items as $item) : ?>
                    <option value="<?= $item['itemNum']; ?>">
                        <?= $item['Title']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <label>Description:</label>
            <input type="text" name="description" maxlength="50" placeholder="desc" required>
        </div>
            <div class="add_additem">
                <button class="add-button-bold">add</button>
            </div>
    </form>
</section>
<p><a href=".?action=list_categories">View categories</a></p>
<?php include('view/footer.php'); ?>