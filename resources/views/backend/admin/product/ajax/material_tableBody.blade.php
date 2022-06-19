<table class="table table-separate table-head-custom table-checkable table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th class="text-left">Product Name</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @if ($products->count() > 0)
        @php
            $i = (($products->currentPage() - 1) * $products->perPage() + 1);
        @endphp
            @foreach ($products as $product)
                <tr>
                    <td>
                        {{$i}}
                    </td>
                    <td align="left">
                        {{$product->name}}
                    </td>

                    <td>
                        @if ($product->status == 1)
                            <span class="label label-lg font-weight-bold label-light-success label-inline">Active</span>
                        @else
                            <span class="label label-lg font-weight-bold label-light-danger label-inline">Inactive</span>
                        @endif
                    </td>

                    <td>
                        @can('view_material_product')
                            <a href="{{route('admin.product.show', $product->id)}}" class="btn btn-sm btn-clean btn-icon" title="View">
                                <i class="la la-eye"></i>
                            </a>
                        @endcan
                        
                        @can('edit_material_product')
                            <button type="button" class="btn btn-sm btn-clean btn-icon" data-toggle="modal" data-target="#edit_product{{$product->id}}">
                                <i class="la la-edit"></i>
                            </button>

                            <div class="modal" id="edit_product{{$product->id}}">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                              
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                      <h4 class="modal-title">Edit {{$product->name}}</h4>
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                              
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form action="{{route('admin.product.material_update', $product->id)}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                              <label for="email">Name: <span class="text-danger">*</span> </label>
                                              <input type="text" class="form-control" placeholder="Enter name" id="name" required value="{{$product->name}}" name="name">
                                            </div>
                                            <div class="form-group">
                                              <label for="pwd">Quantity: <span class="text-danger">*</span> </label>
                                              <input type="number" class="form-control" placeholder="Enter quantity" id="pwd" name="quantity" value="{{$product->quantity}}">
                                            </div>
                                            
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                              
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                              
                                  </div>
                                </div>
                            </div>

                            {{-- <a href="{{route('admin.product.edit', $product->id)}}" class="btn btn-sm btn-clean btn-icon" title="Edit">
                                <i class="la la-edit"></i>
                            </a> --}}
                        @endcan

                        @can('delete_material_product')
                            
                            <button class="btn btn-sm btn-clean btn-icon delete" title="Inactive" data-id="{{ $product->id }}">
                                    <i class="la la-trash"></i>
                            </button>
                            
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
            var url =  '<a href="{{route("admin.product.delete",":id")}}" class="swal2-confirm swal2-styled" title="Delete">Confirm</a>';
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