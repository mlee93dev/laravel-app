@extends('layouts.app')
 
@section('content')

    <script>
      function editAuthor(id)
      {
          document.getElementById(`author_span_${id}`).classList.add("hidden");
          document.getElementById(`author_input_${id}`).classList.remove("hidden");
          document.getElementById(`author_edit_${id}`).classList.add("hidden");
          document.getElementById(`author_save_${id}`).classList.remove("hidden");
          document.getElementById(`author_cancel_${id}`).classList.remove("hidden");
      }

      function saveAuthor(id)
      {
          document.getElementById(`author_span_${id}`).innerText = document.getElementById(`author_input_${id}`).value;

          document.getElementById(`author_span_${id}`).classList.remove("hidden");
          document.getElementById(`author_input_${id}`).classList.add("hidden");
          document.getElementById(`author_edit_${id}`).classList.remove("hidden");
          document.getElementById(`author_save_${id}`).classList.add("hidden");
          document.getElementById(`author_cancel_${id}`).classList.add("hidden");
      }

      function cancelEditAuthor(id)
      {
          document.getElementById(`author_span_${id}`).classList.remove("hidden");
          document.getElementById(`author_input_${id}`).classList.add("hidden");
          document.getElementById(`author_edit_${id}`).classList.remove("hidden");
          document.getElementById(`author_save_${id}`).classList.add("hidden");
          document.getElementById(`author_cancel_${id}`).classList.add("hidden");
      }
    </script>

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
            <table class="table table-bordered">

                <!-- Table Headings -->
                <thead>
                    <th role="button" onclick=>Title</th>
                    <th role="button">Author</th>
                    <th class="text-center">Delete</th>
                </thead>

                <!-- Table Body -->
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <!-- Book Title -->
                            <td class="table-text col-sm-7">
                                <div class="">{{ $book->title }}</div>
                            </td>

                            <td class="table-text col-sm-4">
                              <form action="{{ route('book.update',['id' => $book->id]) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <span id="author_span_{{ $book->id }}">{{ $book->author }}</span>
                                <input id="author_input_{{ $book->id }}" name="author_input_{{ $book->id }}" class="hidden" type="text" value="{{ $book->author }}">

                                <div class="pull-right hidden" id="author_cancel_{{ $book->id }}">
                                  <button onclick="cancelEditAuthor({{ $book->id }});" type="button" class="btn btn-danger">
                                    <i class="fa fa-times-circle-o" aria-hidden="true"></i>
                                  </button>
                                </div>
                                <div class="pull-right hidden" id="author_save_{{ $book->id }}">
                                  <button onclick="saveAuthor({{ $book->id }});" type="submit" class="btn btn-info">
                                    <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                  </button>
                                </div>
                                <div class="pull-right" id="author_edit_{{ $book->id }}">
                                  <button onclick="editAuthor({{ $book->id }});" type="button" class="btn btn-info">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                  </button>
                                </div>
                              </form>
                            </td>

                            <!-- Delete Button -->
                            <td class="col-sm-1 text-center">
                              <form action="{{ url('book/'.$book->id) }}" method="POST">
                                  {{ csrf_field() }}
                                  {{ method_field('DELETE') }}
                      
                                  <button type="submit" class="btn btn-danger">
                                      <i class="fa fa-trash"></i>
                                  </button>
                              </form>
                          </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection