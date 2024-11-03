/* EASY COPY CREDIT SCRIPT*/
jQuery(document).ready(function($) {
    const defaultTemplate = easyCopyCredit.defaultTemplate;
    const templates = easyCopyCredit.templates;
    const pageUrl = easyCopyCredit.pageUrl;
    const pageTitle = easyCopyCredit.pageTitle || "The Center for Nutritional Psychology";
    const postType = $("body").data("post-type");
    let template = templates[postType] || defaultTemplate;

    const citation = template.replace("[page_title]", pageTitle).replace("[page_url]", pageUrl);

    $(document).on('copy', function(event) {
        const selection = window.getSelection();
        const selectedText = selection.toString();

        const textCitation = selectedText + "\n\n" + citation;
        const htmlCitation = selection.rangeCount > 0 ? selection.getRangeAt(0).cloneContents() : null;
        const div = document.createElement("div");
        if (htmlCitation) div.appendChild(htmlCitation);
        div.innerHTML += citation.replace(/\n/g, "<br>");

        event.originalEvent.clipboardData.setData('text/plain', textCitation);
        event.originalEvent.clipboardData.setData('text/html', div.innerHTML);
        event.preventDefault();
    });
});
