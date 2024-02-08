@extends('welcome')

@section('content')

<table class="table">
  <a href="{{ route('new-entity') }}" class="btn btn-info mb-2">New entity</a>
    <thead>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Address</th>
        <th scope="col">Phone</th>
        <th scope="col">Nit</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
        @foreach ($entities as $entity)
        <tr>
            <td>{{ $entity->name }}</td>
            <td>{{ $entity->address }}</td>
            <td>{{ $entity->phone }}</td>
            <td>{{ $entity->nit }}</td>
            <td>
                <a href="{{ url('entity/'.$entity->id) }}"class="btn btn-small btn-info">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  <div>
    {{ $entities->links() }}
  </div>
@endsection