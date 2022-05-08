@extends('layouts.app')
@section('content')

<div class="container-page"> 

    {{-- Insertion de la cloche des notification d'invit --}}
    <div class="notifs"> 
        <a href="{{ route('invitation.index') }}">
            <i class="fa-regular fa-bell logo">{{count($notification)}}</i>
        </a>
    </div>

    <form action="{{ route('projets.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="formGroupExampleInput"><h3>Projet</h3></label> <br>
            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="titre projet" name="titre">
          </div>
          <button type="submit" class="btn btn-success"> Créer</button>
    </form>

    {{-- affichage message succes or error --}}
    @if ($errors->any())
    
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
    
    @endif
    
    @if(session()->has('message'))
        
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>

    @endif
    

    <h3 class="text-center"> PROJETS</h3>

<div class="container-projet"> 

    @foreach ($titres as $titre)
    
        <div class="tableaux">
            <input type="hidden" value="{{$titre->id}}" class="id"/>
        
            <div class="edit-container">
                <div class="card text-white bg-dark mb-3 cursor-pointer" style="max-width: 22rem;">
                  
                    <div class="card-body">

                        <h5 class="card-title value buttonLien text-center">{{$titre->titre}}</h5>

                        <div class="div-btn-projet text-center"> 
                            <button  class="edit-button btn btn-outline-warning">Edit project</button>

                            <button id="delete" class="btn btn-outline-danger">delete</button>

                            <button class="invitation btn btn-outline-success">Invitation</button>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
     
    
    @endforeach
</div>
    @if(session()->has('invit'))
        
        <div class="alert alert-success">
            {{ session()->get('invit') }}
        </div>

    @endif

    <h4> COLLABORATIONS </h4>

    @forelse ($titreId as $value) 
        
        @foreach ($projetId as $elem) 
            
            @if ($value->titre_id == $elem->id)
                 <p class="lienCollab">{{$elem->titre}}</p>
                <input class="idTitreCollab" type="hidden" value="{{$value->titre_id}}">
                
                @endif

        @endforeach

    @empty

        <p>Aucune collaboration en cours</p>
    
    @endforelse

</div>
@endsection