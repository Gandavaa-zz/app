@extends('layouts.app')


@section('content')
<div class="container-fluid">

    <div class="cover">
        <div class="cover-layer">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profil-det-img d-flex">
                           <div class="">
                                <img src="http://lofrev.net/wp-content/photos/2017/05/user_black_logo.jpg" alt="" width="40%">
                           </div>
                           <div class="pd">
                               <h2>Joney Smith</h2>
                                <p>Web Designer</p>
                           </div>

                        </div>
                    </div>
                    <div class="col-md-4 eml-mob">
                        <ul class="">
                            <li><i class="cil-shield-alt"></i> joneysmith@gmail.com</li>
                            <li><i class="fa fa-phone-square"></i> +123 234 234</li>
                        </ul>
                    </div>
                    <div class="col-md-4 d-flex map-mark">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>First Floor,Vincent Plaza, Kuzhithurai, Marthandam </p>
                    </div>
                </div>
                <div class="nav-detail">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                       <li class="nav-item">

                         <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                       </li>
                       <li class="nav-item">
                         <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                       </li>
                       <li class="nav-item">
                         <a class="nav-link" id="education-tab" data-toggle="tab" href="#education" role="tab" aria-controls="contact" aria-selected="false">Resume</a>
                       </li>
                       <li class="nav-item">
                         <a class="nav-link" id="portfolio-tab" data-toggle="tab" href="#portfolio" role="tab" aria-controls="contact" aria-selected="false">Portfolio</a>
                       </li>
                       <li class="nav-item">
                         <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact Us</a>
                       </li>
                     </ul>
                     <div class="tab-content" id="myTabContent">
                       <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                           <div class="row no-margin home-det">
                               <div class="col-md-4 big-img">
                                  <img src="assets/images/profile-big.jpg" alt="">
                               </div>
                               <div class="col-md-8 home-dat">
                                   <div class="detal-jumbo">
                                       <h3>Hellow I'm Web Designer / Developer</h3>
                                       <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
                                   </div>
                                   <div class="links">
                                   <div class="row ">
                                       <div class="col-xl-6 col-md-12">
                                           <ul class="btn-link">
                                               <li>
                                                   <a href=""><i class="fas fa-paper-plane"></i> Hire Me</a>
                                               </li>
                                               <li>
                                                   <a href=""><i class="fas fa-cloud-download-alt"></i> Download Resume</a>
                                               </li>
                                           </ul>
                                       </div>
                                       <div class="col-xl-6 col-md-12">
                                           <ul class="social-link">
                                               <li><i class="fab fa-facebook-f"></i></li>
                                               <li><i class="fab fa-twitter"></i></li>
                                               <li><i class="fab fa-pinterest-p"></i></li>
                                               <li><i class="fab fa-linkedin-in"></i></li>
                                               <li><i class="fab fa-linkedin-in"></i></li>
                                               <li><i class="fab fa-youtube"></i></li>
                                           </ul>
                                       </div>
                                   </div>
                               </div>
                               <div class="jumbo-address">
                                  <div class="row no-margin">
                                           <div class="col-lg-6 no-padding">

                                           <table class="addrss-list">
                                               <tbody><tr>
                                                   <th>Position</th>
                                                   <td>Freelance</td>
                                               </tr>
                                               <tr>
                                                   <th>Nationality</th>
                                                   <td>American</td>
                                               </tr>
                                               <tr>
                                                   <th>Date of birth</th>
                                                   <td>09-06-1989</td>
                                               </tr>
                                           </tbody></table>

                                   </div>
                                   <div class="col-lg-6 no-padding">
                                        <table class="addrss-list">
                                               <tbody><tr>
                                                   <th>Experiance</th>
                                                   <td>5+ Years</td>
                                               </tr>
                                               <tr>
                                                   <th>Website</th>
                                                   <td>www.yourdomain.com</td>
                                               </tr>
                                               <tr>
                                                   <th>Languages</th>
                                                   <td>English,French,Germany</td>
                                               </tr>
                                           </tbody></table>
                                   </div>
                                  </div>

                               </div>
                               </div>
                           </div>

                       </div>
                       <div class="tab-pane fade profile-tab" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                           <div class="profile-desic">
                               <br>
                                   <p>Hello, I’m UI/UX Developer / Wordpress Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa.</p>
                               </div>
                               <div class="sec-title">
                                   <h2>Services</h2> 
                               </div>
                               <div class="row service-ro no-margin">
                                   <div class="col-lg-4 col-md-6 singe-servic">
                                          <i class="fab fa-delicious"></i>
                                           <h4>Graphic Design</h4>
                                           <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                   </div>
                                   <div class="col-lg-4 col-md-6 singe-servic">
                                          <i class="fas fa-code"></i>
                                           <h4>Website Design</h4>
                                           <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                   </div>
                                   <div class="col-lg-4 col-md-6 singe-servic">
                                          <i class="fab fa-chrome"></i>
                                           <h4>Web Development</h4>
                                           <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                   </div>
                                   <div class="col-lg-4 col-md-6 singe-servic">
                                          <i class="fab fa-android"></i>
                                           <h4>Android Development</h4>
                                           <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                   </div>
                                   <div class="col-lg-4 col-md-6 singe-servic">
                                          <i class="fab fa-app-store-ios"></i>
                                           <h4>IOS Design</h4>
                                           <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                   </div>
                                   <div class="col-lg-4 col-md-6 singe-servic">
                                          <i class="fas fa-mobile-alt"></i>
                                           <h4>Ionic Development</h4>
                                           <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                   </div>
                               </div>

                       </div>
                       <div class="tab-pane education-detail fade" id="education" role="tabpanel" aria-labelledby="contact-tab">
                           <div class="sec-title">
                                 <h2>Education Details</h2>
                           </div>
                            <div class="service no-margin row">
                                   <div class="col-sm-3 resume-dat serv-logo">
                                       <h6>2013-2015</h6>
                                     <p>Master Degree</p>
                                   </div>
                                   <div class="col-sm-9 rgbf">
                                       <h5>Cambridg University</h5>
                                       <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                   </div>
                               </div>
                               <div class="service no-margin row">
                                   <div class="col-sm-3 resume-dat serv-logo">
                                       <h6>2013-2015</h6>
                                     <p>Bacholers Degree</p>
                                   </div>
                                   <div class="col-sm-9 rgbf">
                                       <h5>Anna University</h5>
                                       <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                   </div>
                               </div>
                               <div class="service no-margin row">
                                   <div class="col-sm-3 resume-dat serv-logo">
                                       <h6>2013-2015</h6>
                                     <p>High School</p>
                                   </div>
                                   <div class="col-sm-9 rgbf">
                                       <h5>A.M.H.S.S</h5>
                                       <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                   </div>
                               </div>
                               <div class="service no-margin row">
                                   <div class="col-sm-3 resume-dat serv-logo">
                                       <h6>2013-2015</h6>
                                     <p>School</p>
                                   </div>
                                   <div class="col-sm-9 rgbf">
                                       <h5>Anna University</h5>
                                       <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                   </div>
                               </div>
                           </div>
                            <div class="tab-pane portfolio-detail fade" id="portfolio" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="row no-margin gallery">
                                   <div class="col-sm-4">
                                       <img src="assets/images/gallery/gallery_01.jpg" alt="">
                                   </div>
                                   <div class="col-sm-4">
                                       <img src="assets/images/gallery/gallery_02.jpg" alt="">
                                   </div>
                                   <div class="col-sm-4">
                                       <img src="assets/images/gallery/gallery_03.jpg" alt="">
                                   </div>
                                   <div class="col-sm-4">
                                       <img src="assets/images/gallery/gallery_04.jpg" alt="">
                                   </div>
                                   <div class="col-sm-4">
                                       <img src="assets/images/gallery/gallery_05.jpg" alt="">
                                   </div>
                                   <div class="col-sm-4">
                                       <img src="assets/images/gallery/gallery_06.jpg" alt="">
                                   </div>
                                    <div class="col-sm-4">
                                       <img src="assets/images/gallery/gallery_10.jpg" alt="">
                                   </div>
                                    <div class="col-sm-4">
                                       <img src="assets/images/gallery/gallery_08.jpg" alt="">
                                   </div>
                                    <div class="col-sm-4">
                                       <img src="assets/images/gallery/gallery_09.jpg" alt="">
                                   </div>

                               </div>
                            </div>
                            <div class="tab-pane portfolio-detail contact-tab fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                               <div class="row no-margin">
                                   <div class="col-md-6 no-padding">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3176144.0450019627!2d-107.79423426090409!3d38.97644533805396!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x874014749b1856b7%3A0xc75483314990a7ff!2sColorado%2C+USA!5e0!3m2!1sen!2sin!4v1547222354537"  frameborder="0" style="border:0" allowfullscreen></iframe>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="row cont-row no-margin">
                                           <div class="col-sm-6">
                                               <input placeholder="Enter Full Name" type="text" class="form-control form-control-sm">
                                           </div>
                                            <div class="col-sm-6">
                                               <input placeholder="Enter Email Address" type="text" class="form-control form-control-sm">
                                           </div>
                                       </div>
                                       <div class="row cont-row no-margin">
                                           <div class="col-sm-6">
                                               <input placeholder="Enter Mobile Number" type="text" class="form-control form-control-sm">
                                           </div>

                                       </div>
                                       <div class="row cont-row no-margin">
                                           <div class="col-sm-12">
                                              <textarea placeholder="Enter your Message" class="form-control form-control-sm" rows="10"></textarea>
                                           </div>

                                       </div>
                                       <div class="row cont-row no-margin">
                                           <div class="col-sm-6">
                                               <button class="btn btn-sm btn-success">Send Message</button>
                                           </div>

                                       </div>
                                   </div>
                               </div>

                           </div>
                       </div>
                     </div>
                </div>
            </div>
        </div>
    </div>

@endsection
