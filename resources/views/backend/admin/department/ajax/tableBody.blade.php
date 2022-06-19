<table class="table table-separate table-head-custom table-checkable table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th class="text-left">Department Name</th>
            <th>Status</th> 
            
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @if ($departments->count() > 0)
        @php
            $i = (($departments->currentPage() - 1) * $departments->perPage() + 1);
        @endphp
            @foreach ($departments as $department)
                <tr>
                    <td>
                        {{$i}}
                    </td>
                    
                    <td align="left">
                        {{$department->name}}
                    </td>

                    <td>
                        @if ($department->status == 1)
                            <span class="label label-lg font-weight-bold label-light-success label-inline">Active</span>
                        @elseif ($department->status == 0)
                            <span class="label label-lg font-weight-bold label-light-danger label-inline">Deleted</span>
                        @endif
                    </td>

                    <td>
                        @can('view_department')
                            <a href="{{route('admin.department.show', $department->id)}}" class="btn btn-sm btn-clean btn-icon" title="view">
                                <i class="la la-eye"></i>
                            </a>
                        @endcan
                        
                        @can('edit_department')
                            <a href="{{route('admin.department.edit', $department->id)}}" class="btn btn-sm btn-clean btn-icon" title="Edit">
                                <i class="la la-edit"></i>
                            </a>
                        @endcan

                        @can('delete_department')
                            <a href="{{route('admin.department.destroy', $department->id)}}"  onclick="return confirm('Are you sure?')" class="btn btn-sm btn-clean btn-icon" title="Delete" data-id="{{ $department->id }}">
                                <i class="la la-trash"></i>
                            </a>
                            {{-- @if ($department->status == 1)
                                <button class="btn btn-sm btn-clean btn-icon delete" title="Delete" data-id="{{ $department->id }}">
                                    <i class="la la-trash"></i>
                                </button>
                            @elseif ($department->status == 0)
                                <button class="btn btn-sm btn-clean btn-icon delete" title="Active" data-id="{{ $department->id }}">
                                    <i class="la la-check"></i>
                                </button>
                            @endif --}}
                        @endcan
                    </td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
        @else
            <tr class="odd"><td valign="top" colspan="11" class="dataTables_empty">No matching records found</td></tr>
        @endif
    </tbody>
</table>

@push('stackScript')
    <script> 
        $(".delete").click(function(e) {

            var data_id = $(this).attr("data-id");
            var url =  '<a href="{{route("admin.department.delete",":id")}}" class="swal2-confirm swal2-styled" title="Delete">Confirm</a>';
            url = url.replace(':id', data_id );
            
            Swal.fire({
                title: 'Are you sure ?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: url,
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Status Changed Successfully!', '', 'success')
                } else if (result.dismiss === "cancel") {
                    Swal.fire('Canceled', '', 'error')
                }
            })
        });

    </script>
@endpush