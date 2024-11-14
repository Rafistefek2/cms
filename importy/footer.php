
<div id="toast"></div>

<script defer src="/cms/js/mdb.umd.min.js"></script>
<script>
    function dawajTosta(message, position, type) {
        const toast = document.getElementById("toast");
        toast.className = toast.className + " show";
        console.log("pokazuje")

        if (message) toast.innerText = message;

        if (position !== "") toast.className = toast.className + ` ${position}`;
        if (type !== "") toast.className = toast.className + ` ${type}`;

        setTimeout(function () {
            toast.className = toast.className.replace(" show", "");
            console.log("znika")
        }, 2000);    //?  czas musi się zgrywać z fadeout animation w pliku css/tosty.css
    }
</script>
    <?php get_message()?>
</body>
</html>