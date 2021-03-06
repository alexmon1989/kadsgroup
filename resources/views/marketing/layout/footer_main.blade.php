<!--=== Footer ===-->
<section id="footer-v7" class="contacts-section">
    <div class="container content-lg">

        <div class="title-v1">
            <h2>Напишите нам</h2>
            <p>Если у вас появились дополнительные вопросы по какому-либо поводу,<br>
                можете прислать нам сообщение или позвонить.</p>
        </div>

        <div class="row contacts-in">
            <div class="col-md-6 md-margin-bottom-40">
                <ul class="list-unstyled">
                    <li><i class="fa fa-home"></i> г. Киев, Куренёвский переулок, 4/8, оф. 5</li>
                    <li><i class="fa fa-phone"></i> +38 044 379 16 17, +38 097 638 13 09</li>
                    <li><i class="fa fa-envelope"></i> <a href="mailto:llckadsgroup@gmail.com">llckadsgroup@gmail.com</a></li>
                    <li><i class="fa fa-globe"></i> <a href="http://kadsgroup.com.ua">www.kadsgroup.com.ua</a></li>
                </ul>
            </div>

            <div class="col-md-6">
                <form action="{{ action('Marketing\ContactsController@postIndex') }}" method="post" id="sky-form3" class="sky-form contact-style">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <label>Ваше имя <span class="color-red">*</span></label>
                        <div class="row">
                            <div class="col-md-7 margin-bottom-20 col-md-offset-0">
                                <div>
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                            </div>
                        </div>

                        <label>Email <span class="color-red">*</span></label>
                        <div class="row">
                            <div class="col-md-7 margin-bottom-20 col-md-offset-0">
                                <div>
                                    <input type="text" name="email" id="email" class="form-control">
                                </div>
                            </div>
                        </div>

                        <label>Сообщение</label>
                        <div class="row">
                            <div class="col-md-11 margin-bottom-20 col-md-offset-0">
                                <div>
                                    <textarea rows="8" name="message" id="message" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                        <p><button type="submit" class="btn-u btn-brd btn-brd-hover btn-u-dark">Отправить</button></p>
                    </fieldset>

                    <div class="message">
                        <i class="rounded-x fa fa-check"></i>
                        <p>Ваше сообщение успешно отправлено!</p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="copyright-section">
        <p>{{ date('Y') }} &copy; Все права защищены.</p>
        <a href="#top"><i class="fa fa-angle-double-up back-to-top"></i></a>
    </div>
</section>
<!--=== End Footer v7 ===-->