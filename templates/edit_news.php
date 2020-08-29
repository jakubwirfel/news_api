<?php include 'inc/header.php';?>
<?php include 'inc/navbar.php';?>
    <main class="edit-container">
        <h1>Edit Test news 1 news</h1>
        <button class="btn" id="ToogleFieldset"><i class="fas fa-pen"></i> Edit</button>
        <form class="edit-form" method="POST" action="">
            <fieldset id="Fieldset" disabled>
            <div class="form-group">
                <label for="title">News title:</label>
                <input name="title" type="text" id="title" class="input-edit" value="<?php echo $news -> title?>"/>
            </div>
            <div class="form-group">
                <label for="content">News content:</label>
                <textarea name="content" id="content" rows="10" class="input-edit"><?php echo $news -> content?></textarea>
            </div>
            <div class="form-group">
                <div class="box">

                </div>
                <img src="<?php echo $news -> src?>" alt="<?php echo $news -> alt?>">
            </div>
            <input type="submit" name="update" value="Update" class="btn">
            </fieldset>
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
<script>
    var toogleFieldset = document.getElementById("ToogleFieldset");
    var fieldset = document.getElementById("Fieldset");
    toogleFieldset.addEventListener("click" , function(){
        if (fieldset.disabled == false) {
            fieldset.disabled = true;
        } else {
            fieldset.disabled = false;
        }
    });
</script>
<?php include 'inc/footer.php';?>
