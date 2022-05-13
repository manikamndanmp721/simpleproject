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

        #inputAddress {
            width: 200px;
        }

        #category {
            width: 200px;
        }

        #product_price {
            width: 200px;
        }

        #product_name {
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <div class="container">

        <h3> Add product</h3>
        <form method="post" action="/product/store" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="product_name">Product Name</label>
                    <input type="text" class="form-control" id="product_name" name="product_name"
                        placeholder="Product Name">
                </div>
                

            </div>
            <div class="form-group">
                <label for="inputAddress">Category</label>
                <select name="category" id="category" class="form-select form-select-md">
                    <option value="Televison"> Televison</option>
                    <option value="Headphones">Headphones</option>
                </select>
            </div>
            <div class="form-group ">
              <label for="inputPassword4">Product Image</label>
              <input type="file" class="form-control" id="product_image" name="image">

          </div>
            <div class="form-group">
                <label for="inputAddress2">Price</label>
                <input type="number" id="product_price" class="form-control" name="product_price">
            </div>
            <button type="submit" id="btn" class="btn btn-primary"> Add Product</button>
        </form>
    </div>
@endsection
