@extends('layout.app')
@section('content')

    @include('layout.alert_message')


    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Senarai Aduan</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-10 col-xs-2">
                    <a href="{{ route('complain.create') }}" class="btn btn-warning">Tambah Aduan</a>
                    <a href="#" class="dropdown-toggle btn btn-default" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        10 <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="#">9</a></li>
                        <li><a href="#">8</a></li>
                        <li><a href="#">7</a></li>
                    </ul>
                </div>
                <div class="col-sm-2 col-xs-10">
                    <input type="text" class="form-control" placeholder="Cari..." aria-describedby="basic-addon1">
                </div>
            </div>
            <br>
            <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <th>Pengadu</th>
                    <th>Aduan</th>
                    <th>Tarikh</th>
                    <th>Status</th>
                    <th>Tindakan</th>
                    <th>ID Daftar</th>
                    <th></th>

                </tr>
                @foreach($complains as $complain)
                <tr>
                    <td>{{ $complain->EMP_ID_ADUAN }}</td>
                    <td>{{ str_limit($complain->ADUAN, 50) }}</td>
                    <td>{{ $complain->TKH_ADUAN }}</td>
                    <td><span class="label label-primary">Baru</span></td>
                    <td>{{ str_limit($complain->TINDAKAN, 50) }}</td>
                    <td>{{ $complain->LOGIN_DAFTAR }}</td>
                    <td>
                        {!! Form::open(['route' => ['complain.destroy',$complain->ADUAN_ID],'method' => 'delete','class' => 'form-horizontal']) !!}
                        <div class="btn-group btn-group-sm">
                            <a class="btn btn-warning" href="{{ route('complain.edit', $complain->ADUAN_ID) }}">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                        </div>


                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </table>
            <nav class="navbar-form navbar-right">
                {{ $complains->appends(Request::except('page'))->links() }}
            </nav>
        </div>
        </div>
    </div>

@endsection
