console.log("motyw kurde");


document.addEventListener("DOMContentLoaded", () => {
    let colorThemes = document.querySelectorAll(".theme-input");
    console.log(colorThemes)

    //? pobrać motyw
    function storeTheme(themeId) {
        console.log(themeId);
        localStorage.setItem("selectedTheme", themeId);
    }


    colorThemes.forEach(themeOption => {
        themeOption.addEventListener("click", () => {
            console.log("listener dziala ");
            storeTheme(themeOption.id);
        });
    });

    //? ustawic motyw
    const retreveTheme = function(){
        const activeTheme = localStorage.getItem("selectedTheme");
        colorThemes.forEach(themeOption => {
            if (themeOption.id === activeTheme) {
                themeOption.checked = true;
            }
        })
    }

    document.onload = retreveTheme();
});

