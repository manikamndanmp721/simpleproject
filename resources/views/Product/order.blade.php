@extends('layout.main')
@section('content')
<style>
    .container {
        margin-top: 200px;
        margin-left: 100px;

        height: 50%;


    }

    h3 {
        margin-top: 20px;
        margin-left: 400px;
        text-decoration: underline;
    }

    #customer_name {
        width: 200px;
    }

    #customer_phone {
        width: 200px;
    }

    #product {
        width: 200px;
    }

    #product_qty {
        width: 200px;
    }

    #product_image {
        width: 200px;
    }

    form {
        margin-left: 400px;
    }

    #btn {
        margin-top: 10px;
        background-color: black;
        margin-left: 50px;
        border: none;
        color: white;

    }

</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <div class="container">

        <h3> Order</h3>
        <form method="post" id="myform1" action="/product/order-store" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="product_name">Customer Name</label>
                    <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="">
                </div>
                
            </div>
            <div class="form-group ">
                <label for="phone">Phone Number</label>
                <input type="number" class="form-control" id="customer_phone" name="customer_phone">

            </div>
            <div class="form-group">
                <label for="inputAddress">Product</label>


                <select name="product_id" id="product" class="form-select form-select-md">
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}"> {{ $product->product_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="inputAddress2">Quantity</label>
               
                <input type="number" id="product_qty" class="form-control" name="product_qty">
                
            </div>
            <button type="submit" id="btn" class="btn btn-primary">Order Now</button>
        </form>
    </div>



<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {


        $('#myform1').validate({

            rules: {
                customer_name: {
                    required: true,
                    // lettersonly: true,

                },
                customer_phone: {
                    required: true,

                },
                products: {
                    required: true,

                },
                product_qty:{
                  required: true,
                }


            },
            errorClass: "is-invalid text-danger",
        });
    })
</script>

@endsection
