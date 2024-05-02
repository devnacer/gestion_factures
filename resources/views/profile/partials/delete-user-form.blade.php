{{-- Delete Account --}}
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('profile.Delete Account') }}</h3><br>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
                <form class="form-horizontal" action="{{ route('profile.destroy') }}" method="post"
                    autocomplete="off">
                    @method('delete')
                    @csrf

                    <div class="card-body">
                        <p class="mt-1 text-sm text-gray-600">
                            {{ trans('profile.Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                        </p>

                        @if ($errors->userDeletion->get('password'))
                            @foreach ($errors->userDeletion->get('password') as $message)
                                <small class="text-danger">{{ $message }}</small>
                            @endforeach
                        @endif

                        <!--modal Delete-->
                        <div class="modal fade" id="ModalDelete">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{ trans('profile.Delete Account') }}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form class="form-horizontal" action="{{ route('profile.destroy') }}" method="post"
                                        autocomplete="off">
                                        @method('delete')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input type="hidden" name="id" id="id" value="">
                                                <h3>{{ trans('profile.Are you sure you want to delete your account?') }}
                                                </h3>
                                                <p>{{ trans('profile.Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                                </p>

                                                <div class="form-group row">
                                                    <label for="password"
                                                        class="col-sm-2 col-form-label">{{ trans('profile.Password') }}</label>
                                                    <div class="col-sm-10">
                                                        <input name="password" type="password" class="form-control"
                                                            id="password" required placeholder="Password">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="submit"
                                                class="btn btn-danger">{{ trans('profile.Delete Account') }}</button>
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">{{ trans('profile.Cancel') }}</button>
                                        </div>
                                    </form>

                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <a class="modal-effect btn btn-danger" data-effect="effect-scale" data-toggle="modal"
                            href="#ModalDelete">
                            <i class="fas fa-trash"></i>
                            {{ trans('profile.Delete Account') }}
                        </a>
                    </div>
                    <!-- /.card-footer -->

                </form>
            </div>
            <!-- /.card -->