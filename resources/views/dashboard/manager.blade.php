@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}

                        @foreach($roles as $role)
                            <span class="badge" style="background-color: grey">
                                    {{$role}}
                                </span>
                        @endforeach


                    </div>
                    <div class="card-body">

                        <h2> Bienvenue sur votre tableau de bord manager!</h2>

                        <h3>Liste des utilisateurs avec leurs items</h3>





                            <div class="accordion" id="accordionExample">
                                @foreach($users as $user)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{$user->id}}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$user->id}}" aria-expanded="false" aria-controls="collapse{{$user->id}}">
                                            {{$user->name}}
                                        </button>
                                    </h2>
                                    <form action="{{ route('items.store') }}" method="POST" class="row g-2" style="margin-top: 5px">
                                        @csrf
                                        <input type="hidden" id="user_id" name="user_id" value="{{$user->id}}" >
                                        <div class="col-auto">
                                            <input type="text" class="form-control" id="text" name="text" placeholder="Nouvel élément">
                                        </div>
                                        <div class="col-auto">
                                            <input type="date" class="form-control" id="date" name="deadline" >
                                        </div>

                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary mb-3">Ajouter</button>
                                        </div>


                                    </form>
                                    <div id="collapse{{$user->id}}" class="accordion-collapse collapse " aria-labelledby="heading{{$user->id}}" data-bs-parent="#accordionExample">


                                    <ul class="list-group">
                                    @foreach($user->items as $item)

                                            @if ($item->done)
                                                <div>
                                                    <li class="list-group-item  justify-content-between align-items-center">
                                                @if(\Carbon\Carbon::parse($item->deadline)->isPast())
                                                    <span class="badge" style="background-color: darkred">{{\Carbon\Carbon::parse($item->deadline)->format('d/m/Y')}}</span>
                                                @else
                                                    <span class="badge" style="background-color: dimgrey">{{\Carbon\Carbon::parse($item->deadline)->format('d/m/Y')}}</span>
                                                @endif


                                                           <s> {{ $item->text }}</s>
                                                        </li>
                                                    </div>

                                            @else
                                                <div>
                                                    <li class="list-group-item  justify-content-between align-items-center">
                                                        @if(\Carbon\Carbon::parse($item->deadline)->isPast())
                                                            <span class="badge" style="background-color: darkred">{{\Carbon\Carbon::parse($item->deadline)->format('d/m/Y')}}</span>
                                                            <strong>{{ $item->text }}</strong>
                                                        @else
                                                            <span class="badge" style="background-color: dimgrey">{{\Carbon\Carbon::parse($item->deadline)->format('d/m/Y')}}</span>
                                                            {{ $item->text }}
                                                        @endif

                                                </li>
                                                </div>

                                            @endif






                                    @endforeach
                                    </ul>
                                    </div>
                                </div>
                                    @endforeach

                            </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



