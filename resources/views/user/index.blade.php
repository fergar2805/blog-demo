<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>XYZ - Registration</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <script src="{{ asset('js/bootstrap.js')}}"></script>
    <script src="{{ asset('js/jquery.min.js')}}"></script>
    <script src="{{ asset('js/vue.min.js')}}"></script>
    <script src="{{ asset('js/login.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js" integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
        <br>

        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none">
            <strong>Error!</strong> Please Try Again!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <h1 class="text-center indexTitle">REGISTER</h1>


        <div id="app" v-cloak class="col-12 col-lg-5">
            <ul class="nav nav-tabs indexTabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link" type="button" :class='[{ active: isDisabled("signin") }]' @click='setView("signin")'>SIGN IN</button>
                </li>
                <li class="nav-item" role="presentation" style="margin-left: 5px">
                    <button class="nav-link" type="button" :class='[{ active: isDisabled("register") }]' @click='setView("register")'>REGISTER</button>
                </li>
            </ul>

            <transition name='form' mode='out-in'>
                <keep-alive>
                    <component :feedback='feedback' :is="currentComponent" @register-form='handleForm' @signin-form='handleForm'></component>
                </keep-alive>
            </transition>
        </div>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="signIn-tab-pane" role="tabpanel" aria-labelledby="signIn-tab" tabindex="0">
                <template id="signUp">
                    <form @submit.prevent='onSubmit' ref='form' action="" class='register-form'>
                        <br>
                        <img src="/img/WSJ_Horizontal.png" class="wsjLogo">
                        <br>
                        <div class="container singInContainer">
                            <br>
                            <h2 class="signInTitle">NEW ACCOUNT</h2>
                            <br>
                            <div class="mb-3 row">
                                <label for="firstname" class="col-sm-3 col-form-label">First Name</label>
                                <div class="col-sm-9">
                                    <input required type="text" v-model.trim='user.firstname' id='firstname'
                                           placeholder="First Name" class="form-control signInInput">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="lastname" class="col-sm-3 col-form-label">Last Name</label>
                                <div class="col-sm-9">
                                    <input required type="text" v-model.trim='user.lastname' id='lastname'
                                           placeholder="Last Name" class="form-control signInInput">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input required type="email" v-model.trim='user.email' id='email'
                                           placeholder="Email" class="form-control signInInput">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="password" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input required type="password" v-model='user.password'
                                           placeholder="Password" id='password' v-bind:class="[ user.password.length != 0 && user.password != user.passwordCheck ? 'invalid' : 'valid' ]"
                                           class="form-control signInInput">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="passwordcheck" class="col-sm-3 col-form-label">Confirm Password</label>
                                <div class="col-sm-9">
                                    <input required type="password" v-model='user.passwordCheck'
                                           placeholder="Confirm Password" id='passwordcheck' v-bind:class="[ user.password != user.passwordCheck ? 'invalid' : 'valid' ]"
                                           class="form-control signInInput">
                                </div>
                            </div>

                            <div class="mb-3 row text-center">
                                <div class="col-sm-4">
                                </div>
                                <div class="col-sm-4">
                                    <button class="btn btn-light btn-lg signInButton" type="submit" :disabled='!isFormValid'>REGISTER</button>
                                </div>
                                <div class="col-sm-4">
                                </div>
                            </div>
                        </div>
                        <br>
                    </form>
                </template>

                <template id="loginFeedback">
                    <!--
                      Easter egg!

                      When a user has successfully registered or signed up,
                      there is a third feedback screen which is not included
                      in the mock ups. Please style these screens so they align
                      with the rest of the designs.
                    -->

                    <div class="feedback">
                        <br>
                        <img src="/img/WSJ_Horizontal.png" class="wsjLogo">
                        <br>

                        <div class="container feedbackContainer">
                            <header>
                                <h2>@{{ title }}</h2>
                            </header>
                            <div>
                                <h3>Welcome <strong>@{{ feedback.data | name }}</strong>!</h3>
                                <p>You may now sign in.</p>
                                <p>Please check the email address provided - @{{feedback.data | email}} - to complete your registration.</p>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
            <div class="tab-pane fade" id="register-tab-pane" role="tabpanel" aria-labelledby="register-tab" tabindex="0">
                <template id="signinIn">
                    <form method="POST" action="{{ route('login') }}" class='signin-form'>
                        @csrf
                        <br>
                        <img src="/img/WSJ_Horizontal.png" class="wsjLogo">
                        <br>
                        <div class="container registerContainer">
                            <br>
                            <h2 class="registerTitle">SIGN IN</h2>
                            <br>
                            <div class="mb-3 row">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input required v-model='user.email' type="email" id='email' placeholder="Email" class="form-control registerInput" name="email">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="password" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input required v-model='user.password' type="password" id='password' placeholder="Password" class="form-control registerInput" name="password">
                                </div>
                            </div>


                            <div class="mb-3 row text-center">
                                <div class="col-sm-4">
                                </div>
                                <div class="col-sm-4">
                                    <button class="btn btn-light btn-lg signInButton" :disabled='!isFormValid' type="submit">SIGN IN</button>
                                </div>
                                <div class="col-sm-4">
                                </div>
                            </div>

                        </div>
                    </form>
                </template>
            </div>
        </div>
    </div>
</body>

</html>
