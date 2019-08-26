@extends('layouts.app')
@section('content')
    <div class="container-indent">
        <div class="container">
            <h1 class="tt-title-subpages noborder">LOGIN AND REGISTRATION</h1>
            <div class="tt-login-form">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="tt-item">
                            <h2 class="tt-title">Register</h2>
                            Please Register Your Account
                            <div class="form-default form-top">
                                <form id="customer_login" method="post" novalidate="novalidate">
                                    <div class="form-group">
                                        <label for="loginInputName">First Name *</label>
                                        <div class="tt-required">* Required Fields</div>
                                        <input type="text" name="name" class="form-control" id="loginInputName" placeholder="First Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="loginInputEmail">Last Name</label>
                                        <input type="text" name="passowrd" class="form-control" id="loginInputEmail" placeholder="Last Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="loginInputEmail">Email</label>
                                        <input type="text" name="passowrd" class="form-control" id="loginInputEmail" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="loginInputEmail">Contact Number</label>
                                        <input type="text" name="passowrd" class="form-control" id="loginInputEmail" placeholder="Contact Number">
                                    </div>
                                    <div class="form-group">
                                        <label for="loginInputEmail">Address</label>
                                        <input type="text" name="passowrd" class="form-control" id="loginInputEmail" placeholder="Address">
                                    </div>

                                    <div class="row">
                                        <div class="col-auto mr-auto">
                                            <div class="form-group">
                                                <button class="btn btn-border" type="submit">Register</button>
                                            </div>
                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="col-xs-12 col-md-6">
                        <div class="tt-item">
                            <h2 class="tt-title">LOGIN</h2>
                            If you have an account with us, please log in.
                            <div class="form-default form-top">
                                <form id="customer_login" method="post" action="/login" novalidate="novalidate">
                                    @csrf
                                    <div class="form-group">
                                        <label for="loginInputName">USERNAME OR E-MAIL *</label>
                                        <div class="tt-required">* Required Fields</div>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="E-mail">
                                    </div>
                                    <div class="form-group">
                                        <label for="loginInputEmail">PASSWORD *</label>
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
                                    </div>
                                    <div class="row">
                                        <div class="col-auto mr-auto">
                                            <div class="form-group">
                                                <button class="btn btn-border" type="submit">LOGIN</button>
                                            </div>
                                        </div>
                                        <div class="col-auto align-self-end">
                                            <div class="form-group">
                                                <ul class="additional-links">
                                                    <li><a href="#">Lost your password?</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection