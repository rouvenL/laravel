@extends('layouts.app') @section('content')
<!-- Admin Section -->

<div class="table-responsive">
    @if(Request::is('admin'))
    <div class="card-body">
        <table class="table table-bordered table-hover table-sm" style="table-layout: fixed;">
            <thead>
                <tr>
                    <td scope="col">User_ID</td>
                    <td scope="col">Vorname</td>
                    <td scope="col">Nachname</td>
                    <td scope="col">Firma</td>
                    <td scope="col">Email</td>
                    <td scope="col">Password</td>
                    <td scope="col">Type</td>
                </tr>
            </thead>
            @foreach($users as $user => $value)
            <tr class="table-tr" data-url="/admin/{{$value->id}}">
                <td>{{$value->id}}</td>
                <td>{{$value->name}}</td>
                <td>{{$value->surname}}</td>
                <td>{{$value->company->company_name}}</td>
                <td>{{$value->email}}</td>
                <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{$value->password}}</td>
                <td>{{$value->type}}</td>
            </tr>
            @endforeach
        </table>
        <a href="admin/newuser" role="button" class="btn btn-primary mb-3">Add a User</a>
        <table class="table table-bordered table-hover table-sm">
            <thead>
                <tr>
                    <td>Company-ID</td>
                    <td>Name</td>
                    <td>Operating Status</td>
                </tr>
            </thead>
            @foreach($companies as $company => $value)
            <tr class="table-tr" data-url="/admin/company/{{$value->id}}">
                <td>{{$value->id}}</td>
                <td>{{$value->company_name}}</td>
                <td>{{$value->operating_status}}</td>
            </tr>
            @endforeach
        </table>
        <a href="admin/newcompany" role="button" class="btn btn-primary">Add a Company</a>
    </div>
    @endif @if(Request::is('admin/company/*'))
    <div class="card-body">
        <form method="POST" action="{{ route('admin.company.update', $id)}}">
            @method('PUT') @csrf
            <table class="table table-bordered table-hover" style="table-layout: fixed;">
                <thead>
                    <tr>
                        <td>Company-ID</td>
                        <td>Name</td>
                        <td>Operating Status</td>
                    </tr>
                </thead>

                @foreach($companies as $company => $value)

                <tr class="table-tr" data-url="/admin/company/{{$value->id}}">
                    @if($value->id == $id)
                    <td>{{$value->id}}</td>
                    <td>
                        <input name="company_name" type="text" class="form-control" placeholder="{{$value->company_name}}">
                    </td>
                    <td>
                        <input name="operating_status" type="text" class="form-control" placeholder="{{$value->operating_status}}">
                    </td>
                    @else
                    <td>{{$value->id}}</td>
                    <td>{{$value->company_name}}</td>
                    <td>{{$value->operating_status}}</td>
                    @endif
                </tr>
                @endforeach
                <div class="form-group">
                    <div class="float-left">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Change Data') }}
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <div class="mb-3 float-right">
                        <button class="btn btn-danger" type="submit" name="delete" value="delete">Delete</button>
                    </div>
                </div>
            </table>
        </form>
    </div>
    @elseif(Request::is('admin/newuser'))
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">
                        <form method="POST" action="{{ route('adduser')}}">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                                <div class="col-md-6">
                                    <input type="text" name="surname" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"> @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span> @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="company_id" class="col-md-4 col-form-label text-md-right">{{ __('Company') }}</label>

                                <div class="col-md-6">
                                    <select name="company_id" class="form-control">
                                        @foreach($companies as $company => $value)
                                        <option value="{{ $value->id }}" selected>{{ $value->company_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" name="password" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Add User') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @elseif(Request::is('admin/newcompany'))
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('addcompany') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="company_name" class="col-md-4 col-form-label text-md-right">{{ __('Company Name') }}</label>

                                <div class="col-md-6">
                                    <input type="text" name="company_name" class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" required> 
                                    @if ($errors->has('company_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span> 
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="operating_status" class="col-md-4 col-form-label text-md-right">{{ __('Operating Status') }}</label>

                                <div class="col-md-6">
                                    <input type="text" name="operating_status" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Add Company') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @elseif(Request::is('admin/*'))
    <!-- check if current link has a user id-->
    <div class="form-user-chosen">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.update', $id)}}">
                <!-- get last part of url -> ID -->
                @method('PUT') @csrf
                <table class="table table-bordered table-hover" style="table-layout: fixed;">
                    <thead>
                        <tr>
                            <td scope="col">User_ID</td>
                            <td scope="col">Vorname</td>
                            <td scope="col">Nachname</td>
                            <td scope="col">Firma</td>
                            <td scope="col">Email</td>
                            <td scope="col">Password</td>
                            <td scope="col">Type</td>
                        </tr>
                    </thead>

                    @foreach($users as $user => $value)
                    <tr class="table-tr" data-url="/admin/{{$value->id}}">
                        @if($value->id == $id)
                        <td>{{$value->id}}</td>
                        <td>
                            <input name="name" type="text" class="form-control" placeholder="{{$value->name}}">
                        </td>
                        <td>
                            <input name="surname" type="text" class="form-control" placeholder="{{$value->surname}}">
                        </td>

                        <td>
                            <select name="company_id" class="form-control">
                                @foreach($companies as $company => $nameval) @if($value->company->company_name === $nameval->company_name)
                                <option value="{{$value->company->id}}" class="form-control" selected>{{ $value->company->company_name }}</option>
                                @else
                                <option value="{{$nameval->id}}" class="form-control">{{$nameval->company_name}}</option>
                                @endif @endforeach
                            </select>
                        </td>

                        <td>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="{{$value->email}}"> @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span> @endif
                        </td>

                        <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            <input id="password" type="password" name="password" class="form-control" placeholder="{{$value->password}}">
                        </td>

                        <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            <select name="type">
                                @foreach($types as $type => $typeval) @if($value->type === $typeval)
                                <option value="{{$typeval}}" selected>{{$typeval}}</option>
                                @else
                                <option value="{{$typeval}}">{{$typeval}}</option>
                                @endif @endforeach
                            </select>
                        </td>
                        @else
                        <td>{{$value->id}}</td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->surname}}</td>
                        <td>{{$value->company->company_name}}</td>
                        <td>{{$value->email}}</td>
                        <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{$value->password}}</td>
                        <td>{{$value->type}}</td>
                        @endif
                    </tr>
                    @endforeach
                    <div class="form-group">
                        <div class="mb-3 float-left">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update User') }}
                            </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3 float-right">
                            <button class="btn btn-danger" type="submit" name="delete" value="delete">Delete</button>
                        </div>
                    </div>
                </table>
            </form>
        </div>
    </div>
    @endif
</div>

@endsection