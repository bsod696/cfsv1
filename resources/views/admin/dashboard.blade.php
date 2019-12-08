@extends('layouts.admin-app')

@section('content')
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (!empty($message))
                        <div class="alert alert-success" role="alert">
                            {{ $message }}
                        </div>
                    @endif

                    <section class="box special">
                        <header class="major">
                            <h2>Admin Homepage</h2>
                            <p>Manage All user data including Users, Menus, Transactions and much more.</p>
                        </header>
                        <!-- <span class="image featured"><img src="{{ asset('images/pic01.jpg') }}" alt="" /></span> -->
                    </section>

                    <section class="box special features">
                        <div class="features-row">
                            <section>
                                <span class="icon solid major fa-bolt accent2"></span>
                                <h3>User Registration</h3>
                                <!-- <p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum phasellus iaculis accumsan dolore magna aliquam veroeros.</p> -->
                                <ul class="alt">
                                    <li>
                                       <a href="{{url('/user/register')}}">Add Parent</a> 
                                    </li>
                                    <li>
                                       <a href="{{url('/staff/register')}}">Add Staff</a> 
                                    </li>
                                    <li>
                                       <a href="{{url('/admin/storestudent')}}">Add Student</a> 
                                    </li>
                                </ul>
                            </section>
                            <section>
                                <span class="icon solid major fa-chart-area accent3"></span>
                                <h3>User Management</h3>
                                <!-- <p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum phasellus iaculis accumsan dolore magna aliquam veroeros.</p> -->
                                <ul class="alt">
                                    <li>
                                       <a href="{{url('/admin/viewparent')}}">List Parent</a> 
                                    </li>
                                    <li>
                                       <a href="{{url('/admin/viewstaff')}}">List Staff</a> 
                                    </li>
                                    <li>
                                       <a href="{{url('/admin/viewstudent')}}">List Student</a> 
                                    </li>
                                </ul>
                            </section>
                        </div>
                        <div class="features-row">
                            <section>
                                <span class="icon solid major fa-cloud accent4"></span>
                                <h3>Menu Management</h3>
                                <!-- <p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum phasellus iaculis accumsan dolore magna aliquam veroeros.</p> -->
                                <ul class="alt">
                                    <li>
                                       <a href="{{url('/admin/storemenu')}}">Add Menu</a>
                                    </li>
                                    <li>
                                       <a href="{{url('/admin/menuselect')}}">List Menu</a>
                                    </li>
                                </ul>
                            </section>
                            <section>
                                <span class="icon solid major fa-lock accent5"></span>
                                <h3>Transaction Management</h3>
                                <!-- <p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum phasellus iaculis accumsan dolore magna aliquam veroeros.</p> -->
                                <ul class="alt">
                                    <li>
                                       <a href="{{url('/admin/vieworder')}}">List Orders</a>
                                    </li>
                                    <li>
                                       <a href="{{url('/admin/listtrans')}}">List Transactions</a>
                                    </li>
                                </ul>
                            </section>
                        </div>
                    </section>
@endsection
