@extends('dashboardLayout')
@section('title', 'party')
{{-- @section('dash', 'active') --}}
@section('dashboard_section')


    <div class="card pb-3">
        <nav class="bg-light border-bottom " style="" aria-label="breadcrumb">
          
                <ol class="breadcrumb m-0 d-flex align-items-center justify-content-start h4 px-3" style="height:51px;font-size:21px;">
                    <li class="breadcrumb-item ">Add Seller</li>
                    <!-- <li class="breadcrumb-item active " aria-current="page">Library</li> -->
                </ol>
                     

        </nav>

{{-- {{$errors}} --}}
        <form class="px-3 " action="{{route('saveSeller')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-8 offset-2 mt-3">
                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">Name</label>
                    <div class="col-8">
                        <input type="text" class="form-control rounded-0" name="name" value="{{$seller->seller_name}}" required>
                        <span class="text-danger">@error('name') {{ $message }}
                            @enderror</span>
                    </div>

                </div>
                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">Email</label>
                    <div class="col-8">
                        <input type="email" class="form-control rounded-0" name="email" value="{{$seller->email}}">
                        <span class="text-danger">@error('email') {{ $message }}
                            @enderror</span>
                    </div>

                </div>
                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">Phone</label>
                    <div class="col-8">
                        <input type="text" class="form-control rounded-0" name="phone" value="{{$seller->phone}}" >
                        <span class="text-danger">@error('phone') {{ $message }}
                            @enderror</span>
                    </div>

                </div>
                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">Address</label>
                    <div class="col-8">
                        <textarea type="text" class="form-control rounded-0" name="address" row='2' >{{$seller->address}}</textarea>
                        <span class="text-danger">@error('address') {{ $message }}
                            @enderror</span>
                    </div>

                </div>
                <input type="hidden" name="customer_id" value="{{$seller->id}}"/>
            <div class="utils_center ">
                
                @if($action!=trim('view'))
                <button type="submit" class="btn btn-primary rounded-0 ">save</button>
                @endif
            </div>
          </div>
      
        </form>
    </div>

    
@endsection
