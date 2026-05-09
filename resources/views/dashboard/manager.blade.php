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

                        <h2> Bienvenue sur votre tableau de bord manager</h2>

                        <h3>Liste des utilisateurs avec leurs items</h3>





                            <div class="accordion" id="accordionExample">
                                @foreach($users as $user)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{$user->id}}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$user->id}}" aria-expanded="false" aria-controls="collapse{{$user->id}}">
                                            {{$user->name}}
                                        </button>
                                    </h2>
                                    <form action="{{ route('items.store',$user->id) }}" method="POST" class="row g-2" style="margin-top: 5px">
                                        @csrf
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


                                            <div>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                {{ $item->text }}
                                            </li>
                                            </div>


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



