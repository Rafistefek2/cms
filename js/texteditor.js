//! jesli zostanie zaznaczony ostatni element z textu formatowania nie da się
//! juz zatrzymac czy problem tak czy wiem jak naprawic nie


function wrapWithTag(range, tagName, attributes = {}) {
    const selectedText = range.extractContents();
    const wrapper = document.createElement(tagName);

    //? do linków
    Object.entries(attributes).forEach(([key, value]) => {
        wrapper.setAttribute(key, value);
    });

    //? zamykanie zaznaczonego w podany znacznik(wrapper)
    wrapper.appendChild(selectedText);
    range.insertNode(wrapper);
}

// function removeLink(range) {
//     const container = range.commonAncestorContainer;
//     const link = container.closest ? container.closest('a') : null;

//     if (link) {
//         const textNode = document.createTextNode(link.textContent);
//         link.replaceWith(textNode);
//     }
// }


function formatText(command) {
    const selection = window.getSelection();
    if (!selection.rangeCount) return;

    const range = selection.getRangeAt(0);

    switch (command) {
        case 'bold':
            wrapWithTag(range, 'b');
            console.log('bold')
            break;
        case 'italic':
            wrapWithTag(range, 'i');
            break;
        case 'underline':
            wrapWithTag(range, 'u');
            break;
        case 'headone':
            wrapWithTag(range, 'h1');
            break;
        case 'headtwo':
            wrapWithTag(range, 'h2');
            break;
        case 'headthree':
            wrapWithTag(range, 'h3');
            break;
        case 'createlink':
            const url = prompt('Enter the URL:');
            if (url) wrapWithTag(range, 'a', { href: url });
            break;
        case 'unlink':
            removeLink(range);
            break;
        case 'insertUnorderedList':
            insertList(range, 'ul');
            break;
        case 'insertOrderedList':
            insertList(range, 'ol');
            break;
        default:
            console.error('Unknown command:', command);
    }

}


function insertList(range, listType) {
    const selectedText = range.extractContents();
    const list = document.createElement(listType);
    const listItem = document.createElement('li');

    //? podobnie jak z wrapWithTag z dodaniem po drodze elementu li
    listItem.appendChild(selectedText);
    list.appendChild(listItem);
    range.insertNode(list);
}

function htmlToMarkdown(html) {
    //? pogrubienia
    html = html.replace(/<b>(.*?)<\/b>/g, '**$1**'); 

    //? pochylenia
    html = html.replace(/<i>(.*?)<\/i>/g, '*$1*'); 

    //? naglowki
    html = html.replace(/<h1>(.*?)<\/h1>/g, '# $1');
    html = html.replace(/<h2>(.*?)<\/h2>/g, '## $1');
    html = html.replace(/<h3>(.*?)<\/h3>/g, '### $1');

    //? link
    html = html.replace(/<a href="(.*?)">(.*?)<\/a>/g, '[$2]($1)');

    //? br mowi samo za siebie
    html = html.replace(/<br\s*\/?>/g, '\n');

    //? divy ktore powstaja przy tworzeniu nowej lini
    html = html.replace(/<div>(.*?)<\/div>/g, '\n\n$1\n\n');

    // Handle unordered lists (<ul> and <li>)
    html = html.replace(/<ul>(.*?)<\/ul>/gs, (match, content) => {
        return content.replace(/<li>(.*?)<\/li>/g, '- $1');
    });

    // Handle ordered lists (<ol> and <li>)
    html = html.replace(/<ol>(.*?)<\/ol>/gs, (match, content) => {
        let counter = 0;
        return content.replace(/<li>(.*?)<\/li>/g, () => {
            counter++;
            return `${counter}. $1`;
        });
    });

    // Handle nested lists (indentation for nested <ul> or <ol>)
    html = html.replace(/<\/li>\s*<ul>/g, '\n  '); // Add two spaces for nesting

    // Remove remaining HTML tags
    html = html.replace(/<[^>]+>/g, '');

    return html.trim();
}


document.querySelector("#wysylajdophp").addEventListener("click", ()=>{
    let data = document.querySelector("#output").innerHTML;
    let mdData = htmlToMarkdown(data)


    fetch(`processpost.php?data=${encodeURIComponent(mdData)}`)
    .catch(error => console.error('Error:', error));

    window.location.href = `/cms/importy/processpost.php?data=${encodeURIComponent(mdData)}`
});

