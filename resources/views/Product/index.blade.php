@extends('layout.main')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script> --}}
    <style>
        .container {
            margin-top: 50px;
        }

        /* #edit {
            background-color: black;
            color: aliceblue;
            border-radius: 10px;
            margin-right: 20px;
            width: 500px;
            height: 20px;
        }

        #delete {
            background-color: rgb(130, 12, 12);
            border-radius: 10px;
            margin-left: 20px;
            color: white;
            width: 100px
        } */

    </style>
    <div class="container">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col"> Category</th>
                    <th scope="col"> Price</th>
                    <th scope="col"> Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product_data as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->product_name }}</td>
                        <td>{{ $data->category }}</td>
                        <td>{{ $data->price }}</td>
                        <td>
                            <a id="edit" class="btn btn-edit" data-id="{{ $data->id }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a id="delete" class="delete" data-id="{{ $data->id }}">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>


        <div class="col-xs-6" id="myform">
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="myform" action="#">
                            <div class="form-group">
                                <input type="hidden" name="product_id" id="product_id">
                                <label for="recipient-name" class="col-form-label">Product name:</label>
                                <input type="text" name="product_name" class="form-control" id="product_name">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Product Image:</label>
                                <input type="file" class="form-control" name="product_image"
                                    id="product_image"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Category:</label>
                                <select name="category" name="product_category" id="product_category"
                                    class="form-select form-select-md">
                                    <option value="Televison"> Televison</option>
                                    <option value="Headphones">Headphones</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Price:</label>
                                <input type="number" class="form-control" name="product_price"
                                    id="product_price"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-dark">Update</button>
                                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>




    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    </body>

    <script type="text/javascript">
        //  jQuery.validator.setDefaults({
        //      debug: true,
        //      success: "valid"
        //  });

        $(document).ready(function() {
            $('.btn-edit').click(function() {

                $('#exampleModal').modal('show');
                var user_id = $(this).data('id');
               

                $.ajax({
                    url: '/product/edit/' + user_id,
                    method: 'get',

                    success: function(response) {
                      

                        $('#product_name').val(response.product_name);
                        $('#product_price').val(response.price);
                        $('#product_id').val(response.id);

                    }
                });




            });
            $(document).on("submit","#myform",function(e) {
                    e.preventDefault();
                    // var order_id

                    console.log("jhdiasih")
                    var formData = new FormData(this);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        method: 'post',
                        url: "{{ route('product.update') }}",
                        data: formData,
                        processData: false,
                        cache: false,
                        contentType: false,

                        dataType: 'JSON',
                        success: function(response) {
                            console.log(response);
                            if (response == 'success') {
                                $('#exampleModal').modal('hide');
                                location.reload();
                               
                            }


                        }
                    })

                });


            $('.delete').click(function(){
                 var data_id= $(this).data('id');
                 
                 $.ajax({
                     url:'/product/delete/' + data_id,
                     method:'get',
                     success:function(response){
                         if(response['success']==true){
                           location.reload();
                         }
                     }
                 })
            })

          


        });
    </script>
@endsection
