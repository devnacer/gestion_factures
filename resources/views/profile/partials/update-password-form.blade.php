{{-- Update Password --}}
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ trans('profile.Update Password') }}</h3><br>
    </div>
    <!-- /.card-header -->

    <div class="card-body">
        @if (session('status') === 'password-updated')
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>{{ trans('profile.Saved.') }}</h5>
            </div>
        @endif

        <p class="mt-1 text-sm text-gray-600">
            {{ trans('profile.Ensure your account is using a long, random password to stay secure.') }}
        </p>

        <!-- form start -->
        <form class="form-horizontal" action="{{ route('password.update') }}" method="post" autocomplete="off">
            @method('put')
            @csrf

            <div class="form-group row">
                <label for="update_password_current_password"
                    class="col-sm-2 col-form-label">{{ trans('profile.Current Password') }}</label>
                <div class="col-sm-10">
                    <input name="current_password" type="password" class="form-control"
                        id="update_password_current_password" value="{{ old('name', $user->name) }}" required autofocus
                        autocomplete="current-password">
                </div>

                @if ($errors->updatePassword->has('current_password'))
                    @foreach ($errors->updatePassword->get('current_password') as $message)
                        <small class="text-danger">{{ $message }}</small>
                    @endforeach
                @endif

            </div>


            <div class="form-group row">
                <label for="update_password_password"
                    class="col-sm-2 col-form-label">{{ trans('profile.New Password') }}</label>
                <div class="col-sm-10">
                    <input name="password" type="password" class="form-control" id="update_password_password"
                        value="{{ old('name', $user->name) }}" required autofocus autocomplete="new-password">
                </div>

                @if ($errors->updatePassword->has('password'))
                    @foreach ($errors->updatePassword->get('password') as $message)
                        <small class="text-danger">{{ $message }}</small>
                    @endforeach
                @endif

            </div>


            <div class="form-group row">
                <label for="update_password_password_confirmation"
                    class="col-sm-2 col-form-label">{{ trans('profile.Confirm Password') }}</label>
                <div class="col-sm-10">
                    <input name="password_confirmation" type="password" class="form-control"
                        id="update_password_password_confirmation" value="{{ old('name', $user->name) }}" required
                        autofocus autocomplete="new-password">
                </div>

                @if ($errors->updatePassword->has('password_confirmation'))
                    @foreach ($errors->updatePassword->get('password_confirmation') as $message)
                        <small class="text-danger">{{ $message }}</small>
                    @endforeach
                @endif

            </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">{{ trans('profile.Save') }}</button>
    </div>
    <!-- /.card-footer -->

    </form>
</div>
<!-- /.card -->
