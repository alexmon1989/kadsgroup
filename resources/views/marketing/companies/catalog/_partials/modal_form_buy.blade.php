<div class="margin-bottom-40">
    <div class="modal fade" id="responsive" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="sky-form" id="sky-form" method="post" action="{{ route('order') }}">
                    <header>
                        Купить товар
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </header>

                    <fieldset>
                        <h5>Пожалуйста, заполните форму и мы свяжемся с вами.</h5>
                        <div class="row">
                            <section class="col col-6">
                                <label class="input">
                                    <i class="icon-append fa fa-user"></i>
                                    <input type="text" placeholder="Ваше имя" name="username">
                                </label>
                            </section>
                            <section class="col col-6">
                                <label class="input">
                                    <i class="icon-append fa fa-briefcase"></i>
                                    <input type="text" placeholder="Компания" name="company">
                                </label>
                            </section>
                        </div>

                        <div class="row">
                            <section class="col col-6">
                                <label class="input">
                                    <i class="icon-append fa fa-envelope-o"></i>
                                    <input type="email" placeholder="E-mail" name="email">
                                </label>
                            </section>
                            <section class="col col-6">
                                <label class="input">
                                    <i class="icon-append fa fa-phone"></i>
                                    <input type="tel" placeholder="Контактный телефон" name="phone">
                                </label>
                            </section>
                        </div>

                        <section>
                            <label class="textarea">
                                <i class="icon-append fa fa-comment"></i>
                                <textarea placeholder="Комментарий" name="comment" rows="5"></textarea>
                            </label>
                        </section>

                        <input type="hidden" name="product_title" name="product_id" value="{{ $product->title }}">
                        {{ csrf_field() }}
                    </fieldset>

                    <footer>
                        <button type="button" class="btn-u rounded btn-u-default" data-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn-u rounded btn-u-primary">Отправить</button>

                        <div id="form-buy-error" class="alert alert-danger fade in margin-top-20" style="display: none">
                            <strong>Ошибка!</strong> Не удалось сохранить заявку.
                        </div>
                    </footer>
                    <div class="message">
                        <i class="rounded-x fa fa-check"></i>
                        <p>Спасибо за заявку!<br>Мы свяжемся с вами очень скоро.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>