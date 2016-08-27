<table id="student-table" class="table table-bordered table-striped datatable" role="grid" data-actions="{{ json_encode($actions['active']) }}" width="100%">
    <thead>
        <th>
            <div class="checkbox icheck">
                <input type="checkbox" name="checkall" />
            </div>
        </th>
        <th>NIM</th>
        <th>Nama</th>
        <th>Program studi</th>
        <th>Tahun masuk</th>
        <th>Aksi</th>
    </thead>
</table>

<div class="modal fade" data-backdrop="static" role="dialog" aria-labelledby="form-modal" id="student-import-form">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Import mahasiswa</h4>
            </div>
            <form class="ajax" method="post" action="/admin/student/student/import">
                <div class="modal-body">
                    @include('student.student.import-form')
                </div>
                <div class="modal-footer">
                    @section('form-button')
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('inoplate-foundation::labels.cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('inoplate-foundation::labels.form.save') }}</button>
                    @show
                </div>
            </form>
            <div class="overlay hide">
                <div class="loading">Loading..</div>
            </div>
        </div>
    </div>
</div>

@include('inoplate-media::library.finder')