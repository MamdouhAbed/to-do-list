
<!DOCTYPE html>
<html lang="en" data-textdirection="RTL" class="loading">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول</title>

    <meta http-equiv="X-UA-Compatible" content=="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="" type="image/x-icon">


    <link rel="stylesheet" type="text/css" href="{{asset('libs/bootstrap/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/bootstrap/css/bootstrap-rtl.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/fonts/line-awesome/css/line-awesome.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/fonts/open-sans/styles.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/dinnext/styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('libs/tether/css/tether.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/styles/common.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/styles/pages/auth-login.min.css')}}" />
</head>
<body>

<div class="ks-page">
    <div class="ks-body">
        <img class="gym_logo" src="">
        <div class="ks-logo"></div>

        <div class="card panel panel-default ks-light ks-panel ks-login">
            <div class="card-block">
                <form class="form-container" action="{{ route('login') }}" novalidate="" method="post" />
                @csrf
                <h4 class="ks-header">{{ __('تسجيل الدخول') }}</h4>
                <div class="form-group @error('email') has-error @enderror">
                    <div class="input-icon icon-right icon-lg icon-color-primary">
                        <input type="text" class="form-control  @error('email') error @enderror" @error('email') style="border-color: rgb(185, 74, 72);"@enderror name="email" value="{{ old('email') }}" class="form-control input-lg" id="user-name" placeholder="البريد الالكتروني" tabindex="1" required="" data-validation-required-message="الرجاء إدخال البريد الالكتروني"  />
                        <span class="icon-addon">
                                <span class="la la-at">
                                </span>
                            </span>


                    </div>
                    @error('email')
                    <span class="help-block form-error" role="alert">
                        {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group @error('password') has-error @enderror">
                    <div class="input-icon icon-right icon-lg icon-color-primary">
                        <input id="password" type="password" class="form-control @error('password') error @enderror" @error('password') style="border-color: rgb(185, 74, 72);"@enderror name="password" placeholder="كلمة المرور" required autocomplete="current-password">
                        <span class="icon-addon">
                                <span class="la la-key"></span>
                            </span>

                    </div>
                    @error('password')
                    <span class="help-block form-error" role="alert">
                        {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">{{ __('تذكرني') }}</span>
                    </label>
                    <!--                                <div class="col-md-6 col-xs-12 text-xs-center text-md-right"><a href="./recover-pass.html" class="card-link">نسيت كلمة المرور؟</a></div>-->
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">{{ __('دخول') }}</button>
                </div>

                <div class="ks-text-center">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">{{ __('هل نسيت كلمة السر؟') }}</a>
                    @endif

                </div>


                </form>
            </div>
        </div>
    </div>

</div>

<script src="{{asset('libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('libs/tether/js/tether.min.js')}}"></script>
<script src="{{asset('libs/bootstrap/js/bootstrap.min.js')}}"></script>
</body>
</html>