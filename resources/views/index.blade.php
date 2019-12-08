@extends('layouts.index')
@section('content')
                    <section class="box special">
                        <header class="major">
                            <h2>Introducing the new way to manage your children meal
                            <br />
                            even while they at school</h2>
                            <p>Being a parent, we always worried about what our children eat at school. Sometimes even school provides student with junk food. It has no nutritional value and bad for their health.</p>
                        </header>
                        <span class="image featured"><img src="{{ asset('images/fa-healthy-school-lunch.jpg') }}" alt="" /></span>
                    </section>

                    <section class="box special features">
                        <div class="features-row">
                            <section>
                                <span class="icon solid major fa-bolt accent2"></span>
                                <h3>Access Anywhere, Anytime</h3>
                                <p>With these days, almost everyone has smartphones. Parents can access this system at any moment as this system compatible with all kind of devices.</p>
                            </section>
                            <section>
                                <span class="icon solid major fa-chart-area accent3"></span>
                                <h3>Keep Track Children Expenses</h3>
                                <p>Having problems such as misplaced or spending on unnecessary things such as junk food can be avoided because you are no longer giving pocket money for them. You are the one who manage it.</p>
                            </section>
                        </div>
                        <div class="features-row">
                            <section>
                                <span class="icon solid major fa-cloud accent4"></span>
                                <h3>Preserve Clean Environment</h3>
                                <p>You have no idea on how much food waste produced each day by canteen provider. Children do not purchase anything and only focusing on playing with friends during recess time.</p>
                            </section>
                            <section>
                                <span class="icon solid major fa-lock accent5"></span>
                                <h3>Prevention Better than Curing</h3>
                                <p>Get rid of Diabetes and Obesity among children effectively and keep your children as healthy as much with nutritional food.</p>
                            </section>
                        </div>
                    </section>

                    <div class="row">
                        <div class="col-6 col-12-narrower">

                            <section class="box special">
                                <span class="image featured"><img src="images/question-marks.jpg" height="200" alt="" /></span>
                                <h3>Why we provide this special service to you</h3>
                                <p>Our mission to enable parents monitor on their children's diet and also reducing food waste made by Canteen provider.</p>
                                <ul class="actions special">
                                    <li><a href="{{ url('/mission') }}" class="button alt">Learn More</a></li>
                                </ul>
                            </section>

                        </div>
                        <div class="col-6 col-12-narrower">

                            <section class="box special">
                                <span class="image featured"><img src="images/shutterstock_331286375-new-old.jpg" height="200" alt="" /></span>
                                <h3>Traditional to Modern Canteen Experience</h3>
                                <p>Now, you do not have to give any pocket money to your children as sometimes it was used for other things such as toys and many more. School will take care of these things.</p>
                                <ul class="actions special">
                                    <li><a href="{{ url('/solution') }}" class="button alt">Learn More</a></li>
                                </ul>
                            </section>

                        </div>
                    </div>
@endsection