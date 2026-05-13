
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

                            <h2> {{$title}}</h2>

                            <h3>Bienvenue sur {{$title}} !</h3>

                            <form action="{{ route('items.store',auth()->id()) }}" method="POST" class="row g-2">
                            @csrf
                            <div class="col-auto">
                                <input type="text" class="form-control" id="text" name="text" placeholder="Nouvel élément">
                            </div>
                            <div class="col-auto">
                                <input type="date" class="form-control" id="deadline" name="deadline" >
                            </div>

                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-3">Ajouter</button>
                            </div>


                            </form>
                            <ul class="list-group">
                                @foreach($items->sortBy('deadline') as $item)
                                    <div class="list-group-item d-flex justify-content-between align-items-center" >
                                        <li>

                                        @if ($item->done)
                                            @if(\Carbon\Carbon::parse($item->deadline)->isPast())

                                                    <span class="badge" style="background-color: darkred">{{\Carbon\Carbon::parse($item->deadline)->format('d/m/Y')}}</span>
                                                @else
                                                    <span class="badge" style="background-color: dimgrey">{{\Carbon\Carbon::parse($item->deadline)->format('d/m/Y')}}</span>

                                                @endif
                                                <s>{{$item->text}}</s>
                                                <div class="d-grip gap-2 d-md-flex justify-content-md-end">
                                                    <form action="{{ route('items.destroy',$item->id) }}" method="POST" class="row g-2">
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-danger btn-block" >Supprimer</button>
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                        @else
                                                @if(\Carbon\Carbon::parse($item->deadline)->isPast())
                                                    <span class="badge" style="background-color: darkred">{{\Carbon\Carbon::parse($item->deadline)->format('d/m/Y')}}</span>
                                                <strong>{{$item->text}}</strong>
                                                @else
                                                    <span class="badge" style="background-color: dimgrey">{{\Carbon\Carbon::parse($item->deadline)->format('d/m/Y')}}</span>
                                                    {{$item->text}}
                                                @endif


                                                <div class="d-grip gap-2 d-md-flex justify-content-md-end">
                                                    <a href="{{ route('items.check',$item->id) }}" class="btn btn-outline-secondary btn-block">Fait</a>
                                                </div>
                                      @endif

                                        </li>
                                    </div>

                            @endforeach
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection


