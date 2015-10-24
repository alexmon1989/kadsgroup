@extends('marketing.layout.master')

@section('page_title')
Контакти
@stop

@section('top_content')
@slider()
@include('marketing.layout.breadcrumbs', [
            'title' => 'Контакти',
            'items' => array(
                    array('title' => 'Головна', 'action' => 'Marketing\HomeController@index', 'active' => FALSE),
                    array('title' => 'Контакти', 'action' => '', 'active' => TRUE),
            )
        ])
@stop

@section('full_width')
<!-- Google Map -->
<div id="map" class="map">
</div><!---/map-->
<!-- End Google Map -->
@stop

@section('content')

<div class="row margin-bottom-30">
    <div class="col-md-9 mb-margin-bottom-30">
        <div class="headline"><h2>Напишіть нам</h2></div>
        @if ($contacts_form_text->full_text)
        {!! $contacts_form_text->full_text !!}<br />
        @endif
        <form action="{{ action('Marketing\ContactsController@postIndex') }}" method="post" id="sky-form3" class="sky-form contact-style">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <fieldset class="no-padding">
                <label>Ваше ім'я <span class="color-red">*</span></label>
                <div class="row sky-space-20">
                    <div class="col-md-7 col-md-offset-0">
                        <div>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                    </div>
                </div>

                <label>Email <span class="color-red">*</span></label>
                <div class="row sky-space-20">
                    <div class="col-md-7 col-md-offset-0">
                        <div>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>
                    </div>
                </div>

                <label>Повідомлення <span class="color-red">*</span></label>
                <div class="row sky-space-20">
                    <div class="col-md-11 col-md-offset-0">
                        <div>
                            <textarea rows="8" name="message" id="message" class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                <p><button type="submit" class="btn-u">Надіслати</button></p>
            </fieldset>

            <div class="message">
                <i class="rounded-x fa fa-check"></i>
                <p>Ваше повідомлення успішно відправлено!</p>
            </div>
        </form>
    </div><!--/col-md-9-->

    <div class="col-md-3">
        @if ($contacts_contacts->full_text)
        <!-- Contacts -->
        <div class="headline"><h2>Контакти</h2></div>
        {!! $contacts_contacts->full_text !!}
        @endif

        @if ($contacts_working_time->full_text)
        <!-- Business Hours -->
        <div class="headline"><h2>Робочий час</h2></div>
        {!! $contacts_working_time->full_text !!}
        @endif

        @if ($contacts_why_us->full_text)
        <!-- Why we are? -->
        <div class="headline"><h2>Чому саме ми?</h2></div>
        {!! $contacts_why_us->full_text !!}
        @endif
    </div><!--/col-md-3-->
</div><!--/row-->

@stop


@section('styles')
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
    <!--[if lt IE 9]><link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms-ie8.css"><![endif]-->
@stop

@section('scripts')
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" src="assets/plugins/gmap/gmap.js"></script>
    <script type="text/javascript" src="assets/js/pages/page_contacts.js"></script>
    <script type="text/javascript" src="assets/js/forms/contact.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            ContactForm.initContactForm();
            var lat = 50.49210329318915;
            var lng = 30.472668999999982;
            ContactPage.initMap(lat, lng);
        });
    </script>
@stop