@extends('layouts.app')
 
@section('content')
  
    <div class="panel-body">

        @include('common.errors')

        <!-- New Book Form -->
        <form action="{{ url('book') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
 
            <!-- Book Title -->
            <div class="form-group">
                <label for="book" class="col-sm-3 control-label">Title *</label>
 
                <div class="col-sm-2">
                    <input type="text" name="title" id="title" class="form-control">
                </div>
            </div>

            <!-- Book Author -->
            <div class="form-group">
                <label for="book" class="col-sm-3 control-label">Author *</label>
          
                <div class="col-sm-2">
                    <input type="text" name="author" id="author" class="form-control">
                </div>
            </div>
 
            <!-- Add Book Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Book
                    </button>
                </div>
            </div>
        </form>
    </div>
 
    <!-- TODO: Current Tasks -->
@endsection