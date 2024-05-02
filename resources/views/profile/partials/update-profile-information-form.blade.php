{{-- Profile information --}}
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ trans('profile.Profile Information') }}</h3><br>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <div class="card-body">
        @if (session('status') === 'profile-updated')
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>{{ trans('profile.Saved.') }}</h5>
            </div>
        @endif

        <p class="mt-1 text-sm text-gray-600">
            {{ trans("profile.Update your account's profile information and email address.") }}
        </p>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form class="form-horizontal" action="{{ route('profile.update') }}" method="post" autocomplete="off">
            @method('patch')
            @csrf

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">{{ trans('profile.Name') }}</label>
                <div class="col-sm-10">
                    <input name="name" type="text" class="form-control" id="name"
                        value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                </div>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">{{ trans('profile.Email') }}</label>
                <div class="col-sm-10">
                    <input name="email" type="email" class="form-control" id="email"
                        value="{{ old('email', $user->email) }}" required autocomplete="username">
                </div>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div>
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div>
                        <p>
                            {{ trans('profile.Your email address is unverified.') }}

                            <button form="send-verification" class="btn btn-secondary">
                                {{ trans('profile.Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p>
                                {{ trans('profile.A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
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
