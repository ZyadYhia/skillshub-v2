@extends('web.layout')
@section('title')
    verify email
@endsection
@section('main')
    <div class="alert alert-success">
        A verification e-mail sent successfully
    </div>
    <!-- Contact -->
    <div id="contact" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- login form -->
                <div class="col-md-6 col-md-offset-3">
                    <div class="contact-form">
                        <form action="{{ url('email/verification-notification') }}" method="post">
                            @csrf
                            <button type="submit"
                                class="main-button icon-button pull-right">{{ __('web.resend_email') }}</button>
                        </form>


                    </div>
                </div>
                <!-- /login form -->

            </div>
            <!-- /row -->

        </div>
        <!-- /container -->

    </div>
@endsection
