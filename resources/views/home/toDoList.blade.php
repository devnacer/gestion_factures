<!-- TO DO List -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="ion ion-clipboard mr-1"></i>
            To Do List
        </h3>

        <div class="card-tools">
            <ul class="pagination pagination-sm">
                <li class="page-item"><a href="#" class="page-link">&laquo;</a>
                </li>
                <li class="page-item"><a href="#" class="page-link">1</a></li>
                <li class="page-item"><a href="#" class="page-link">2</a></li>
                <li class="page-item"><a href="#" class="page-link">3</a></li>
                <li class="page-item"><a href="#" class="page-link">&raquo;</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <ul class="todo-list" data-widget="todo-list">
            <li>
                <!-- drag handle -->
                <span class="handle">
                    <i class="fas fa-ellipsis-v"></i>
                    <i class="fas fa-ellipsis-v"></i>
                </span>
                <!-- checkbox -->
                <div class="icheck-primary d-inline ml-2">
                    <input type="checkbox" value="" name="todo1" id="todoCheck1">
                    <label for="todoCheck1"></label>
                </div>
                <!-- todo text -->
                <span class="text">Design a nice theme</span>
                <!-- Emphasis label -->
                <small class="badge badge-danger"><i class="far fa-clock"></i> 2
                    mins</small>
                <!-- General tools such as edit or delete-->
                <div class="tools">
                    <i class="fas fa-edit"></i>
                    <i class="fas fa-trash-o"></i>
                </div>
            </li>



        </ul>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        <a  class="btn btn-primary float-right modal-effect" data-effect="effect-scale" data-toggle="modal" href="#ModalAddTodo"><i class="fas fa-plus"></i>
            Add item</a>

        {{-- <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale" data-toggle="modal"
            href="#ModalAddTodo">
        </a> --}}


    </div>
</div>
<!-- /.card -->



<!-- Modal Add Todo -->
<div class="modal fade" id="ModalAddTodo">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('home.Add Todo') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('todos.store') }}" method="post" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="task">{{ trans('home.Todo') }}</label>
                        <input class="form-control" name="task" id="task" type="text" placeholder="{{ trans('home.Enter Todo') }}">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-secondary">{{ trans('home.Add') }}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('home.Close') }}</button>
                </div>
            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
