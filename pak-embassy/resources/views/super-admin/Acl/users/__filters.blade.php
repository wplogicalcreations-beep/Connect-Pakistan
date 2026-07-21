<div class="col-lg-8 col-md-12">
    <x-filter-search-box :columns="['name', 'phone', 'email']" tableId="usersTable" paginationContainer="pagination-container" />
</div>
<div class="col-lg-4 col-md-12 text-end my-3 mt-md-0 pe-4 btn-resp">
    <button type="button" id="exportExcel" class="btn btn-outline-secondary border-2 button-style mb-md-2">Excel</button>
    <button type="button" id="exportPDF" class="btn btn-outline-secondary border-2 button-style mb-md-2">PDF</button>
    <button type="button" id="exportPrint" class="btn btn-outline-secondary border-2 button-style mb-md-2">Print</button>
    <button type="button" class="btn btn-common-bg mb-md-2" data-bs-target="#exampleModalToggle3"
            data-bs-toggle="modal" data-bs-dismiss="modal">+ Add New User</button>
</div>
