
<div id="toast"></div>

<script defer src="/cms/js/menu.js"></script>      <!--  skrypt do zachowania górnej części strony -->
<script>
    function dawajTosta(message, position, type) {
    const toast = document.getElementById("toast");
    toast.className = toast.className + " show";
    console.log("pokazuje")

    if (message){ 
        toast.innerText = message;
    }


    if (position !== ""){ 
        toast.className = toast.className + ` ${position}`;
    }
    if (type !== ""){
        toast.className = toast.className + ` ${type}`;
    }

    setTimeout(function () {
        toast.className = toast.className.replace(" show", "");
    }, 2000);    //?  czas musi się zgrywać z fadeout animation w pliku css/tosty.css
}
</script>
    <?php get_message()?>
</body>
</html>