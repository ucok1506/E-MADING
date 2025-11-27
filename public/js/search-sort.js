// Enhanced Search and Sort Functionality for E-Mading

document.addEventListener('DOMContentLoaded', function() {
    // Auto-submit form on filter change
    const filterSelects = document.querySelectorAll('select[name="sort"], select[name="kategori"], select[name="status"]');
    filterSelects.forEach(select => {
        select.addEventListener('change', function() {
            this.form.submit();
        });
    });

    // Search with debounce
    const searchInputs = document.querySelectorAll('input[name="q"], input[name="search"]');
    searchInputs.forEach(input => {
        let timeout;
        input.addEventListener('input', function() {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                if (this.value.length >= 3 || this.value.length === 0) {
                    // Auto-submit after 3 characters or when cleared
                    this.form.submit();
                }
            }, 500);
        });
    });

    // Highlight search terms in results
    const searchTerm = new URLSearchParams(window.location.search).get('q');
    if (searchTerm && searchTerm.length > 0) {
        highlightSearchTerms(searchTerm);
    }
});

function highlightSearchTerms(term) {
    const elements = document.querySelectorAll('.card-title, .card-text');
    const regex = new RegExp(`(${term})`, 'gi');
    
    elements.forEach(element => {
        if (element.textContent.toLowerCase().includes(term.toLowerCase())) {
            element.innerHTML = element.innerHTML.replace(regex, '<mark>$1</mark>');
        }
    });
}