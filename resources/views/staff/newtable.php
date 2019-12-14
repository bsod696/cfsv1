@foreach($op as $o)
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th><center>Student</center></th>
                                                    <th><center>Menu</center></th>
                                                    <th><center>Price</center></th>
                                                    <th><center>Quantity</center></th>
                                                    <th><center>Total</center></th>
                                                    <th><center>Serve Date</center></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tr>
                                                <td><center>{{$o->studentname}}</center></td>
                                                <td><center>{{$o->menuname}}</center></td>
                                                <td><center>RM {{$o->menuprice}}</center></td>
                                                <td><center>{{$o->menuqty}} units</center></td>
                                                <td><center>RM {{number_format($o->menuprice*$o->menuqty, 2, '.', '')}}</center></td>
                                                <td><center>{{date_format(date_create($o->menudate), 'd/m/Y')}}</center></td>
                                                <td><center>
                                                    <form action="{{ route('staff.vieworder') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf

                                                        <div class="row gtr-50 gtr-uniform">
                                                            <input id="id" type="hidden" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $o->id }}" hidden />

                                                            <div class="col-12">
                                                                <ul class="actions special">
                                                                    <li>
                                                                        <input type="submit" value="{{ __('View') }}" class="button special fit small"></input>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </center></td>
                                            </tr>
                                        </table>
                                    @endforeach





                                    <h4><b>WEEK: {{ $w }} ({{ date( 'd/m/Y', (mktime( 0, 0, 0, 1, 1, Carbon\Carbon::now()->format('Y') ) + ( $w * 7 * 24 * 60 * 60 )) - 86400 * ( date( 'N', (mktime( 0, 0, 0, 1, 1, Carbon\Carbon::now()->format('Y') ) + ( $w * 7 * 24 * 60 * 60 )) ) - 1 )) }} - {{ date( 'd/m/Y', (mktime( 0, 0, 0, 1, 1, Carbon\Carbon::now()->format('Y') ) + ( $w * 7 * 24 * 60 * 60 )) - 86400 * ( date( 'N', (mktime( 0, 0, 0, 1, 1, Carbon\Carbon::now()->format('Y') ) + ( $w * 7 * 24 * 60 * 60 )) ) - 5 )) }})</b></h4>

                                    <h3><b>WEEK: {{ $w }} ({{ date('d/m/Y',strtotime(Carbon\Carbon::now()->format('Y').'W'.$w)) }} - {{ date_format(Carbon\Carbon::parse(date('d/m/Y',strtotime(Carbon\Carbon::now()->format('Y').'W'.$w)))->addDays(4), 'd/m/Y') }})</b></h3>

                                    <h3><b>WEEK: {{ $w }} ({{ date('d/m/Y',strtotime(Carbon\Carbon::now()->format('Y').'W'.$w)) }} - {{ date_format(Carbon\Carbon::parse(date('d/m/Y',strtotime(Carbon\Carbon::now()->format('Y').'W'.$w)))->addDays(4), 'd/m/Y') }})</b></h3>