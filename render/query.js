
    var queries = document.getElementsByClassName('query')
    for (var i = 0; i < queries.length; i++) {
        var query = queries[i]
        query.addEventListener('click', queryClicked)
    }
function queryClicked(event) {
    var button = event.target
    var shopItem = button.parentElement.parentElement
    var quiz = shopItem.getElementsByClassName('query')[0];
    window.location="query.html";
}
