<div>
    <main class="main-content main-content-bg mt-0">
        <div class="page-header min-vh-100" style="background-image: url('assets/img/login-bg.jpg');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-7">
                        <div class="card border-0 mb-0">
                            <div class="card-header bg-transparent text-center">
                                <div class="d-flex align-items-center justify-content-center mt-2 mb-2">
                                    <img src="{{asset(getSiteLogo())}}" class="login-logo">
                                    <h4 class="text-dark ms-3 mb-0 text-uppercase">{{ getApplicationName() }}</h4>
                                </div>
                            </div>
                            <div class="card-body px-lg-5 pt-0" x-data="{resetpassword : false,success:@entangle('success')}" x-transition.fade>
                                <div class="" x-show="resetpassword == false" >
                                    <div class="text-muted mb-4">
                                        <small>Login to Continue</small>
                                    </div>
                                    <form role="form" class="text-start">
                                        <div class="mb-3">
                                            <input type="email" class="form-control" placeholder="Email" wire:model="email">
                                            @error('email') <span class="text-danger">{{$message}}</span>  @enderror
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" placeholder="Password" wire:model="password">
                                            @error('password') <span class="text-danger">{{$message}}</span>  @enderror
                                        </div>
                                        @error('login_error') <span class="text-danger">{{$message}}</span>  @enderror

                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" wire:click="login" class="btn btn-primary w-100 my-4 mb-4">Login</button>
                                        </div>
                                        <div class="mb-2 position-relative text-center">
                                            <p class="text-sm fw-500 mb-2 text-secondary text-border d-inline z-index-2 bg-white px-3">
                                                Powered by <a href="{{url('/')}}" class="text-dark fw-600" target="_blank">{{ getApplicationName() }}</a>
                                            </p>
                                        </div>
                                        @if($forgetpassword == 1)
                                       <p class="text-center"> <a href="" class="text-center text-primary-faded" @click.prevent ="resetpassword = true">Forgot Password?</a></p>
                                        @endif
                                    </form>
                                </div>
                                <div class="" x-show="resetpassword == true" x-transition x-cloak>
                                    <div class="" x-show="success==false">
                                        <div class="text-muted mb-4">
                                            <small>Enter Your Email Address</small>
                                        </div>
                                        <form role="form" class="text-start">
                                            <div class="mb-3">
                                                <input type="email" class="form-control" placeholder="Email" wire:model="email" wire:keydown.enter="forgotpassword">
                                                @error('email') <span class="text-danger">{{$message}}</span>  @enderror
                                            </div>
                                            @error('login_error') <span class="text-danger">{{$message}}</span>  @enderror
                                            <div class="text-center">
                                                <button type="button" wire:click="forgotpassword" class="btn btn-primary w-100 my-4 mb-4">Send Reset Link</button>
                                            </div>

                                            <div class="mb-2 position-relative text-center">
                                                <p class="text-sm fw-500 mb-2 text-secondary text-border d-inline z-index-2 bg-white px-3">
                                                    Powered by <a href="{{url('/')}}" class="text-dark fw-600" target="_blank">{{ getApplicationName() }}</a>
                                                </p>
                                            </div>
                                        <p class="text-center"> <a href="" class="text-center  text-primary-faded" @click.prevent="resetpassword = false">I Know My Password</a></p>
                                        </form>
                                    </div>
                                    <div class="" x-show="success == true">
                                        <div class="text-muted mb-4">
                                        </div>
                                        <form role="form" class="text-start">
                                            <p class="text-center">You will receive the reset link in your mail</p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>