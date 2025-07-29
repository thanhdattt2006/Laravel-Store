@extends('layout.admin')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center top">
                            <h4 class="card-title">Product Review</h4>

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
                                        <th>Name</th>
                                        <th>Category</th>

                                        <th>Comment</th>
                                        <th>Reply</th>
                                        <th>Rating</th>


                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Category</th>

                                        <th>Comment</th>
                                        <th>Reply</th>
                                        <th>Rating</th>

                                    </tr>
                                </tfoot>
                                <tbody>

                                    @foreach($reviews as $productId => $productReviews)
                                    <tr>
                                        <td>{{ $productId }}</td>
                                        <td>{{ $productReviews->first()->product->name }}</td>
                                        <td>{{ $productReviews->first()->product->cate->name }}</td>


                                        <td>
                                            @foreach($productReviews as $review)
                                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 10px;">
                                                <div style="flex-grow: 1;">
                                                    <span style="font-weight: bold; font-size: 15px;">{{ $review->account->fullname }}</span><br>
                                                    <span style="margin-left: 15px; font-size: 14px; color: #555;">{{ $review->comment }}</span>
                                                </div>

                                                <a href="{{ url('admin/deleteComment/' . $review->id) }}" onclick="return confirm('Bạn có chắc muốn xoá?')">
                                                    <button type="button" class="btn btn-link btn-danger" data-bs-toggle="tooltip" title="Xoá đánh giá">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </a>
                                            </div>
                                            @endforeach
                                        </td>

                                        <td></td>
                                        <td>
                                            @php
                                            $avg = $productReviews->whereNotNull('rating')->avg('rating');
                                            @endphp
                                            ({{ number_format($avg, 2) }}/5) &#11088;
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
<script src="{{asset('user/js/elementJs/carousel.js')}}"></script>
<script src="{{asset('admin/assets/js/elementJs/main.js')}}"></script>
@endsection