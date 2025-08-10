@extends('site.layouts.app')
@section('site.title')
@endsection
@section('site.css')
@endsection
@section('site.content')
    <main>

        <!-- page title area start  -->
        <section class="page-title-area">
            <div class="container large">
                <div class="page-title-area-inner section-spacing-top">
                    <div class="page-title-wrapper">
                        <h2 >Bizimlə əlaqə</h2>
                    </div>
                </div>
            </div>
        </section>
        <!-- page title area end  -->

        <!-- contact area start  -->
        <section class="contact-area-contact-page">
            <div class="container large">
                <div class="contact-area-contact-page-inner section-spacing-top">
                    <div class="section-header fade-anim">
                        <div class="section-title-wrapper">
                            <div class="subtitle-wrapper">
                                <span class="section-subtitle">Əlaqə vasitələrimiz</span>
                            </div>
                        </div>
                    </div>
                    <div class="section-content-wrapper fade-anim">
                        <div class="section-content">
                            <div class="contact-mail">
{{--                                <p class="title"></p>--}}
                                <p class="text">
                                    <a href="mailTo:info@nacaspia.com">info@nacaspia.com</a>
                                </p>
                                <p class="text">
                                    <a href="tel:+994552956727">+994552956727</a>
                                </p>
                                <p class="text">
                                    <a href="tel:+994552952767">+994552952767</a>
                                </p>
                            </div>
{{--                        </div>--}}
{{--                        <div class="section-content">--}}
                            <div class="contact-social">
                                <div class="social-links" {{--style="    margin-top: -41px;!important;"--}}>
                                    <a href="#">Facebook</a>
                                    <a href="#">Twitter</a>
                                    <a href="#">LinkedIn</a>
                                    <a href="#">Instagram</a>
                                    <a href="#">Dribbble</a>
                                    <a href="#">Behance</a>
                                </div>
                            </div>
                        </div>

                        <div class="contact-wrap">
                        <div class="map-container" style="margin-top: 30px;">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3038.881233184626!2d49.8510!3d40.4093!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40307d68b4a2a7b3%3A0x9f3c6a9a08efec3!2sBaku!5e0!3m2!1sen!2saz!4v1691847340012!5m2!1sen!2saz"
                                width="100%"
                                height="300"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                        </div>

                        {{--  <div class="contact-wrap">
                              <form id="contact__form" method="POST" action="https://html.ravextheme.com/redox/light/mail.php">
                                  <div class="contact-formwrap">
                                      <div class="contact-formfield">
                                          <input type="text" name="name" id="name" placeholder="Name*">
                                      </div>
                                      <div class="contact-formfield">
                                          <input type="text" name="email" id="email" placeholder="Email*">
                                      </div>
                                      <div class="contact-formfield">
                                          <input type="text" name="phone" id="phone" placeholder="Phone*">
                                      </div>
                                      <div class="contact-formfield">
                                          <input type="text" name="company" id="company" placeholder="Company">
                                      </div>
                                      <div class="contact-formfield">
                                          <select name="Budget" id="Budget">
                                              <option value="0" disabled selected>Budget*</option>
                                              <option value="1">5,000 - 10,000</option>
                                              <option value="2">10,000 - 15,000</option>
                                              <option value="3">15,000 - 20,000</option>
                                              <option value="4">20,000 - 25,000</option>
                                              <option value="5">25,000 - Above</option>
                                          </select>
                                      </div>
                                      <div class="contact-formfield">
                                          <input type="text" name="solution" id="solution" placeholder="Solution*">
                                      </div>
                                      <div class="contact-formfield message">
                                          <input type="text" name="message" id="message" placeholder="Message*">
                                      </div>
                                  </div>
                                  <div class="submit-btn">
                                      <button type="submit" class="rr-btn">
                          <span class="btn-wrap">
                            <span class="text-one">Send Message</span>
                            <span class="text-two">Send Message</span>
                          </span>
                                      </button>
                                  </div>
                                  <div id="response-message"></div>
                              </form>
                          </div>--}}
                    </div>
                </div>
            </div>
        </section>
        <!-- contact area end  -->

    </main>
@endsection
@section('site.js')
@endsection
