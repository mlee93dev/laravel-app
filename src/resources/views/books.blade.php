@extends('layouts.app')
 
@section('content')
  
    <div class="panel panel-default">

        <div class="panel-heading">
          @include('common.errors')

          <!-- New Book Form -->
          <form action="{{ url('book') }}" method="POST" class="form-horizontal">
              {{ csrf_field() }}
  
              <!-- Book Title -->
              <div class="form-group">
                  <label for="book" class="col-sm-3 control-label">Title <span class="text-danger">*</span></label>
  
                  <div class="col-sm-2">
                      <input type="text" name="title" id="title" class="form-control">
                  </div>
              </div>

              <!-- Book Author -->
              <div class="form-group">
                  <label for="book" class="col-sm-3 control-label">Author <span class="text-danger">*</span></label>
            
                  <div class="col-sm-2">
                      <input type="text" name="author" id="author" class="form-control">
                  </div>
              </div>
  
              <!-- Add Book Button -->
              <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-6">
                      <button type="submit" class="btn btn-primary">
                          <i class="fa fa-plus"></i> Add Book
                      </button>
                  </div>
              </div>
          </form>
        </div>

    </div>
 
    <!-- Books List -->
    @if (count($books) > 0)
        <div class="panel panel-default"> 
            <div class="panel-body">
                <table class="table table-striped task-table">
 
                    <!-- Table Headings -->
                    <thead>
                        <th>Title</th>
                        <th>Author</th>
                    </thead>
 
                    <!-- Table Body -->
                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <!-- Book Title -->
                                <td class="table-text">
                                    <div>{{ $book->title }}</div>
                                </td>

                                <td class="table-text">
                                    <div>{{ $book->author }}</div>
                                </td>
 
                                <td>
                                    <!-- TODO: Delete Button -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection