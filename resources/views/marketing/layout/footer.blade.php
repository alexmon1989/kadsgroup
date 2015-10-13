<!--=== Footer Version 1 ===-->
<div class="footer-v1">
    <div class="footer">
        <div class="container">
            <div class="row">
                <!-- About -->
                <div class="col-md-3 md-margin-bottom-40">
                    <a href="index.html"><img id="logo-footer" class="footer-logo" src="assets/img/logo-kadsgroup-footer.png" alt="{{ url() }}"></a>
                    <p>About Unify dolor sit amet, consectetur adipiscing elit. Maecenas eget nisl id libero tincidunt sodales.</p>
                    <p>Duis eleifend fermentum ante ut aliquam. Cras mi risus, dignissim sed adipiscing ut, placerat non arcu.</p>
                </div><!--/col-md-3-->
                <!-- End About -->

                @latest_news_footer()

                <!-- Link List -->
                <div class="col-md-3 md-margin-bottom-40">
                    <div class="headline"><h2>Меню</h2></div>
                    <ul class="list-unstyled link-list">
                        <li><a href="{{ @action('Marketing\HomeController@index') }}">Главная</a><i class="fa fa-angle-right"></i></li>
                        <li><a href="#">Сертификаты</a><i class="fa fa-angle-right"></i></li>
                        <li><a href="{{ @action('Marketing\NewsController@getIndex') }}">Новости</a><i class="fa fa-angle-right"></i></li>
                        <li><a href="#">Контакты</a><i class="fa fa-angle-right"></i></li>
                    </ul>
                </div><!--/col-md-3-->
                <!-- End Link List -->

                <!-- Address -->
                <div class="col-md-3 map-img md-margin-bottom-40">
                    <div class="headline"><h2>Свяжитесь с нами</h2></div>
                    <address class="md-margin-bottom-40">
                        м. Київ, <br />
                        Куренівський провулок, 4/8, оф. 5 <br />
                        Тел.: +38 044 379 16 17, +38 097 638 13 09 <br />
                        Email: <a href="mailto:llckadsgroup@gmail.com" class="">llckadsgroup@gmail.com</a>
                    </address>
                </div><!--/col-md-3-->
                <!-- End Address -->
            </div>
        </div>
    </div><!--/footer-->

    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center">
                        2015 &copy; Все права защищены.
                    </p>
                </div>
            </div>
        </div>
    </div><!--/copyright-->
</div>
<!--=== End Footer Version 1 ===-->