@extends('layout.admin')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center top">
                            <h4 class="card-title">Blog List</h4>
                            <a href="{{url('admin/addBlog')}}">
                                <button class="btn btn-primary btn-round ms-auto">
                                    <i class="fa fa-plus"></i>
                                    Add Blog
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table
                                id="add-row"
                                class="display table table-striped table-hover">
                                @if (session('success'))
                                <div id="alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 alert alert-success">
                                    <span class="block sm:inline">{{ session('success') }}</span>
                                </div>
                                @elseif (session('error'))
                                <div id="alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 alert alert-danger">
                                    <span class="block sm:inline">{{ session('error') }}</span>
                                </div>
                                @endif
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Content</th>
                                        <th>description</th>
                                        <th>Comment</th>
                                        <th>Reply</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Iamge</th>
                                        <th>Content</th>
                                        <th>description</th>
                                        <th>Comment</th>
                                        <th>Reply</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                   
                                    @foreach($blogs as $blog)
                                    @foreach($blog->reviews as $review)
                                    <tr>
                                        <td>{{ $review->id }}</td>
                                        <td>{{ $blog->title }}</td>
                                        <td class="tbody-td">
                                            <img src="{{ asset('user/blog/' . $blog->photo) }}" alt="{{ $blog->photo }}">
                                        </td>
                                        <td class="overflow">{{ $blog->content }}</td>
                                        <td class="overflow-short">{{ $blog->description }}</td>
                                        <td>
                                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 10px;">
                                                <div style="flex-grow: 1;">
                                                    <span style="font-weight: bold; font-size: 15px;">{{ $review->account->fullname }}</span><br>
                                                    <span style="margin-left: 15px; font-size: 14px; color: #555;">{{ $review->comment }}</span>
                                                </div>

                                                <a href="{{ url('admin/deleteBlogcmt/' . $review->id) }}" onclick="return confirm('Bạn có chắc muốn xoá?')">
                                                    <button type="button" class="btn btn-link btn-danger" data-bs-toggle="tooltip" title="Xoá đánh giá">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
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
<script src="{{asset('user/js/elementJs/carousel.js')}}"></script>
<script src="{{asset('admin/assets/js/elementJs/main.js')}}"></script>
@endsection