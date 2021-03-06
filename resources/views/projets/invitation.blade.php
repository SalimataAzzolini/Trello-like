@extends('layouts.app')
@section('content')
<h2> VOS INVITATIONS</h2>
  @foreach ($invit as $invitat)

    {{-- on boucle sur tous les administrateurs --}}
      @foreach($invitat->admins as $admin)

      {{-- on boucle sur tous les projets --}}
        @foreach($invitat->projets as $projet)

                <p>Vous êtes invité par {{$admin->name}}</p>
                <p> A participer au projet : {{$projet->titre}}</p>
                <form action="{{ route('invitation.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$invitat->id}}">
                    <button name="button" type="submit" value="false">refuser</button>
                </form>
                <form action="{{ route('invitation.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$invitat->id}}">
                    <button name="button" value="true" type="submit">accepter</button><hr>
                </form>
        @endforeach

      @endforeach
  @endforeach

<h4>ACUSEE DE RECEPTION</h4>

  @foreach($accuse as $item)
    
    @foreach($item->userInvit as $guest)

    @foreach($item->projets as $projet)
                
                @if ($item->status == 'true')

                  <p>{{$guest->name}} à accepter votre invitation a participer à {{$projet->titre}} </p>
                @endif

                @if ($item->status == 'false')

                <p>{{$guest->name}} à refuse votre invitation a participer à {{$projet->titre}}</p>
              @endif
    @endforeach
    @endforeach              
  
  @endforeach
@endsection