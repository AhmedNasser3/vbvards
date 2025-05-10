@extends('admin.master')
@section('AdminContent')

<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">All Division </div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Division</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
<a href="{{ route('add.division') }}" class="btn btn-primary">Add Division</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
<tr>
    <th>Sl</th>
    <th>Division Name </th>
    <th>Action</th>
</tr>
</thead>
<tbody>
@foreach($division as $key => $item)
<tr>
    <td> {{ $key+1 }} </td>
    <td> {{ $item->division_name }}</td>
    <td>
<a href="{{ route('edit.division',$item->id) }}" class="btn btn-info">Edit</a>
<a href="{{ route('delete.division',$item->id) }}" class="btn btn-danger" id="delete" >Delete</a>

    </td>
</tr>
@endforeach


</tbody>
<tfoot>
<tr>
    <th>Sl</th>
    <th>Division Name </th>
    <th>Action</th>
</tr>
</tfoot>
</table>
            </div>
        </div>
    </div>



</div>
@endsection
