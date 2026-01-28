// const heroSections = {
//     home: [
//         { name: 'tag', type: 'text', label: 'Tag' },
//         { name: 'title', type: 'text', label: 'Title' },
//         { name: 'description', type: 'textarea', label: 'Description' },
//         { name: 'primary_image', type: 'file', label: 'Primary Image' },
//         { name: 'secondary_image', type: 'file', label: 'Secondary Image' },
//         { name: 'counters', type: 'repeater', label: 'Counters', fields: ['value', 'label'] },
//         { name: 'client_reviews', type: 'repeater', label: 'Client Reviews', fields: ['name', 'picture', 'designation', 'rating', 'total_reviews'] },
//     ],
//     about: [
//         { name: 'tag', type: 'text', label: 'Tag' },
//         { name: 'title', type: 'text', label: 'Title' },
//         { name: 'description', type: 'textarea', label: 'Description' },
//         { name: 'primary_image', type: 'file', label: 'Primary Image' },
//         { name: 'secondary_image', type: 'file', label: 'Secondary Image' },
//         { name: 'experience_badges', type: 'repeater', label: 'Experience Badges', fields: ['value', 'label'] },
//     ],
//     services: [
//         { name: 'tag', type: 'text', label: 'Tag' },
//         { name: 'title', type: 'text', label: 'Title' },
//         { name: 'description', type: 'textarea', label: 'Description' },
//         { name: 'primary_image', type: 'file', label: 'Primary Image' },
//         { name: 'secondary_image', type: 'file', label: 'Secondary Image' },
//     ],
//     visa_status: [
//         { name: 'tag', type: 'text', label: 'Tag' },
//         { name: 'title', type: 'text', label: 'Title' },
//         { name: 'description', type: 'textarea', label: 'Description' },
//         { name: 'primary_image', type: 'file', label: 'Primary Image' },
//         { name: 'secondary_image', type: 'file', label: 'Secondary Image' },
//     ],
//     faqs: [
//         { name: 'tag', type: 'text', label: 'Tag' },
//         { name: 'title', type: 'text', label: 'Title' },
//         { name: 'description', type: 'textarea', label: 'Description' },
//         { name: 'primary_image', type: 'file', label: 'Primary Image' },
//         { name: 'secondary_image', type: 'file', label: 'Secondary Image' },
//     ],
//     contact: [
//         { name: 'tag', type: 'text', label: 'Tag' },
//         { name: 'title', type: 'text', label: 'Title' },
//         { name: 'description', type: 'textarea', label: 'Description' },
//         { name: 'primary_image', type: 'file', label: 'Primary Image' },
//         { name: 'secondary_image', type: 'file', label: 'Secondary Image' },
//     ],
//     // ... other pages
// };

// document.addEventListener('DOMContentLoaded', function () {
//     const pageSelect = document.getElementById('pageSelect');
//     const container = document.getElementById('heroFormContainer');

//     pageSelect.addEventListener('change', function () {
//         const selectedPage = this.value;
//         container.innerHTML = '';

//         if (!selectedPage || !heroSections[selectedPage]) return;

//         heroSections[selectedPage].forEach(field => {
//             let html = '';
//             switch (field.type) {
//                 case 'text':
//                     html = `<div class="mb-3">
//                                 <label class="form-label">${field.label}</label>
//                                 <input type="text" class="form-control" name="${field.name}">
//                             </div>`;
//                     break;
//                 case 'textarea':
//                     html = `<div class="mb-3">
//                                 <label class="form-label">${field.label}</label>
//                                 <textarea class="form-control" name="${field.name}" rows="3"></textarea>
//                             </div>`;
//                     break;
//                 case 'file':
//                     const previewImg = value ? `<img src="${value}" class="w-50 mb-2 rounded" alt="preview">` : '';
//                     html = `<div class="mb-3">
//                                 <label class="form-label">${field.label}</label>
//                                 ${previewImg}
//                                 <input type="file" class="form-control" name="${field.name}">
//                             </div>`;
//                     break;
//                 case 'repeater':
//                     html = `<div class="mb-3 repeater-container" data-name="${field.name}">
//                                 <label class="form-label">${field.label}</label>
//                                 <div class="repeater-rows"></div>
//                                 <button type="button" class="btn btn-sm btn-primary add-row">+ Add ${field.label}</button>
//                             </div>`;
//                     break;
//             }
//             container.insertAdjacentHTML('beforeend', html);
//         });

//         // Initialize repeater buttons
//         container.querySelectorAll('.add-row').forEach(button => {
//             button.onclick = function () {
//                 const parent = button.closest('.repeater-container');
//                 const rowContainer = parent.querySelector('.repeater-rows');
//                 const fields = heroSections[selectedPage].find(f => f.name === parent.dataset.name).fields;
//                 const index = rowContainer.children.length;
//                 let rowHtml = '<div class="d-flex gap-2 mb-2">';
//                 fields.forEach(f => {
//                     if (f === 'picture') {
//                         rowHtml += `
//                             <input type="file" class="form-control" name="${parent.dataset.name}[${index}][${f}]"> `;
//                     } else {
//                         rowHtml += `
//                             <input type="text" class="form-control"  placeholder="${f}" name="${parent.dataset.name}[${index}][${f}]">`;
//                     }
//                 });
//                 rowHtml += `<button type="button" class="btn btn-danger btn-sm remove-row">X</button></div>`;
//                 rowContainer.insertAdjacentHTML('beforeend', rowHtml);

//                 rowContainer.querySelectorAll('.remove-row').forEach(r => r.onclick = () => r.parentElement.remove());
//             }
//         });
//     });
// });
// document.getElementById('pageSelect').addEventListener('change', function () {
//     document.getElementById('pageKey').value = this.value;
// });


// // Open edit modal and populate data
// document.querySelectorAll('.header-layout .fa-pencil').forEach(btn => {
//     btn.addEventListener('click', function (e) {
//         e.preventDefault();
//         const heroRow = btn.closest('.header-layout');
//         const heroId = heroRow.dataset.heroId;
//         const heroPageKey = heroRow.dataset.pageKey; // renamed variable

//         fetch(`/hero/${heroId}/edit-json`) // make sure this returns JSON
//             .then(res => res.json())
//             .then(data => {
//                 console.log(data); // ✅ check JSON in console
//                 const form = document.getElementById('heroEditForm');
//                 const container = document.getElementById('heroEditFormContainer');
//                 container.innerHTML = '';
//                 document.getElementById('editPageKey').value = heroPageKey;
//                 form.action = `/hero/${heroId}`;

//                 const fields = heroSections[heroPageKey];

//                 fields.forEach(field => {
//                     let html = '';
//                     const value = data[field.name] ?? '';

//                     switch (field.type) {
//                         case 'text':
//                             html = `<div class="mb-3">
//                                         <label class="form-label">${field.label}</label>
//                                         <input type="text" class="form-control" name="${field.name}" value="${value}">
//                                     </div>`;
//                             break;
//                         case 'textarea':
//                             html = `<div class="mb-3">
//                                         <label class="form-label">${field.label}</label>
//                                         <textarea class="form-control" name="${field.name}" rows="3">${value}</textarea>
//                                     </div>`;
//                             break;
//                         case 'file':
//                             const previewImg = value ? `<img src="${value}" style="width:20%; height:10%;" class=" mb-2 rounded" alt="preview">` : '';
//                             html = `<div class="mb-3">
//                                         <label class="form-label">${field.label}</label>
//                                         ${previewImg}
//                                         <input type="file" class="form-control" name="${field.name}">
//                                     </div>`;
//                             break;
//                         case 'repeater':
//                             html = `<div class="mb-3 repeater-container" data-name="${field.name}">
//                                         <label class="form-label">${field.label}</label>
//                                         <div class="repeater-rows"></div>
//                                         <button type="button" class="btn btn-sm btn-primary add-row">+ Add ${field.label}</button>
//                                     </div>`;
//                             break;
//                     }
//                     container.insertAdjacentHTML('beforeend', html);

//                     // Populate repeaters
//                     if (field.type === 'repeater' && data[field.name]) {


//                         field.fields.forEach(f => {
//                             if (f === 'picture') {
//                                 let imgPreview = row[f] ? `<img src="${row[f]}" class="w-50 rounded mb-2" alt="preview">` : '';
//                                 rowHtml += `
//             <div class="d-flex flex-column">
//                 ${imgPreview}
//                 <input type="file" class="form-control" name="${field.name}[${index}][${f}]">
//             </div>`;
//                             } else {
//                                 rowHtml += `<input type="text" class="form-control" name="${field.name}[${index}][${f}]" value="${row[f] ?? ''}" placeholder="${f}">`;
//                             }
//                         });

//                         const repeaterRows = container.querySelector(`[data-name="${field.name}"] .repeater-rows`);
//                         data[field.name].forEach((row, index) => {
//                             let rowHtml = '<div class="d-flex gap-2 mb-2">';
//                             field.fields.forEach(f => {
//                                 if (f === 'picture') {
//                                     let imgPreview = '';
//                                     if (row[f] && row[f] !== '') {
//                                         imgPreview = `<img src="${row[f]}" class="w-50 rounded mb-2" alt="preview">`;
//                                     }
//                                     rowHtml += `
//         <div class="d-flex flex-column">
//             ${imgPreview}
//             <input type="file" class="form-control" name="${field.name}[${index}][${f}]">
//         </div>`;
//                                 }

//                             });

//                             rowHtml += `<button type="button" class="btn btn-danger btn-sm remove-row">X</button></div>`;
//                             repeaterRows.insertAdjacentHTML('beforeend', rowHtml);
//                         });
//                     }
//                 });
//                 new bootstrap.Modal(document.getElementById('editModal')).show();
//             });
//     });
// });

const heroSections = {
    home: [
        { name: 'tag', type: 'text', label: 'Tag' },
        { name: 'title', type: 'text', label: 'Title' },
        { name: 'description', type: 'textarea', label: 'Description' },
        { name: 'primary_image', type: 'file', label: 'Primary Image' },
        { name: 'secondary_image', type: 'file', label: 'Secondary Image' },
        { name: 'counters', type: 'repeater', label: 'Counters', fields: ['value', 'label','suffix'] },
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
    bookconsultation: [
        { name: 'tag', type: 'text', label: 'Tag' },
        { name: 'title', type: 'text', label: 'Title' },
        { name: 'description', type: 'textarea', label: 'Description' },
        { name: 'primary_image', type: 'file', label: 'Primary Image' },
        { name: 'secondary_image', type: 'file', label: 'Secondary Image' },
    ],
    passportcollection: [
        { name: 'tag', type: 'text', label: 'Tag' },
        { name: 'title', type: 'text', label: 'Title' },
        { name: 'description', type: 'textarea', label: 'Description' },
        { name: 'primary_image', type: 'file', label: 'Primary Image' },
        { name: 'secondary_image', type: 'file', label: 'Secondary Image' },
    ],
    visaformfilling: [
        { name: 'tag', type: 'text', label: 'Tag' },
        { name: 'title', type: 'text', label: 'Title' },
        { name: 'description', type: 'textarea', label: 'Description' },
        { name: 'primary_image', type: 'file', label: 'Primary Image' },
        { name: 'secondary_image', type: 'file', label: 'Secondary Image' },
    ],
    docprecheck: [
        { name: 'tag', type: 'text', label: 'Tag' },
        { name: 'title', type: 'text', label: 'Title' },
        { name: 'description', type: 'textarea', label: 'Description' },
        { name: 'primary_image', type: 'file', label: 'Primary Image' },
        { name: 'secondary_image', type: 'file', label: 'Secondary Image' },
    ],
    mockinterview: [
        { name: 'tag', type: 'text', label: 'Tag' },
        { name: 'title', type: 'text', label: 'Title' },
        { name: 'description', type: 'textarea', label: 'Description' },
        { name: 'primary_image', type: 'file', label: 'Primary Image' },
        { name: 'secondary_image', type: 'file', label: 'Secondary Image' },
    ],
    meetgreet: [
        { name: 'tag', type: 'text', label: 'Tag' },
        { name: 'title', type: 'text', label: 'Title' },
        { name: 'description', type: 'textarea', label: 'Description' },
        { name: 'primary_image', type: 'file', label: 'Primary Image' },
        { name: 'secondary_image', type: 'file', label: 'Secondary Image' },
    ],
};

document.addEventListener('DOMContentLoaded', function () {
    const pageSelect = document.getElementById('pageSelect');
    const container = document.getElementById('heroFormContainer');

    // CREATE MODAL - Populate fields based on selected page
    pageSelect.addEventListener('change', function () {
        const selectedPage = this.value;
        container.innerHTML = '';
        document.getElementById('pageKey').value = selectedPage;

        if (!selectedPage || !heroSections[selectedPage]) return;

        heroSections[selectedPage].forEach(field => {
            let html = generateFieldHTML(field);
            container.insertAdjacentHTML('beforeend', html);

            if (field.type === 'repeater') {
                initRepeater(container, field);
            }
        });
    });

    // HELPER: Generate input HTML
    function generateFieldHTML(field, value = '') {
        let html = '';
        switch (field.type) {
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
                const previewImg = value ? `<img src="${value}" style="width:20%; height:10%;" class=" mb-2 rounded" alt="preview">` : '';
                html = `<div class="mb-3">
                            <label class="form-label">${field.label}</label>
                            ${previewImg}
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
        return html;
    }

    // HELPER: Initialize repeater fields
    function initRepeater(container, field, dataRows = []) {
        const repeaterContainer = container.querySelector(`[data-name="${field.name}"]`);
        const rowContainer = repeaterContainer.querySelector('.repeater-rows');

        // Populate existing rows
        if (dataRows.length) {
            dataRows.forEach((row, index) => {
                let rowHtml = '<div class="d-flex gap-2 mb-2">';
                field.fields.forEach(f => {
                    if (f === 'picture') {
                        const imgPreview = row[f] ? `<img src="${row[f]}" class="w-50 mb-2 rounded" alt="preview">` : '';
                        rowHtml += `<div class="d-flex flex-column">
                                        ${imgPreview}
                                        <input type="file" class="form-control" name="${field.name}[${index}][${f}]">
                                    </div>`;
                    } else {
                        rowHtml += `<input type="text" class="form-control" name="${field.name}[${index}][${f}]" value="${row[f] ?? ''}" placeholder="${f}">`;
                    }
                });
                rowHtml += `<button type="button" class="btn btn-danger btn-sm remove-row">X</button></div>`;
                rowContainer.insertAdjacentHTML('beforeend', rowHtml);
            });
        }

        // Add-row button
        repeaterContainer.querySelector('.add-row').onclick = () => {
            const index = rowContainer.children.length;
            let rowHtml = '<div class="d-flex gap-2 mb-2">';
            field.fields.forEach(f => {
                if (f === 'picture') {
                    rowHtml += `<input type="file" class="form-control" name="${field.name}[${index}][${f}]">`;
                } else {
                    rowHtml += `<input type="text" class="form-control" name="${field.name}[${index}][${f}]" placeholder="${f}">`;
                }
            });
            rowHtml += `<button type="button" class="btn btn-danger btn-sm remove-row">X</button></div>`;
            rowContainer.insertAdjacentHTML('beforeend', rowHtml);
            attachRemoveButtons(rowContainer);
        };

        attachRemoveButtons(rowContainer);
    }

    // Remove buttons
    function attachRemoveButtons(rowContainer) {
        rowContainer.querySelectorAll('.remove-row').forEach(btn => {
            btn.onclick = () => btn.parentElement.remove();
        });
    }
    const editModalEl = document.getElementById('editModal');
    const editModal = new bootstrap.Modal(editModalEl, { backdrop: 'static' }); // optional static backdrop
    // EDIT MODAL - open and populate
    // document.querySelectorAll('.header-layout .fa-pencil').forEach(btn => {
    //     btn.addEventListener('click', function (e) {
    //         e.preventDefault();
    //         const heroRow = btn.closest('.header-layout');
    //         const heroId = heroRow.dataset.heroId;
    //         const heroPageKey = heroRow.dataset.pageKey;

    //         fetch(`/hero/${heroId}/edit-json`)
    //             .then(res => res.json())
    //             .then(data => {
    //                 const form = document.getElementById('heroEditForm');
    //                 const container = document.getElementById('heroEditFormContainer');
    //                 container.innerHTML = '';
    //                 document.getElementById('editPageKey').value = heroPageKey;
    //                 form.action = `/hero/${heroId}`;

    //                 const fields = heroSections[heroPageKey];
    //                 fields.forEach(field => {
    //                     const value = field.type !== 'repeater' ? data[field.name] ?? '' : '';
    //                     const html = generateFieldHTML(field, value);
    //                     container.insertAdjacentHTML('beforeend', html);

    //                     if (field.type === 'repeater') {
    //                         initRepeater(container, field, data[field.name] ?? []);
    //                     }
    //                 });

    //                 new bootstrap.Modal(document.getElementById('editModal')).show();
    //             });
    //     });
    // });

    document.querySelectorAll('.edit-hero-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const heroRow = btn.closest('.header-layout');
            const heroId = heroRow.dataset.heroId;
            const heroPageKey = heroRow.dataset.pageKey;

            fetch(`/hero/${heroId}/edit-json`)
                .then(res => res.json())
                .then(data => {
                    const form = document.getElementById('heroEditForm');
                    const container = document.getElementById('heroEditFormContainer');
                    container.innerHTML = '';
                    document.getElementById('editPageKey').value = heroPageKey;
                    form.action = `/hero/${heroId}`;

                    const fields = heroSections[heroPageKey];
                    fields.forEach(field => {
                        const value = field.type !== 'repeater' ? data[field.name] ?? '' : '';
                        const html = generateFieldHTML(field, value);
                        container.insertAdjacentHTML('beforeend', html);

                        if (field.type === 'repeater') {
                            initRepeater(container, field, data[field.name] ?? []);
                        }
                    });

                    editModal.show();
                });
        });
    });
});
