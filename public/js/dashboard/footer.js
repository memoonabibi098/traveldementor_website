let footerLinkIndex = 1; // Start from 1 because 0 already exists

document.getElementById('addFooterLink').addEventListener('click', function () {
    const container = document.getElementById('footerLinksContainer');

    const row = document.createElement('div');
    row.className = 'row mb-2 footer-link-row';
    row.innerHTML = `
        <div class="col-5">
            <input type="text" name="company_links[${footerLinkIndex}][title]" class="form-control" placeholder="Link Title">
        </div>
        <div class="col-5">
            <input type="text" name="company_links[${footerLinkIndex}][url]" class="form-control" placeholder="/privacy-policy">
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-danger removeFooterLink">
                <i class="fa fa-trash"></i>
            </button>
        </div>
    `;
    container.appendChild(row);

    footerLinkIndex++;
});

// Remove link
document.addEventListener('click', function (e) {
    if (e.target.closest('.removeFooterLink')) {
        e.target.closest('.footer-link-row').remove();
    }
});



document.getElementById('editAddFooterLink').addEventListener('click', function () {
    const container = document.getElementById('editFooterLinksContainer');
    const index = container.children.length;
    const row = document.createElement('div');
    row.className = 'row mb-2 footer-link-row align-items-center';
    row.innerHTML = `
        <div class="col-5">
            <input type="text" name="company_links[${index}][title]" class="form-control" placeholder="Link Title">
        </div>
        <div class="col-5">
            <input type="text" name="company_links[${index}][url]" class="form-control" placeholder="/privacy-policy">
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-danger removeFooterLink">
                <i class="fa fa-trash"></i>
            </button>
        </div>
    `;
    container.appendChild(row);
});

// Remove link
document.addEventListener('click', function (e) {
    if (e.target.closest('.removeFooterLink')) {
        e.target.closest('.footer-link-row').remove();
    }
});

