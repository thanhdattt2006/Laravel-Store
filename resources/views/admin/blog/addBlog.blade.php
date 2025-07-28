@extends('layout.admin')
@section('content')
<div class="container">
    <div class="page-inner">
        <form action="{{url(('admin/saveBlog'))}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="account_id" value="{{$accounts->first()->id }}">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                        <div class="card-title">Add blog</div>
                        </div>
                        <div class="card-body">
                            @if (session('error'))
                                <div id="alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 alert alert-danger">
                                    <span class="block sm:inline">{{ session('error') }}</span>
                                </div>
                            @endif
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                            <!-- Title -->
                            <div class="form-group">
                                <label for="email2">Title</label>
                                <input
                                type="text"
                                class="form-control"
                                id="email2"
                                name="title"
                                placeholder="Enter title"
                                />
                            </div>
                            <!-- Photo-name -->
                            <div class="form-group">
                                <label for="email2">Photo-name</label>
                                <input
                                type="text"
                                class="form-control"
                                id="email2"
                                name="photo"
                                placeholder="Enter photo"
                                />
                            </div>
                            <!-- Description -->
                            <div class="form-group">
                                <label for="comment">Description</label>
                                <textarea class="form-control" name="description" id="comment" rows="3">
                                </textarea>
                            </div>
                            </div>
                        <div class="col-md-6 col-lg-4">
                            <!-- Content -->
                            <div class="form-group">
                                <label for="comment">Content</label>
                                <textarea class="form-control" name="content" id="comment" rows="7" cols="1">
                                </textarea>
                            </div>
                        </div>

                        </div>
                        <div class="card-action">
                        <button type="submit"  class="btn btn-success">Submit</button>
                        <a href="{{url('admin/blog')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection