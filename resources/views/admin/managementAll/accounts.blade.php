@extends('layout.admin')
@section('content')


<div class="container">
  <div class="page-inner">
    <div class="row">

      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-center top">
              <h4 class="card-title">Account List</h4>
              <!-- <a href="#">
                        <button class="btn btn-primary btn-round ms-auto">
                          <i class="fa fa-plus"></i>
                          Add Accounts
                        </button>
                      </a> -->
            </div>
          </div>
          <div class="card-body">

            <div class="table-responsive">
              <table
                id="add-row"
                class="display table table-striped table-hover">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Birthdate</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Role_id</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Birthdate</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Role_id</th>
                    <th>Action</th>
                    <th></th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach($accounts as $account)
                  <tr>
                    <td>{{$account->id}}</td>
                    <td>{{$account->fullname}}</td>
                    <td>{{$account->birthday}}</td>
                    <td>{{$account->phone}}</td>
                    <td>{{$account->address}}</td>
                    <td>{{$account->role_id}}</td>
                    <td>
                      <div class="form-button-action">
                        <button
                          type="button"
                          data-bs-toggle="tooltip"
                          title=""
                          class="btn btn-link btn-primary btn-lg"
                          data-original-title="Edit Task">
                          <!-- <i class="fa fa-edit"></i> -->
                        </button>
                        <!-- <button
                          type="button"
                          data-bs-toggle="tooltip"
                          title=""
                          class="btn btn-link btn-danger"
                          data-original-title="Remove">
                          <i class="fa fa-times"></i>
                        </button> -->

                        <a href="{{url('admin/deleteAccounts/' . $account->id)}}" onclick="return confirm('Bạn có chắc muốn xoá?')">
                          <button
                            type="button"
                            data-bs-toggle="tooltip"
                            title=""
                            class="btn btn-link btn-danger"
                            data-original-title="Remove">
                            <i class="fa fa-times"></i>
                          </button>
                        </a>
                      </div>
                    </td>
                    <td>
                      <a href="{{url('admin/reset/' . $account->id)}}" onclick="return confirm('reset password?')">
                        Reset password
                      </a>
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
  </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('admin/assets/js/plugin/datatables/datatables.min.js')}}"></script>
@endsection