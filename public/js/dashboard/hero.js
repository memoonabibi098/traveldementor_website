const heroSections = {
    home: [
        { name: 'tag', type: 'text', label: 'Tag' },
        { name: 'title', type: 'text', label: 'Title' },
        { name: 'description', type: 'textarea', label: 'Description' },
        { name: 'primary_image', type: 'file', label: 'Primary Image' },
        { name: 'secondary_image', type: 'file', label: 'Secondary Image' },
        { name: 'counters', type: 'repeater', label: 'Counters', fields: ['value', 'label'] },
        { name: 'client_reviews', type: 'repeater', label: 'Client Reviews', fields: ['name', 'picture', 'designation', 'rating', 'total_reviews'] },
    ],
    about: [
        { name: 'tag', type: 'text', label: 'Tag' },
        { name: 'title', type: 'text', label: 'Title' },
        { name: 'description', type: 'textarea', label: 'Description' },
        { name: 'primary_image', type: 'file', label: 'Primary Image' },
        { name: 'secondary_image', type: 'file', label: 'Secondary Image' },
        { name: 'experience_badges', type: 'repeater', label: 'Experience Badges', fields: ['value', 'label'] },
    ],
    services: [
        { name: 'tag', type: 'text', label: 'Tag' },
        { name: 'title', type: 'text', label: 'Title' },
        { name: 'description', type: 'textarea', label: 'Description' },
        { name: 'primary_image', type: 'file', label: 'Primary Image' },
        { name: 'secondary_image', type: 'file', label: 'Secondary Image' },
    ],
    visa_status: [
        { name: 'tag', type: 'text', label: 'Tag' },
        { name: 'title', type: 'text', label: 'Title' },
        { name: 'description', type: 'textarea', label: 'Description' },
        { name: 'primary_image', type: 'file', label: 'Primary Image' },
        { name: 'secondary_image', type: 'file', label: 'Secondary Image' },
    ],
    faqs: [
        { name: 'tag', type: 'text', label: 'Tag' },
        { name: 'title', type: 'text', label: 'Title' },
        { name: 'description', type: 'textarea', label: 'Description' },
        { name: 'primary_image', type: 'file', label: 'Primary Image' },
        { name: 'secondary_image', type: 'file', label: 'Secondary Image' },
    ],
    contact: [
        { name: 'tag', type: 'text', label: 'Tag' },
        { name: 'title', type: 'text', label: 'Title' },
        { name: 'description', type: 'textarea', label: 'Description' },
        { name: 'primary_image', type: 'file', label: 'Primary Image' },
        { name: 'secondary_image', type: 'file', label: 'Secondary Image' },
    ],
    // ... other pages
};

document.addEventListener('DOMContentLoaded', function () {
    const pageSelect = document.getElementById('pageSelect');
    const container = document.getElementById('heroFormContainer');

    pageSelect.addEventListener('change', function () {
        const selectedPage = this.value;
        container.innerHTML = '';

        if (!selectedPage || !heroSections[selectedPage]) return;

        heroSections[selectedPage].forEach(field => {
            let html = '';
            switch (field.type) {
                case 'text':
                    html = `<div class="mb-3">
                                <label class="form-label">${field.label}</label>
                                <input type="text" class="form-control" name="${field.name}">
                            </div>`;
                    break;
                case 'textarea':
                    html = `<div class="mb-3">
                                <label class="form-label">${field.label}</label>
                                <textarea class="form-control" name="${field.name}" rows="3"></textarea>
                            </div>`;
                    break;
                case 'file':
                    html = `<div class="mb-3">
                                <label class="form-label">${field.label}</label>
                                <input type="file" class="form-control" name="${field.name}">
                            </div>`;
                    break;
                case 'repeater':
                    html = `<div class="mb-3 repeater-container" data-name="${field.name}">
                                <label class="form-label">${field.label}</label>
                                <div class="repeater-rows"></div>
                                <button type="button" class="btn btn-sm btn-primary add-row">+ Add ${field.label}</button>
                            </div>`;
                    break;
            }
            container.insertAdjacentHTML('beforeend', html);
        });

        // Initialize repeater buttons
        container.querySelectorAll('.add-row').forEach(button => {
            button.onclick = function () {
                const parent = button.closest('.repeater-container');
                const rowContainer = parent.querySelector('.repeater-rows');
                const fields = heroSections[selectedPage].find(f => f.name === parent.dataset.name).fields;
                const index = rowContainer.children.length;
                let rowHtml = '<div class="d-flex gap-2 mb-2">';
                fields.forEach(f => {
                    if (f === 'picture') {
                        rowHtml += `
                            <input type="file" class="form-control" name="${parent.dataset.name}[${index}][${f}]"> `;
                    } else {
                        rowHtml += `
                            <input type="text" class="form-control"  placeholder="${f}" name="${parent.dataset.name}[${index}][${f}]">`;
                    }
                });
                rowHtml += `<button type="button" class="btn btn-danger btn-sm remove-row">X</button></div>`;
                rowContainer.insertAdjacentHTML('beforeend', rowHtml);

                rowContainer.querySelectorAll('.remove-row').forEach(r => r.onclick = () => r.parentElement.remove());
            }
        });
    });
});
document.getElementById('pageSelect').addEventListener('change', function () {
    document.getElementById('pageKey').value = this.value;
});


// Open edit modal and populate data
document.querySelectorAll('.header-layout .fa-pencil').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const heroRow = btn.closest('.header-layout');
        const heroId = heroRow.dataset.heroId;
        const heroPageKey = heroRow.dataset.pageKey; // renamed variable

        fetch(`/hero/${heroId}/edit-json`) // make sure this returns JSON
            .then(res => res.json())
            .then(data => {
                  console.log(data); // ✅ check JSON in console
                const form = document.getElementById('heroEditForm');
                const container = document.getElementById('heroEditFormContainer');
                container.innerHTML = '';
                document.getElementById('editPageKey').value = heroPageKey;
                form.action = `/hero/${heroId}`;

                const fields = heroSections[heroPageKey];

                fields.forEach(field => {
                    let html = '';
                    const value = data[field.name] ?? '';

                    switch(field.type) {
                        case 'text':
                            html = `<div class="mb-3">
                                        <label class="form-label">${field.label}</label>
                                        <input type="text" class="form-control" name="${field.name}" value="${value}">
                                    </div>`;
                            break;
                        case 'textarea':
                            html = `<div class="mb-3">
                                        <label class="form-label">${field.label}</label>
                                        <textarea class="form-control" name="${field.name}" rows="3">${value}</textarea>
                                    </div>`;
                            break;
                        case 'file':
                            html = `<div class="mb-3">
                                        <label class="form-label">${field.label}</label>
                                        <input type="file" class="form-control" name="${field.name}">
                                    </div>`;
                            break;
                        case 'repeater':
                            html = `<div class="mb-3 repeater-container" data-name="${field.name}">
                                        <label class="form-label">${field.label}</label>
                                        <div class="repeater-rows"></div>
                                        <button type="button" class="btn btn-sm btn-primary add-row">+ Add ${field.label}</button>
                                    </div>`;
                            break;
                    }
                    container.insertAdjacentHTML('beforeend', html);

                    // Populate repeaters
                    if(field.type === 'repeater' && data[field.name]) {
                        const repeaterRows = container.querySelector(`[data-name="${field.name}"] .repeater-rows`);
                        data[field.name].forEach((row, index) => {
                            let rowHtml = '<div class="d-flex gap-2 mb-2">';
                            field.fields.forEach(f => {
                                if(f === 'picture') {
                                    rowHtml += `<input type="file" class="form-control" name="${field.name}[${index}][${f}]">`;
                                } else {
                                    rowHtml += `<input type="text" class="form-control" name="${field.name}[${index}][${f}]" value="${row[f] ?? ''}">`;
                                }
                            });
                            rowHtml += `<button type="button" class="btn btn-danger btn-sm remove-row">X</button></div>`;
                            repeaterRows.insertAdjacentHTML('beforeend', rowHtml);
                        });
                    }
                });
                new bootstrap.Modal(document.getElementById('editModal')).show();
            });
    });
});

