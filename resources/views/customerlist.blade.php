@extends('dashboardLayout')
@section('title', 'party')
{{-- @section('dash', 'active') --}}
@section('dashboard_section')
    <div class="card">
        <nav class="bg-light" style="" aria-label="breadcrumb">

            <ol class="breadcrumb m-0 w-100 h4 d-flex align-items-center px-2" style="height:51px;font-size:21px;">
                <li class="breadcrumb-item ">Customer List</li>
                <!-- <li class="breadcrumb-item active " aria-current="page">Library</li> -->
            </ol>

        </nav>

        @if (session()->has('msg'))

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Message</strong> {{ session('msg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="py-3">
            <div class="d-flex mb-3">

                <input type="text" class="form-control rounded-0 mx-2" value="" id="searchByName"
                    placeholder="Search By Name">
                <input type="text" class="form-control rounded-0 mx-2" value="" id="searchByEmail"
                    placeholder="Search By Email">
                <input type="text" class="form-control rounded-0 mx-2" value="" id="searchByPhone"
                    placeholder="Search By Phone">

            </div>
            <div>
                <table id="dynamic-table" class="table table-striped  table-hover" style="font-size: 14px">
                    <thead class="thead_sticky">


                        <tr>
                            <th width="50">#</th>
                            <th width="">Customer Name</th>
                            <th width="">Email</th>
                            <th width="">Phone</th>
                            <th width="">Address</th>
                            <th class="text-center" width="120">Action</th>
                        </tr>


                    </thead>

                    <tbody class="" id="tbody">

                        @foreach ($customer as $key => $item)
                            <tr>
                                <td class="">{{ $key + 1 }}</td>
                                <td class="">{{ $item->customer_name }}</td>
                                <td class="">{{ $item->email }}</td>
                                <td class="">{{ $item->phone }} </td>
                                <td class="">{{ $item->address }}</td>

                                <td class="text-center">
                                    <a href="{{ url('admin/customer_') }}{{ urlencode('view' . '_' . $item->id) }}"
                                        title="View" class="btn btn-primary btn-sm rounded-0"><i class="fa fa-eye"
                                            aria-hidden="true"></i></a>
                                    <a href="{{ url('admin/customer_') }}{{ urlencode('edit' . '_' . $item->id) }}"
                                        title="Edit" class="btn btn-warning btn-sm rounded-0"><i
                                            class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    {{-- <a href="{{ url('admin/customer_') }}{{urlencode('delete'.'_'.$item->id)}}" title="Delete" class="btn btn-danger btn-sm rounded-0"><i class="fa fa-trash-o"
                                        aria-hidden="true"></i></a> --}}
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <script>
        const searchByName = document.getElementById('searchByName');
        const searchByEmail = document.getElementById('searchByEmail');
        const searchByPhone = document.getElementById('searchByPhone');

        const tbody = document.getElementById('tbody');
        const trList = tbody.children;
        searchByName.addEventListener('keyup', (e) => {
            let input = (e.target.value).toUpperCase();
            // console.log(trList.length);
            for (let index = 0; index < trList.length; index++) {
                let data = (trList[index].children)[1];
                let tdData = (data.innerText).toUpperCase() || (data.innerHtml).toUpperCase();
                if (tdData.indexOf(input) > -1) {
                    trList[index].style.display = "";
                } else {
                    trList[index].style.display = "none";
                }
            }
        })
        searchByEmail.addEventListener('keyup', (e) => {
            let input = (e.target.value).toUpperCase();

            for (let index = 0; index < trList.length; index++) {
                let data = (trList[index].children)[2];

                let tdData = (data.innerText).toUpperCase() || (data.innerHtml).toUpperCase();
                if (tdData.indexOf(input) > -1) {
                    trList[index].style.display = "";
                } else {
                    trList[index].style.display = "none";
                }
            }
        })

        searchByPhone.addEventListener('keyup', (e) => {
            let input = e.target.value;
            // console.log(input);
            for (let index = 0; index < trList.length; index++) {
                let data = (trList[index].children)[3];
                let tdData = (data.innerText).toUpperCase() || (data.innerHtml).toUpperCase();
                if (tdData.indexOf(input) > -1) {
                    trList[index].style.display = "";
                } else {
                    trList[index].style.display = "none";
                }
            }
        })

   
    </script>
@endsection
