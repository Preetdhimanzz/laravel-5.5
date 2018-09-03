@extends('layouts.app')
@section('content')
@if($is)
@include('layouts.header')
@include('layouts.sidebar')
@endif

<div class="content-wrapper" style="min-height: 564px;">
  <section class="content-header"><h1>
    <!-- Content Header (Page header) -->
      <h1>
        Categories
        <small>Listing</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Layout</a></li>
        <li class="active">Fixed</li>
      </ol>
    </section>

    <section class="content">

        <div class="row listingArea">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Responsive Hover Table</h3>

                <div class="box-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Price</th>
                      <th colspan="2">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($products as $product)
                    <tr id="tableRow{{$product['id']}}">
                      <td>{{$product['id']}}</td>
                      <td class="name">{{$product['name']}}</td>
                      <td class="price">{{$product['price']}}</td>
                      <td><a data-modal="true" href="{{url('product-edit')}}" data-type="post" data-objId="{{$product['id']}}"  class="isEditState btn btn-warning">Edit</a></td>
                      <td>
                        <form action="{{action('ProductController@destroy', $product['id'])}}" method="post">
                          {{csrf_field()}}
                          <input name="_method" type="hidden" value="DELETE">
                          <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                 {{ $products->links() }}
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
        </div>
        <div class="hasEditArea">

        </div>
      </section>
    </div>
    @if($is)
      @include('layouts.footer')
    @endif

    @endsection
