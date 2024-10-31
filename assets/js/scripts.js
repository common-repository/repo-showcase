// JavaScript function for pagination
var currentPage = 1;

function repoShowcaseChangePage(offset) {
    var pages = document.querySelectorAll('.repo-showcase-repository-page');
    currentPage += offset;

    if (currentPage < 1) {
        currentPage = 1;
    }

    if (currentPage > pages.length) {
        currentPage = pages.length;
    }

    for (var i = 0; i < pages.length; i++) {
        pages[i].style.display = 'none';
    }

    pages[currentPage - 1].style.display = 'block';
}
