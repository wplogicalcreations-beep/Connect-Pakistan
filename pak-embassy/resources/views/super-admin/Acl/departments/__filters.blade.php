<div class="col-lg-7 col-md-12 px-2">
    <x-filter-search-box :columns="['name']" tableId="departmentsTable" paginationContainer="pagination-container" />
</div>
<div class="col-lg-5 col-md-12  my-3 mt-md-0  btn-resp gap-2 d-flex flex-wrap">
    <button type="button" class="btn btn-outline-secondary border-2 button-style flex-fill btn-excel mb-md-2">Excel</button>
    <button type="button" class="btn btn-outline-secondary border-2 button-style flex-fill btn-pdf mb-md-2">PDF</button>
    <button type="button" class="btn btn-outline-secondary border-2 button-style flex-fill btn-print mb-md-2">Print</button>
    <button type="button" class="btn btn-common-bg flex-fill me-2 mb-md-2" data-bs-toggle="modal"
            data-bs-target="#staticBackdropAdd">+ Add New Department</button>
</div>
