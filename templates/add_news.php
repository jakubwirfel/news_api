<?php include 'inc/header.php';?>
<?php include 'inc/navbar.php';?>
    <main class="edit-container">
        <h1>Add news</h1>
        <form class="edit-form" method="POST" action="add.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">News title:</label>
                <input name="title" type="text" id="title" class="input-edit" required/>
            </div>
            <div class="form-group">
                <label for="content">News content:</label>
                <textarea name="content" id="content" rows="10" class="input-edit" required></textarea>
            </div>
            <div class="form-group">
                <div class="box">
                    <label for="image">Add image</label>
                    <input type="file" id="image" name="image" class="input-edit img-input">
                </div>
            </div>
            <input type="submit" name="add" value="Add" class="btn">
        </form>
    </main>
<script>
    window.onscroll = () => {
        const nav = document.querySelector('#navbar');
        if (this.scrollY <= 1) {
            nav.classList.add("navigation");
            nav.classList.remove("scroll");
        }
        else {
            nav.classList.add("scroll", "navigation");
        }
    };
</script>
<?php include 'inc/footer.php';?>
