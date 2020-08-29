<?php include 'inc/header.php';?>
<?php include 'inc/navbar.php';?>
    <main class="edit-container">
        <h1>Edit <?php echo $news -> title?> news</h1>
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
            <div class="form-group">
                <div class="box">
                <label >Contributors:</label>
                </div>
                <p>
                    <?php foreach($contributorsList as $contributor) {
                            if($contributor -> news_id === $news -> id) {
                                echo $contributor -> name . ",   ";
                            }
                        }
                    ?>
                </p>
            </div>
            <div class="form-group">
                <div class="search">
                    <label for="search">Add contributor:</label>
                    <input class="input-edit" id="search" type="text" autocomplete="off" placeholder="Search contributor..."/>
                    <input hidden id="userId" name="contributor">
                    <div class="result">
                    </div>
                </div>
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
<script>
    $(document).ready(function(){
    $('.search input[type="text"]').on("keyup input", function(){
        var inputVal = $(this).val();
        var name = '<?php echo $_SESSION['username']?>';
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("helpers/search_handler.php", {term: inputVal, uName: name}).done(function(data){
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });

    $(document).on("click", ".result div", function(){
        $(this).parents(".search").find('input[type="text"]').val($('p',this).text());
        $(this).parents(".search").find('#userId').val($('#id',this).text());
        $(this).parent(".result").empty();
    });
});
</script>
<?php include 'inc/footer.php';?>
