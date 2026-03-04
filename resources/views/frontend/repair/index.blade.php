@extends('frontend.app')
@section('title', $service->name . ' Appointment')

@section('content')
@php
    $fixmo = 'frontend/assets/fixmo';
    $bannerImage = asset($fixmo . '/img/banner/banner-370.jpg');
    $shortDescription = $service->short_description
        ? Str::limit(strip_tags($service->short_description), 160)
        : 'Schedule your repair with our certified technicians.';
    $longDescription = $service->long_description
        ? Str::limit(strip_tags($service->long_description), 220)
        : '';
    $thumbImage = $service->thumb_image
        ? asset($service->thumb_image)
        : asset($fixmo . '/img/services/service-1.jpg');
@endphp

<div id="main-content" class="site-main clearfix">
    <div id="content-wrap">
        <div id="site-content" class="site-content clearfix">
            <div id="inner-content" class="inner-content-wrap">
                <div class="page-content">
                    <!-- Banner -->
                    <section class="fixmo-banner">
                        <div class="container-fluid p-0">
                            <div class="row m-0 wrap-height">
                                <div class="col-md-5 col-left-banner-all">
                                    <div class="wrap-banner-left wrap-page">
                                        <div class="name-page">
                                            <h2 class="title-heading big text-white">Appointment</h2>
                                            <p class="name title-small mb-0">
                                                <a class="name title-small space" href="{{ route('front.home') }}">Home</a>
                                                Appointment / {{ $service->name }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7 col-right-banner-all">
                                    <div class="wrap-banner-right">
                                        <img class="img-banner" src="{{ $bannerImage }}" alt="Appointment">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="themesflat-spacer clearfix" data-desktop="0" data-mobile="0" data-smobile="0"></div>
                    </section>
                    <!-- End Banner -->

                    <!-- Appointment -->
                    <section class="row-contact">
                        <div class="container">
                            <div class="themesflat-spacer clearfix" data-desktop="100" data-mobile="60" data-smobile="60"></div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="themesflat-headings contact clearfix">
                                        <div class="wrap-inner-small">
                                            <h5 class="title-heading small m-0">Appointment</h5>
                                        </div>
                                        <div class="wrap-inner-big">
                                            <h2 class="title-heading big">{{ $service->name }}</h2>
                                            <p class="title-small">{{ $shortDescription }}</p>
                                        </div>
                                        <img class="appointment-thumb" src="{{ $thumbImage }}" alt="{{ $service->name }}">
                                        @if($longDescription)
                                            <div class="wrap-sub">
                                                <p class="title-small">{{ $longDescription }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="contact-form style-1">
                                        <form action="{{ route('front.repair.submit') }}" method="post" class="form-submit comment-form wpcf7-form">
                                            @csrf
                                            <input type="hidden" name="service_name" value="{{ $service->short_name }}">
                                            <input type="hidden" name="appoinment_date" id="selected_date" readonly>
                                            <input type="hidden" name="appoinment_time" id="selected_time" readonly>

                                            <div class="appointment-field">
                                                <p class="title-small">Schedule Date</p>
                                                <div id="dateButtons" class="appointment-picker"></div>
                                            </div>

                                            <div class="appointment-field">
                                                <p class="title-small">Schedule Time</p>
                                                <div id="timeButtons" class="appointment-picker"></div>
                                            </div>

                                            <span class="wpcf7-form-control-wrap your-name">
                                                <input type="text" name="name" class="wpcf7-form-control" placeholder="Full Name" required>
                                            </span>
                                            <span class="wpcf7-form-control-wrap your-phone">
                                                <input type="text" name="phone" class="wpcf7-form-control" placeholder="Phone Number" required>
                                            </span>
                                            <span class="wpcf7-form-control-wrap your-email">
                                                <input type="email" name="email" class="wpcf7-form-control" placeholder="Email Address" required>
                                            </span>
                                            <span class="wpcf7-form-control-wrap your-address">
                                                <textarea name="address" class="wpcf7-form-control wpcf7-textarea" rows="3" placeholder="Address" required></textarea>
                                            </span>
                                            <span class="wpcf7-form-control-wrap your-message">
                                                <textarea name="short_notes" class="wpcf7-form-control wpcf7-textarea" rows="5" placeholder="Tell us about your device issue" required></textarea>
                                            </span>
                                            <span class="wrap-submit">
                                                <button type="submit" class="submit wpcf7-form-control wpcf7-submit">Book Appointment</button>
                                            </span>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="themesflat-spacer clearfix" data-desktop="118" data-mobile="60" data-smobile="60"></div>
                        </div>
                    </section>
                    <!-- End Appointment -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        function formatDateValue(date) {
            var yyyy = date.getFullYear();
            var mm = String(date.getMonth() + 1).padStart(2, '0');
            var dd = String(date.getDate()).padStart(2, '0');
            return yyyy + '-' + mm + '-' + dd;
        }

        function generateDateButtons(numDays) {
            var currentDate = new Date();
            var endDate = new Date();
            endDate.setDate(currentDate.getDate() + numDays);
            var dateButtons = document.getElementById('dateButtons');

            while (currentDate <= endDate) {
                var button = document.createElement('button');
                button.type = 'button';
                button.textContent = currentDate.toLocaleDateString('en-US', {
                    weekday: 'short',
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                });
                button.value = formatDateValue(currentDate);

                if (currentDate.getDay() === 0) {
                    button.disabled = true;
                } else {
                    button.addEventListener('click', function () {
                        selectDate(this);
                    });
                }

                dateButtons.appendChild(button);
                currentDate.setDate(currentDate.getDate() + 1);
            }
        }

        function selectDate(button) {
            var dateButtons = document.querySelectorAll('#dateButtons button');
            dateButtons.forEach(function (dateButton) {
                dateButton.classList.remove('selected');
            });

            button.classList.add('selected');
            document.getElementById('selected_date').value = button.value;
        }

        function generateTimeButtons(intervalMinutes) {
            var startTime = new Date();
            startTime.setHours(10, 0, 0, 0);
            var endTime = new Date();
            endTime.setHours(20, 0, 0, 0);
            var timeButtons = document.getElementById('timeButtons');

            while (startTime <= endTime) {
                var button = document.createElement('button');
                button.type = 'button';
                button.textContent = startTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                button.value = startTime.toTimeString().split(' ')[0];

                button.addEventListener('click', function () {
                    selectTime(this);
                });

                timeButtons.appendChild(button);
                startTime.setMinutes(startTime.getMinutes() + intervalMinutes);
            }
        }

        function selectTime(button) {
            var timeButtons = document.querySelectorAll('#timeButtons button');
            timeButtons.forEach(function (timeButton) {
                timeButton.classList.remove('selected');
            });

            button.classList.add('selected');
            document.getElementById('selected_time').value = button.value;
        }

        document.addEventListener('DOMContentLoaded', function () {
            generateDateButtons(7);
            generateTimeButtons(60);
        });
    })();
</script>
@endsection
