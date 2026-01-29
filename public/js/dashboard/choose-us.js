document.addEventListener('DOMContentLoaded', function () {

    let pointsWrapper = document.getElementById('pointsWrapper');
    let addPointBtn = document.getElementById('addPoint'); // fixed

    if (!pointsWrapper || !addPointBtn) return; // safeguard

    let pointIndex = 0;

    addPointBtn.addEventListener('click', function () {
        pointIndex++;

        let pointHTML = `
            <div class="card mb-3 point-item" data-index="${pointIndex}">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <strong>Point ${pointIndex}</strong>
                        <button type="button" class="btn btn-sm btn-danger remove-point">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Order</label>
                        <input type="number" name="points[${pointIndex}][order]" class="form-control" value="${pointIndex}" >
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Icon</label>
                        <input type="file" name="points[${pointIndex}][icon]" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Heading</label>
                        <input type="text" name="points[${pointIndex}][heading]" class="form-control" placeholder="Enter heading">
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Paragraph</label>
                        <textarea name="points[${pointIndex}][description]" class="form-control" rows="3"
                            placeholder="Enter description"></textarea>
                    </div>

                </div>
            </div>
        `;

        pointsWrapper.insertAdjacentHTML('beforeend', pointHTML);
    });

    // Remove point (event delegation)
    pointsWrapper.addEventListener('click', function (e) {
        if (e.target.closest('.remove-point')) {
            e.target.closest('.point-item').remove();
        }
    });





    document.querySelectorAll('.add-edit-point').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const sectionId = btn.dataset.section;
            const pointsWrapper = document.getElementById(`pointsWrapper-${sectionId}`);
            let pointIndex = pointsWrapper.querySelectorAll('.point-item').length;

            let pointHTML = `
                <div class="card mb-3 point-item" data-index="${pointIndex}">


                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <strong>Point ${pointIndex + 1}</strong>
                            <button type="button" class="btn btn-sm btn-danger remove-point">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Order</label>
                            <input type="number" name="points[${pointIndex}][order]" class="form-control" value="${pointIndex + 1}">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Icon</label>
                            <input type="file" name="points[${pointIndex}][icon]" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Heading</label>
                            <input type="text" name="points[${pointIndex}][heading]" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Paragraph</label>
                            <textarea name="points[${pointIndex}][description]" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            `;

            pointsWrapper.insertAdjacentHTML('beforeend', pointHTML);
        });
    });

    // Remove point
    document.addEventListener('click', function (e) {
        if (e.target.closest('.remove-point')) {
            e.target.closest('.point-item').remove();
        }
    });

});


