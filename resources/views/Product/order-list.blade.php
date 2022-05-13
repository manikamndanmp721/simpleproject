@extends('layout.main')
@section('content')
    <div class="container">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Order Id</th>
                    <th scope="col"> Customer Name</th>
                    <th scope="col"> Phone</th>
                    <th scope="col">Net Amount</th>
                    <th scope="col"> Order Date</th>
                    <th scope="col"> Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>




        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Order</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="edit_order">
                            <div class="form-group">
                                <input type="hidden" name="my_order_id" id="my_order_id">
                                <input type="hidden" name="demo_product" id="my_order_id">
                                <label for="recipient-name" class="col-form-label">Order Id:</label>
                                <input type="text" name="order_id" class="form-control" id="order_id" disabled>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Customer Name:</label>
                                <input type="text" class="form-control" name="customer_name"
                                    id="customer_name"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label"> Phone:</label>
                                <input type="number" class="form-control" name="phone" id="phone">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Product:</label>
                                <select name="product_id" id="product_id" class="form-select form-select-md">

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Quantity:</label>
                                <input type="number" class="form-control" name="qty" id="qty">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Order Date:</label>
                                <input type="date" class="form-control" name="order_date" id="orderDate">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" id="submit" class="btn btn-dark">Update</button>
                                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>






        <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" defer></script>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
       

        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

        <script type="text/javascript">
            $(function() {

                var table = $('.table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('get.orders') }}",
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'order_id',
                            name: 'order_id'
                        },
                        {
                            data: 'customer_name',
                            name: 'customer_name'
                        },
                        {
                            data: 'phone_number',
                            name: 'phone_number'
                        },
                        {
                            data: 'net_amount',
                            name: 'net_amount'
                        },
                        {
                            data: 'order_date',
                            name: 'order_date'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        },
                    ]
                });

            });

            $(document).ready(function() {


                $(document).on("click", ".btn-primary", function() {
                    var data_id = $(this).data('id');

                    $('#exampleModal').modal('show');
                    $.ajax({
                        url: '/product/order-edit/' + data_id,
                        method: 'get',
                        success: function(response) {

                            $('#my_order_id').val(response['order_data'].id);
                            $('#order_id').val(response['order_data'].order_id);
                            $('#customer_name').val(response['order_data'].customer_name);
                            $('#phone').val(response['order_data'].phone_number);
                            $('#net_amount').val(response['order_data'].net_amount);
                            $('#orderDate').val(response['order_data'].order_date_format);
                            $('#qty').val(response['order_data'].qty);

                            for (i = 0; i < response['product_data'].length; i++) {
                                var data = "<option value='" + response['product_data'][i].id +
                                    "'>" + response['product_data'][i].product_name + "</option>";
                                $('#product_id').append(data);
                            }

                            $("#product_id").val(response['order_data'].product_id).change();


                        }
                    })




                });

                $(document).on("click", ".btn-danger", function() {
                    var data_id = $(this).data('id');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: '/product/order-delete/' + data_id,
                        method: 'delete',
                        success: function(response) {
                            location.reload();
                        }
                    })
                });
                $('#edit_order').submit(function(e) {
                    e.preventDefault();

                    
                    var formData = new FormData(this);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        method: 'post',
                        url: "{{ route('orderupdate') }}",
                        data: formData,
                        processData: false,
                        cache: false,
                        contentType: false,

                        dataType: 'JSON',
                        success: function(response) {
                            if (response == 'success') {
                                $('#exampleModal').modal('hide');
                                location.reload();
                               
                            }


                        }
                    })
                });

                
            })
        </script>
    @endsection
