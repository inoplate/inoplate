<table id="class-table" class="table table-bordered table-striped datatable" role="grid" data-actions="{{ json_encode($actions['active']) }}" width="100%">
    <thead>
        <th>
            <div class="checkbox icheck">
                <input type="checkbox" name="checkall" />
            </div>
        </th>
        <th>Kode</th>
        <th>Nama</th>
        <th>Mata kuliah</th>
        <th>Dosen pengampu</th>
        <th>Periode akademik</th>
        <th>Aksi</th>
    </thead>
</table>

<div class="modal fade" data-backdrop="static" role="dialog" aria-labelledby="form-modal" id="class-create-form">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah kelas baru</h4>
            </div>
            <form class="ajax" method="post" action="/admin/academic/class">
                <div class="modal-body">
                    @include('academic.class.form')
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
<div class="modal fade" data-backdrop="static" role="dialog" aria-labelledby="form-modal" id="class-update-form">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update kelas</h4>
            </div>
            <form class="ajax" method="post">
                <input type="hidden" name="_method" value="put" />
                <div class="modal-body">
                    @include('academic.class.form')
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