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
 
    <script>
      function editAuthor(id)
      {
          document.getElementById(`author-span-${id}`).classList.add("hidden");
          document.getElementById(`author-input-${id}`).classList.remove("hidden");
          document.getElementById(`author-edit-${id}`).classList.add("hidden");
          document.getElementById(`author-save-${id}`).classList.remove("hidden");
          document.getElementById(`author-cancel-${id}`).classList.remove("hidden");
      }

      function saveAuthor(id)
      {
          document.getElementById(`author-span-${id}`).innerText = document.getElementById(`author-input-${id}`).value;

          document.getElementById(`author-span-${id}`).classList.remove("hidden");
          document.getElementById(`author-input-${id}`).classList.add("hidden");
          document.getElementById(`author-edit-${id}`).classList.remove("hidden");
          document.getElementById(`author-save-${id}`).classList.add("hidden");
          document.getElementById(`author-cancel-${id}`).classList.add("hidden");
      }

      function cancelEditAuthor(id)
      {
          document.getElementById(`author-span-${id}`).classList.remove("hidden");
          document.getElementById(`author-input-${id}`).classList.add("hidden");
          document.getElementById(`author-edit-${id}`).classList.remove("hidden");
          document.getElementById(`author-save-${id}`).classList.add("hidden");
          document.getElementById(`author-cancel-${id}`).classList.add("hidden");
      }
    </script>

    <!-- Books List -->
    @if (count($books) > 0)
        <div class="panel panel-default"> 
            <table class="table table-bordered">

                <!-- Table Headings -->
                <thead>
                    <th>Title</th>
                    <th>Author</th>
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
                              <form action="" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <span id="author-span-{{ $book->id }}">{{ $book->author }}</span>
                                <input id="author-input-{{ $book->id }}" class="hidden" type="text" value="{{ $book->author }}">

                                <div class="pull-right hidden" id="author-cancel-{{ $book->id }}">
                                  <button onclick="cancelEditAuthor({{ $book->id }});" type="button" class="btn btn-danger">
                                    <i class="fa fa-times-circle-o" aria-hidden="true"></i>
                                  </button>
                                </div>
                                <div class="pull-right hidden" id="author-save-{{ $book->id }}">
                                  <button onclick="saveAuthor({{ $book->id }});" type="button" class="btn btn-info">
                                    <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                  </button>
                                </div>
                                <div class="pull-right" id="author-edit-{{ $book->id }}">
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