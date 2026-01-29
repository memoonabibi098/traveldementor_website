   let counterIndex = 1;

    document.getElementById('add-counter').addEventListener('click', function () {
        const wrapper = document.getElementById('counter-wrapper');

        const row = document.createElement('div');
        row.classList.add('row', 'counter-row', 'mb-2');

        row.innerHTML = `
            <div class="col-md-3">
                <input type="number" name="counters[${counterIndex}][value]" class="form-control" placeholder="Value" required>
            </div>
            <div class="col-md-2">
                <input type="text" name="counters[${counterIndex}][suffix]" class="form-control" placeholder="+ / %">
            </div>
            <div class="col-md-4">
                <input type="text" name="counters[${counterIndex}][label]" class="form-control" placeholder="Apply / Approved">
            </div>
            <div class="col-md-2">
                <input type="number" name="counters[${counterIndex}][order]" class="form-control" value="1">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger remove-counter">×</button>
            </div>
        `;

        wrapper.appendChild(row);
        counterIndex++;
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-counter')) {
            e.target.closest('.counter-row').remove();
        }
    });