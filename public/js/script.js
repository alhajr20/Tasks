function clickdelButton(e, formId) {
    e.preventDefault();
    if(confirm('Do you really want to delete this?')) {
        document.getElementById(formId).submit();
    }
}