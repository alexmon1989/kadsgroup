@extends('marketing.layout.master')

@section('page_title'){{ $contacts_form_text->page_title != '' ? $contacts_form_text->page_title  : 'Контакты' }}@stop

@section('top_content')
@slider()
@include('marketing.layout.breadcrumbs', [
            'title' => $contacts_form_text->page_h1 != '' ? $contacts_form_text->page_h1  : 'Контакты',
            'items' => [
                    ['title' => 'Главная', 'action' => 'Marketing\HomeController@index', 'active' => FALSE],
                    ['title' => 'Контакты', 'action' => '', 'active' => TRUE],
            ]
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
        <div class="headline"><h2>Напишите нам</h2></div>
        @if ($contacts_form_text->full_text)
        {!! $contacts_form_text->full_text !!}<br />
        @endif
        <form action="{{ action('Marketing\ContactsController@postIndex') }}" method="post" id="sky-form3" class="sky-form contact-style">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <fieldset class="no-padding">
                <label>Ваше имя <span class="color-red">*</span></label>
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

                <label>Сообщение <span class="color-red">*</span></label>
                <div class="row sky-space-20">
                    <div class="col-md-11 col-md-offset-0">
                        <div>
                            <textarea rows="8" name="message" id="message" class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                <p><button type="submit" class="btn-u">Отправить</button></p>
            </fieldset>

            <div class="message">
                <i class="rounded-x fa fa-check"></i>
                <p>Ваше сообщение успешно отправлено!</p>
            </div>
        </form>
    </div><!--/col-md-9-->

    <div class="col-md-3">
        @if ($contacts_contacts->full_text)
        <!-- Contacts -->
        <div class="headline"><h2>Контакты</h2></div>
        {!! $contacts_contacts->full_text !!}
        @endif

        @if ($contacts_working_time->full_text)
        <!-- Business Hours -->
        <div class="headline"><h2>Рабочее время</h2></div>
        {!! $contacts_working_time->full_text !!}
        @endif

        @if ($contacts_why_us->full_text)
        <!-- Why we are? -->
        <div class="headline"><h2>Почему именно мы?</h2></div>
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
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true"></script>
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

@section('meta')
    <meta name="keywords" content="{{ $contacts_form_text->page_keywords }}">
    <meta name="description" content="{{ trim($contacts_form_text->page_description) != '' ? $contacts_form_text->page_description : str_limit(strip_tags($contacts_form_text->full_text), 200) }}">
@stop