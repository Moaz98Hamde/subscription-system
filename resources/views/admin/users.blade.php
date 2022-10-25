@extends('layouts.admin.master', ['page' => 'Dashboard'])

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/datatables/css/responsive.bootstrap4.min.css') }}" />
@endpush

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-primary" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    <table class="data-table table stripe hover nowrap">
        <thead>
            <tr>
                <th>name</th>
                <th>email</th>
                <th>status</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
@endsection

@push('scripts')
    <script src="{{ asset('src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>

    <script>
        $('document').ready(function() {
            $('.data-table').DataTable({
                processing: true,
                scrollCollapse: true,
                autoWidth: false,
                responsive: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('data-table.customers') }}",
                    method: "GET",
                    tryCount: 0,
                    retryLimit: 3,
                    error: function(xhr, error, thrown) {
                        this.tryCount++;
                        if (this.tryCount <= this.retryLimit) {
                            console.log(thrown);
                            $.ajax(this);
                        }
                    },
                    data: function(data) {
                    }
                },
                "columns": [{
                        data: function(data) {
                            return data.name;
                        },
                        name: 'name',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: function(data) {
                            return data.email;
                        },
                        name: 'email',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: function(data) {
                            return data.status;
                        },
                        name: 'status',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: function(data) {
                            return data.action;
                        },
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }

                ],
                deferRender: true,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "language": {
                    "info": "_START_-_END_ of _TOTAL_ entries",
                    searchPlaceholder: "Search",
                    paginate: {
                        next: '<i class="ion-chevron-right"></i>',
                        previous: '<i class="ion-chevron-left"></i>'
                    }
                },
            });
        });
    </script>
@endpush
