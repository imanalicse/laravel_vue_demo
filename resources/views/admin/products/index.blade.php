@extends('admin.layouts.app')

@section('content')    
    <div class="page-content">

            <!-- main content here Start -->
            <table class="table-striped table table-responsive">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th class="fx-action-links text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                    @if(count($products) > 0)
                    @foreach($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            <td>${{$product->price}}</td>
                            <td class="fx-action-links text-center">
                                <div class="action-group">                                    
                                    <a href="{{url('/admin/products/'.$product->id.'/edit')}}" class="action edit"></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @endif                        
                </tbody>
            </table>
        </div>

        <div class="pagination-panel">
            {{$products->links()}}
        </div>


@endsection