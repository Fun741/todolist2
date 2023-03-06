<?php include('view/header.php'); ?>

<?php if($categories) { ?>
    <section id="list" class="list">
        <header class="list_row list_header">
            <h1>Category List</h1>
        </header>
        <?php foreach ($categories as $category) : ?>
            <div class="list_row">
                <div class="list_item">
                    <p class="bold"><?=$category['categoryName'] ?></p>
                </div>
                <div class="list_remove_category">
                    <form action="." method="post">
                        <input type="hidden" name="action" value="delete_category">
                        <input type="hidden" name="category_id" value="<?= $category["categoryID"] ?>">
                        <button class="remove button"></button>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
    </section>
<?php } else { ?>
    <p>No categories currently exist</p>
<?php } ?>

<section id="add" class="add">
    <h2>Add category</h2>
    <form action="." method="post" id="add_form" class="add_form">
        <input type="hidden" name="action" value="add_category">
        <div class="add_input">
            <label>Category:</label>
            <input type="text" name="category_name" maxlength="20" placeholder="category" autofocus required>
        </div>
        <div class="add_category">
            <button class="add_button_bold">Add</button>
        </div>
    </form>
</section>
    

<?php include('view/footer.php'); ?>