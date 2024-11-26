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
        // case 'underline':
        //     wrapWithTag(range, 'u');
        //     break;
        case 'headone':
            wrapWithTag(range, 'h1');
            break;
        case 'headtwo':
            wrapWithTag(range, 'h2');
            break;
        case 'createlink':
            const url = prompt('Enter the URL:');
            if (url) wrapWithTag(range, 'a', { href: url });
            console.log("rub link")
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
    //? [pgrubienia <b>]
    html = html.replace(/<b>(.*?)<\/b>/g, (_, boldContent) => `**${boldContent}**`);

    //? kursywa <i>
    html = html.replace(/<i>(.*?)<\/i>/g, (_, italicContent) => `*${italicContent}*`);

    //? nagłówki się robią <h1> i wgl nwm czy h3 to chce dzialac wreszcie czy nie
    html = html.replace(/<h1>(.*?)<\/h1>/g, (_, headingContent) => `# ${headingContent}\n`);
    html = html.replace(/<h2>(.*?)<\/h2>/g, (_, headingContent) => `## ${headingContent}\n`);
    html = html.replace(/<h3>(.*?)<\/h3>/g, (_, headingContent) => `### ${headingContent}\n`);

    //? gpt jakos zrobil że linki mają działać 
    //todo (do testa)
    html = html.replace(/<a href="(.*?)">(.*?)<\/a>/g, (_, url, linkText) => `[${linkText}](${url})`);

    //? br mowi samo za siebie
    html = html.replace(/<br\s*\/?>/g, '\n');

    //? ten caly contenteditable jakies dziwne divy robi to je wywalic trzeba
    html = html.replace(/<div>(.*?)<\/div>/gs, (_, divContent) => `\n${divContent.trim()}\n\n`);

     //? nienaiwdze list nienawidze list
    html = html.replace(/<ul>(.*?)<\/ul>/gs, (_, listContent) => {
        return `\n` + listContent.replace(/<li>(.*?)<\/li>/g, (_, listItemContent) => {
            return `- ${listItemContent.trim()}\n`;
        }) + `\n`;
    });

    //? jeszcze bardziej nienawidze list jeszcze bardziej nienawidze list
    html = html.replace(/<ol>(.*?)<\/ol>/gs, (_, listContent) => {
        let counter = 0; // Reset the counter for each <ol>
        return `\n` + listContent.replace(/<li>(.*?)<\/li>/g, (_, listItemContent) => {
            counter++;
            const cleanContent = listItemContent
                .replace(/&nbsp;/g, ' ') //? czasami się robią takie spacje dziwne
                .trim(); //? wywala puste miejsca
            // return `${counter}. ${cleanContent}\n`; 
            return counter + '. ' + cleanContent + '\n'
        }) + `\n`;
    });

    //? wywala inne tagi jeśli są
    html = html.replace(/<[^>]+>/g, '');

    return html.trim();
}

document.getElementById('przeslij').addEventListener('click', () => {
    const myString = htmlToMarkdown(document.querySelector("#output").innerHTML);

    
    //? się robi formularz i sam wysyła ale heca
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'data';
    input.value = myString;

    document.querySelector("#form").appendChild(input);
    document.querySelector('#form').submit();
});