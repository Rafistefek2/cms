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