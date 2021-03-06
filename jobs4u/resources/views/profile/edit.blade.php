@extends('layouts.app', ['title' => __('User Profile')]) @section('content') @include('users.partials.header', [ 'title' => __('Olá') . ' '. auth()->user()->name, 'description' => __('Essa é sua página. Aqui você pode editar suas informações
!!!'), 'class' => 'col-lg-7' ])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
            <div class="card card-profile shadow">
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                            <a href="#">
                                <img src="{{ '../' . auth()->user()->picture }}" class="rounded-circle">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">

                </div> <br><br><br>
                <div class="card-body pt-0 pt-md-4">

                    <div class="text-center">
                        <h3>
                            {{ auth()->user()->name }}<span class="font-weight-light"></span>
                        </h3>
                        <div class="h5 font-weight-300">
                            {{ auth()->user()->city.', '.auth()->user()->state }}
                        </div>{{--
                        <div class="h5 mt-4">
                            <i class="ni business_briefcase-24 mr-2"></i>{{ __('Solution Manager - Creative Tim Officer') }}
                    </div>
                    <div>
                        <i class="ni education_hat mr-2"></i>{{ __('University of Computer Science') }}
                    </div> --}}
                    <hr class="my-4" />
                    <p>{{ auth()->user()->description }}</p>
                    {{-- <a href="#">{{ __('Show more') }}</a> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8 order-xl-1">
        <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center">
                    <h3 class="col-12 mb-0">{{ __('Editar Perfil') }}</h3>
                </div>
            </div>

            <div class="card-body">
                <form method="post" action="{{ route('profile.update') }}" autocomplete="off" enctype="multipart/form-data">
                    @csrf @method('put')

                    <h6 class="heading-small text-muted mb-4">{{ __('Informação do Usuário') }}</h6>

                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="pl-lg-4">

                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-name">{{ __('Nome') }}</label>
                            <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nome') }}" value="{{ old('name', auth()->user()->name) }}" required> @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span> @endif
                        </div>

                        <div class="form-group{{ $errors->has('surname') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-surname">{{ __('Sobrenome') }}</label>
                            <input type="text" name="surname" id="input-surname" class="form-control form-control-alternative{{ $errors->has('surname') ? ' is-invalid' : '' }}" placeholder="{{ __('Sobrenome') }}" value="{{ old('surname', auth()->user()->surname) }}" required> @if ($errors->has('surname'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('surname') }}</strong>
                            </span> @endif
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                            <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required> @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span> @endif
                        </div>

                        <div class="form-group{{ $errors->has('picture') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-picture">{{ __('Foto') }}</label>
                            <input type="file" name="picture" id="input-picture" class="form-control"> @if ($errors->has('picture'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('picture') }}</strong>
                            </span> @endif
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4">{{ __('Salvar') }}</button>
                        </div>
                    </div>
                </form>
                <hr class="my-4" />

                <div class="card-body">
                    <form method="post" action="{{ route('profile.update.phone') }}" autocomplete="off">
                        @csrf @method('put')

                        <h6 class="heading-small text-muted mb-4">{{ __('Telefone') }}</h6>


                        <div class="pl-lg-4">

                            <div class="form-group{{ $errors->has('number') ? ' has-danger' : '' }}">
                                @if(count($telefones) > 0)
                                <label class="form-control-label" for="input-number">{{ __('Telefone') }}</label> @foreach ($telefones as $tel)
                                <input type="text" class="form-control mb-2" name="phones[]" value="{{ $tel->number }}">
                                <input type="hidden" name="oldPhones[]" value="{{ $tel->id }}"> @endforeach @endif
                                <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#addPhone">
                                    Adicionar Novo Numero
                                </button>
                                <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                                <input type="hidden" name="email" value="{{ auth()->user()->email }}"> @if ($errors->has('number'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('number') }}</strong>
                                </span> @endif
                            </div>

                        </div>


                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4">{{ __('Salvar') }}</button>
                        </div>
                </div>
                </form>


                <div class="card-body">
                    <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
                        @csrf @method('put')

                        <h6 class="heading-small text-muted mb-4">{{ __('Informação do Job') }}</h6>


                        <div class="pl-lg-4">

                            <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-description">{{ __('Descrição') }}</label>
                                <textarea rows="6" name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="{{ old('description', auth()->user()->description) }}"></textarea>
                                <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                                <input type="hidden" name="email" value="{{ auth()->user()->email }}"> @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span> @endif
                            </div>

                        </div>


                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4">{{ __('Salvar') }}</button>
                        </div>
                </div>
                </form>


                <div class="card-body">
                    <h6 class="heading-small text-muted mb-4">{{ __('Informação do Job') }}</h6>

                    <div class="pl-lg-4">

                        <div class="form-group{{ $errors->has('category') ? ' has-danger' : '' }}">
                            {{-- <label class="form-control-label" for="input-description">{{ __('Categorias') }}</label> --}}
                            <h5 class="form-control-text">
                                Selecione as categorias que se encaixam no seu perfil de prestação de serviço
                            </h5>
                            @if(count($worker_cats) > 0)
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Categoria</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($worker_cats as $item)
                                        <tr>
                                            <th scope="row">
                                                {{ $item->cat_name }}
                                            </th>
                                            <th class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <form action="{{ route('profile.del.category') }}" method="post">
                                                            @csrf @method('delete')
                                                            <input type="hidden" name="id_wc" value="{{ $item->wc_id }}">
                                                            <button type="submit" class="dropdown-item">
                                                                {{ __('Delete') }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif

                            <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#addCategory">
                                Adicionar Categoria
                            </button> @if ($errors->has('category'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('category') }}</strong>
                            </span> @endif
                        </div>
                    </div>

                    <hr class="my-4" />

                    <div class="card-body">
                        <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
                            @csrf @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('Endereço') }}</h6>

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('street') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-street">{{ __('Rua') }}</label>
                                    <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                                    <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                                    <input type="text" name="street" id="input-street" class="form-control form-control-alternative{{ $errors->has('street') ? ' is-invalid' : '' }}" placeholder="{{ __('Rua') }}" value="{{ old('street', auth()->user()->street) }}" required> @if ($errors->has('street'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('street') }}</strong>
                                    </span> @endif
                                </div>

                                <div class="form-group{{ $errors->has('number') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Número') }}</label>
                                    <input type="number" name="number" id="input-number" class="form-control form-control-alternative{{ $errors->has('number') ? ' is-invalid' : '' }}" placeholder="{{ __('Número') }}" value="{{ old('number', auth()->user()->number) }}" required> @if ($errors->has('number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('number') }}</strong>
                                    </span> @endif
                                </div>

                                <div class="form-group{{ $errors->has('postal_code') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-postal_code">{{ __('CEP') }}</label>
                                    <input type="text" name="postal_code" id="input-postal_code" class="form-control form-control-alternative{{ $errors->has('postal_code') ? ' is-invalid' : '' }}" placeholder="{{ __('CEP') }}" value="{{ old('postal_code', auth()->user()->postal_code) }}" required> @if ($errors->has('postal_code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('postal_code') }}</strong>
                                    </span> @endif
                                </div>

                                <div class="form-group{{ $errors->has('complment') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-complment">{{ __('Complemento') }}</label>
                                    <input type="text" name="complment" id="input-complment" class="form-control form-control-alternative{{ $errors->has('complment') ? ' is-invalid' : '' }}" placeholder="{{ __('Complemento') }}" value="{{ old('complment', auth()->user()->complment) }}" required> @if ($errors->has('complment'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('complment') }}</strong>
                                    </span> @endif
                                </div>

                                <div class="form-group{{ $errors->has('city') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-city">{{ __('Cidade') }}</label>
                                    <input type="text" name="city" id="input-city" class="form-control form-control-alternative{{ $errors->has('city') ? ' is-invalid' : '' }}" placeholder="{{ __('Cidade') }}" value="{{ old('city', auth()->user()->city) }}" required> @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span> @endif
                                </div>


                                <div class="form-group{{ $errors->has('state') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-city">{{ __('Estado') }}</label>
                                    <select class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }} " name="state">
                                        @foreach ($estados as $estado)
                                        <option value="{{explode(" - ", $estado)[1]}}" {{ auth()->user()->state == explode(" - ", $estado)[1] ? 'selected' : '' }}>
                                            {{ __(explode(" - ", $estado)[0])}}
                                        </option>
                          
                                    @endforeach
                                    </select> @if ($errors->has('state'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span> @endif
                                </div>


                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Salvar') }}</button>
                                </div>
                            </div>
                        </form>

                        <hr class="my-4" />
                        <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                            @csrf @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('Trocar Senha') }}</h6>

                            @if (session('password_status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('password_status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-current-password">{{ __('Senha Antiga') }}</label>
                                    <input type="password" name="old_password" id="input-current-password" class="form-control form-control-alternative{{ $errors->has('old_password') ? ' is-invalid' : '' }}" value="" required> @if ($errors->has('old_password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span> @endif
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">{{ __('Nova Senha') }}</label>
                                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" value="" required> @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span> @endif
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label" for="input-password-confirmation">{{ __('Confirma Nova Senha') }}</label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" value="" required>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Salvar') }}</button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addPhone" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Adicione aqui o numero do seu telefone</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('profile.add.phone') }}" autocomplete="off">
                            @csrf @method('post')

                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-phone">{{ __('Telefone') }}</label>
                                    <input type="text" name="phone" id="input-phone" class="form-control form-control-alternative" placeholder="{{ __('Telefone') }}" required>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Salvar') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Adicione aqui o numero do seu telefone</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('profile.add.category') }}" autocomplete="off">
                            @csrf @method('post')

                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-phone">{{ __('Categoria') }}</label>
                                    <select name="category" id="" class="form-control">
                                        @foreach ($categorias as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Salvar') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
    @endsection