
@extends('backend.layout.master')
@section('style')
<link
href="{{asset('admin/assets')}}/css/dataTables.bootstrap4.css"
rel="stylesheet"
/>
@endsection
@section('content')

<div class="row">
    <div class="col-12">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Users Management</h1>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table  class="table table-striped table-bordered table-hover">
                        <thead class="text-center bg-light">
                            <tr>
                                <th>Name</th>
                                <th>Current Role</th>
                                <th>Image</th>
                                <th>Update Role</th>
                                <th>Update Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ ucfirst($user->role) }}</td>
                                    <td>
                                        @if($user->img)
                                            <img src="{{ asset('storage/'.$user->img) }}" alt="{{ $user->name }}" style="width: 50px; height: 50px; border-radius: 50%;">
                                        @else
                                            <img src="{{ asset('default-avatar.png') }}" alt="Default Avatar" style="width: 50px; height: 50px; border-radius: 50%;">
                                        @endif
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('users.update', $user->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <select name="role" class="form-select d-inline-block" style="width: auto;margin-right: 10px;">
                                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('users.updateImage', $user->id) }}" enctype="multipart/form-data" style="display: flex; align-items: center;">
                                            @csrf
                                            @method('PUT')
                                            <input type="file" name="img" class="form-control" accept="image/*" style="margin-right: 10px;">
                                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection
    <!-- this page js -->
    @section('scripts')
    <script src="{{asset('admin/assets')}}/js/datatables.min.js"></script>
    <script>
      /****************************************
       *       Basic Table                   *
       ****************************************/
      $("#zero_config").DataTable();
    @endsection
