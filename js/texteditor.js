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
    // Handle bold text (<b>)
    html = html.replace(/<b>(.*?)<\/b>/g, (_, boldContent) => `**${boldContent}**`);

    // Handle italic text (<i>)
    html = html.replace(/<i>(.*?)<\/i>/g, (_, italicContent) => `*${italicContent}*`);

    // Handle headings (<h1>, <h2>, <h3>)
    html = html.replace(/<h1>(.*?)<\/h1>/g, (_, headingContent) => `# ${headingContent}\n`);
    html = html.replace(/<h2>(.*?)<\/h2>/g, (_, headingContent) => `## ${headingContent}\n`);
    html = html.replace(/<h3>(.*?)<\/h3>/g, (_, headingContent) => `### ${headingContent}\n`);

    // Handle links (<a>)
    html = html.replace(/<a href="(.*?)">(.*?)<\/a>/g, (_, url, linkText) => `[${linkText}](${url})`);

    // Handle line breaks (<br>)
    html = html.replace(/<br\s*\/?>/g, '\n');

    // Handle divs (treat as blocks or paragraphs)
    html = html.replace(/<div>(.*?)<\/div>/gs, (_, divContent) => `\n\n${divContent.trim()}\n\n`);

     // Handle unordered lists (<ul> and <li>)
    html = html.replace(/<ul>(.*?)<\/ul>/gs, (_, listContent) => {
        return `\n` + listContent.replace(/<li>(.*?)<\/li>/g, (_, listItemContent) => {
            return `- ${listItemContent.trim()}\n`;
        }) + `\n`; // Add newline after the entire list
    });

    // Handle ordered lists (<ol> and <li>)
    html = html.replace(/<ol>(.*?)<\/ol>/gs, (_, listContent) => {
        let counter = 0; // Reset the counter for each <ol>
        return `\n` + listContent.replace(/<li>(.*?)<\/li>/g, (_, listItemContent) => {
            counter++;
            const cleanContent = listItemContent
                .replace(/&nbsp;/g, ' ') // Decode non-breaking spaces
                .trim(); // Trim whitespace
            // return `${counter}. ${cleanContent}\n`; // Add a new line after each list item
            return counter + '. ' + cleanContent + '\n'
        }) + `\n`; // Add newline after the entire list
    });

    // Remove any remaining HTML tags
    html = html.replace(/<[^>]+>/g, ''); // Strip any remaining HTML

    // Trim and return the
    return html.trim();
}

document.getElementById('przeslij').addEventListener('click', () => {
    const myString = htmlToMarkdown(document.querySelector("#output").innerHTML);

    // Create and submit a form programmatically

    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'data';
    input.value = myString;

    document.querySelector("#form").appendChild(input);
    document.querySelector('#form').submit();
});