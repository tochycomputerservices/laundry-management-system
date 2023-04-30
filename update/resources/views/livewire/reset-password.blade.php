<div>
    <main class="main-content main-content-bg mt-0">
        <div class="page-header min-vh-100" style="background-image: url('{{asset('assets/img/login-bg.jpg')}}');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-7">
                        <div class="card border-0 mb-0">
                            <div class="card-header bg-transparent text-center">
                                <div class="d-flex align-items-center justify-content-center mt-2 mb-2">
                                    <img src="{{asset('assets/img/logo-ct.png')}}" class="login-logo">
                                    <h4 class="text-dark ms-3 mb-0 text-uppercase">Laundry Box</h4>
                                </div>
                            </div>
                            <div class="card-body px-lg-5 pt-0" >
                                <div class="" >
                                    <div class="text-muted mb-4">
                                        <small>Reset Password</small>
                                    </div>
                                    <form role="form" class="text-start">
                                        <div class="mb-3">
                                            <input type="email" class="form-control" disabled placeholder="Email" value="{{$email}}">
                                            @error('email') <span class="text-danger">{{$message}}</span>  @enderror
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" placeholder="Enter Your New Password" wire:model="password">
                                            @error('password') <span class="text-danger">{{$message}}</span>  @enderror
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" placeholder="Confirm the password" wire:model="password_confirm">
                                            @error('password_confirm') <span class="text-danger">{{$message}}</span>  @enderror
                                        </div>
                                        @error('login_error') <span class="text-danger">{{$message}}</span>  @enderror
                                        <div class="text-center">
                                            <button type="button" wire:click="login" class="btn btn-primary w-100 my-4 mb-4">Change Password And Login</button>
                                        </div>
                                        <div class="mb-2 position-relative text-center">
                                            <p class="text-sm fw-500 mb-2 text-secondary text-border d-inline z-index-2 bg-white px-3">
                                                Powered by <a href="{{url('/')}}" class="text-dark fw-600" target="_blank">{{ getApplicationName() }}</a>
                                            </p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>