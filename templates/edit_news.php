<?php include 'inc/header.php';?>
<?php include 'inc/navbar.php';?>
    <main class="edit-container">
        <h1>Edit Test news 1 news</h1>
        <button class="btn" id="ToogleFieldset"><i class="fas fa-pen"></i> Edit</button>
        <form class="edit-form" method="POST" action="edit_news.php">
            <fieldset id="Fieldset" disabled>
            <div class="form-group">
                <label for="title">News title:</label>
                <input name="title" type="text" id="title" class="input-edit" value="Test news 1"/>
            </div>
            <div class="form-group">
                <label for="content">News content:</label>
                <textarea name="content" id="content" rows="10" class="input-edit">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odit sapiente, laboriosam quisquam sed mollitia vitae commodi sunt maxime tempora ducimus, non amet, voluptas reprehenderit laborum officiis doloremque. Repellendus, beatae possimus.</textarea>
            </div>
            <div class="form-group">
                <div class="box">
                    <label for="inputImage" >Change image</label>
                    <input type="file" id="image" name="image" class="input-edit img-input">
                </div>
                <img src="https://via.placeholder.com/300.png/09f/fffC/O https://placeholder.com/" alt="test">
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
