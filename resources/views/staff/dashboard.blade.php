@extends('layouts.staff-app')

@section('content')
                    <section class="box special">
                        <header class="major">
                            <h2>Staff Homepage</h2>
                            <p>Orders were based on parents demand.</p>
                        </header>
                        <!-- <span class="image featured"><img src="{{ asset('images/pic01.jpg') }}" alt="" /></span> -->
                    </section>

                    <section class="box special features">
                        @include('flash-message')
                        <div class="features-row">
                            <section>
                                <span class="icon solid major fa-bolt accent2"></span>
                                <h3>Redemption</h3>
                                <!-- <p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum phasellus iaculis accumsan dolore magna aliquam veroeros.</p> -->
                                <ul class="alt">
                                    <li>
                                       <a href="{{url('/staff/redeem')}}">Scanner</a>
                                    </li>
                                </ul>
                            </section>
                            <section>
                                <span class="icon solid major fa-chart-area accent3"></span>
                                <h3>Menu Management</h3>
                                <!-- <p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum phasellus iaculis accumsan dolore magna aliquam veroeros.</p> -->
                                <ul class="alt">
                                    <li>
                                       <a href="{{url('/staff/viewmenu')}}">List Menu</a>
                                    </li>
                                </ul>
                            </section>
                        </div>
                        <div class="features-row">
                            <section>
                                <span class="icon solid major fa-cloud accent4"></span>
                                <h3>Order List</h3>
                                <!-- <p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum phasellus iaculis accumsan dolore magna aliquam veroeros.</p> -->
                                <ul class="alt">
                                    <li>
                                       <a href="{{url('/staff/listorder')}}">List Orders</a>
                                    </li>
                                </ul>
                            </section>
                            <section>
                                <span class="icon solid major fa-lock accent5"></span>
                                <h3>Order Summary</h3>
                                <!-- <p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum phasellus iaculis accumsan dolore magna aliquam veroeros.</p> -->
                                <ul class="alt">
                                    <li>
                                       <a href="{{url('/staff/ordersummary')}}">Orders Summary</a>
                                    </li>
                                </ul>
                            </section>
                        </div>
                    </section>
@endsection

