<!--=== Footer Version 1 ===-->
<div class="footer-v1">
    <div class="footer">
        <div class="container">
            <div class="row">
                @footer_about()

                @footer_latest_news()

                <!-- Link List -->
                <div class="col-md-3 md-margin-bottom-40">
                    <div class="headline"><h2>Меню</h2></div>
                    <ul class="list-unstyled link-list">
                        <li><a href="{{ @action('Marketing\HomeController@index') }}">Головна</a><i class="fa fa-angle-right"></i></li>
                        <li><a href="{{ @action('Marketing\CertificatesController@getIndex') }}">Сертифікати</a><i class="fa fa-angle-right"></i></li>
                        <li><a href="{{ @action('Marketing\NewsController@getIndex') }}">Новини</a><i class="fa fa-angle-right"></i></li>
                        <li><a href="{{ @action('Marketing\ContactsController@getIndex') }}">Контакти</a><i class="fa fa-angle-right"></i></li>
                    </ul>
                </div><!--/col-md-3-->
                <!-- End Link List -->

               @footer_contacts()
            </div>
        </div>
    </div><!--/footer-->

    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center">
                        {{ date('Y') }} &copy; Все права защищены.
                    </p>
                </div>
            </div>
        </div>
    </div><!--/copyright-->
</div>
<!--=== End Footer Version 1 ===-->